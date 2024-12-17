<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\PremiumPodcasts\Controllers;

use App\Entities\Podcast;
use App\Models\PodcastModel;
use CodeIgniter\Email\Email;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\I18n\Time;
use Modules\Admin\Controllers\BaseController;
use Modules\PremiumPodcasts\Entities\Subscription;
use Modules\PremiumPodcasts\Models\SubscriptionModel;

class SubscriptionController extends BaseController
{
    protected Podcast $podcast;

    protected Subscription $subscription;

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (! ($podcast = (new PodcastModel())->getPodcastById((int) $params[0])) instanceof Podcast) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;

        if (count($params) <= 1) {
            return $this->{$method}();
        }

        if (! ($this->subscription = (new SubscriptionModel())->getSubscriptionById(
            (int) $params[1]
        )) instanceof Subscription) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $this->{$method}();
    }

    public function list(): string
    {
        $data = [
            'podcast' => $this->podcast,
        ];

        helper('form');

        $this->setHtmlHead(lang('Subscription.podcast_subscriptions'));
        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('subscription/list', $data);
    }

    public function attemptLinkSave(): RedirectResponse
    {
        $rules = [
            'subscription_link' => 'valid_url_strict|permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        if (($subscriptionLink = $validData['subscription_link']) === '') {
            service('settings')
                ->forget('Subscription.link', 'podcast:' . $this->podcast->id);

            return redirect()->route('subscription-list', [$this->podcast->id])->with(
                'message',
                lang('Subscription.messages.linkRemoveSuccess')
            );
        }

        service('settings')
            ->set('Subscription.link', $subscriptionLink, 'podcast:' . $this->podcast->id);

        // clear cached podcast pages to render Call To Action
        cache()
            ->deleteMatching("page_podcast#{$this->podcast->id}*");

        return redirect()->route('subscription-list', [$this->podcast->id])->with(
            'message',
            lang('Subscription.messages.linkSaveSuccess')
        );
    }

    public function view(): string
    {
        $data = [
            'podcast'      => $this->podcast,
            'subscription' => $this->subscription,
        ];

        $this->setHtmlHead(lang('Subscription.view', [$this->subscription->id]));
        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
            1 => '#' . $this->subscription->id,
        ]);
        return view('subscription/view', $data);
    }

    public function create(): string
    {
        helper('form');

        $data = [
            'podcast' => $this->podcast,
        ];

        $this->setHtmlHead(lang('Subscription.add', [esc($this->podcast->title)]));
        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('subscription/create', $data);
    }

    public function attemptCreate(): RedirectResponse
    {
        helper('text');

        $expiresAt = null;
        $expirationDate = $this->request->getPost('expiration_date');
        if ($expirationDate) {
            $expiresAt = Time::createFromFormat(
                'Y-m-d H:i',
                $expirationDate,
                $this->request->getPost('client_timezone'),
            )->setTimezone(app_timezone());
        }

        $newSubscription = new Subscription([
            'podcast_id' => $this->podcast->id,
            'email'      => $this->request->getPost('email'),
            'token'      => hash('sha256', $rawToken = random_string('alnum', 8)),
            'expires_at' => $expiresAt,
            'created_by' => user_id(),
            'updated_by' => user_id(),
        ]);

        $db = db_connect();
        $db->transStart();

        $subscriptionModel = new SubscriptionModel();
        if (! $subscriptionModel->insert($newSubscription)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $subscriptionModel->errors());
        }

        /** @var Email $email */
        $email = service('email');

        if (! $email->setTo($newSubscription->email)
            ->setSubject(lang('Subscription.emails.welcome_subject', [
                'podcastTitle' => $this->podcast->title,
            ], $this->podcast->language_code))
            ->setMessage(view('subscription/email/welcome', [
                'subscription' => $newSubscription,
                'token'        => $rawToken,
            ]))->setMailType('html')
            ->send()) {
            $db->transRollback();
            return redirect()->route('subscription-list', [$this->podcast->id])->with(
                'errors',
                [lang('Subscription.messages.addError'), $email->printDebugger([])]
            );
        }

        $db->transComplete();

        return redirect()->route('subscription-list', [$this->podcast->id])->with(
            'message',
            lang('Subscription.messages.addSuccess', [
                'subscriber' => $newSubscription->email,
            ])
        );
    }

    public function regenerateToken(): RedirectResponse
    {
        helper('text');

        $this->subscription->token = hash('sha256', $rawToken = random_string('alnum', 8));
        $this->subscription->updated_by = user_id();

        $db = db_connect();

        $db->transStart();

        $subscriptionModel = new SubscriptionModel();
        if (! $subscriptionModel->update($this->subscription->id, $this->subscription)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $subscriptionModel->errors());
        }

        /** @var Email $email */
        $email = service('email');

        if (! $email->setTo($this->subscription->email)
            ->setSubject(lang('Subscription.emails.reset_subject', [], $this->podcast->language_code))
            ->setMessage(view('subscription/email/reset', [
                'subscription' => $this->subscription,
                'token'        => $rawToken,
            ]))->setMailType('html')
            ->send()) {
            $db->transRollback();
            return redirect()->route('subscription-list', [$this->podcast->id])->with(
                'errors',
                [lang('Subscription.messages.regenerateTokenError'), $email->printDebugger([])]
            );
        }

        $db->transComplete();

        return redirect()->route('subscription-list', [$this->podcast->id])->with(
            'message',
            lang('Subscription.messages.regenerateTokenSuccess', [
                'subscriber' => $this->subscription->email,
            ])
        );
    }

    public function edit(): string
    {
        helper('form');

        $data = [
            'podcast'      => $this->podcast,
            'subscription' => $this->subscription,
        ];

        $this->setHtmlHead(lang('Subscription.edit', [esc($this->podcast->title)]));
        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
            1 => '#' . $this->subscription->id,
        ]);
        return view('subscription/edit', $data);
    }

    public function attemptEdit(): RedirectResponse
    {
        $expiresAt = null;
        $expirationDate = $this->request->getPost('expiration_date');
        if ($expirationDate) {
            $expiresAt = Time::createFromFormat(
                'Y-m-d H:i',
                $expirationDate,
                $this->request->getPost('client_timezone'),
            )->setTimezone(app_timezone());
        }

        $this->subscription->expires_at = $expiresAt;

        $db = db_connect();
        $db->transStart();

        $subscriptionModel = new SubscriptionModel();
        if (! $subscriptionModel->update($this->subscription->id, $this->subscription)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $subscriptionModel->errors());
        }

        /** @var Email $email */
        $email = service('email');

        if (! $email->setTo($this->subscription->email)
            ->setSubject(lang('Subscription.emails.edited_subject', [], $this->podcast->language_code))
            ->setMessage(view('subscription/email/edited', [
                'subscription' => $this->subscription,
            ]))->setMailType('html')
            ->send()) {
            $db->transRollback();
            return redirect()->route('subscription-list', [$this->podcast->id])->with(
                'errors',
                [lang('Subscription.messages.editError'), $email->printDebugger([])]
            );
        }

        $db->transComplete();

        return redirect()->route('subscription-list', [$this->podcast->id])->with(
            'message',
            lang('Subscription.messages.editSuccess', [
                'subscriber' => $this->subscription->email,
            ])
        );
    }

    public function suspend(): string
    {
        helper('form');

        $data = [
            'podcast'      => $this->podcast,
            'subscription' => $this->subscription,
        ];

        $this->setHtmlHead(lang('Subscription.suspend'));
        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
            1 => '#' . $this->subscription->id,
        ]);
        return view('subscription/suspend', $data);
    }

    public function attemptSuspend(): RedirectResponse
    {
        $db = db_connect();
        $db->transStart();

        $this->subscription->suspend($this->request->getPost('reason'));
        $subscriptionModel = new SubscriptionModel();
        if (! $subscriptionModel->update($this->subscription->id, $this->subscription)) {
            return redirect()
                ->back()
                ->with('errors', $subscriptionModel->errors());
        }

        /** @var Email $email */
        $email = service('email');

        if (! $email->setTo($this->subscription->email)
            ->setSubject(lang('Subscription.emails.suspended_subject', [], $this->podcast->language_code))
            ->setMessage(view('subscription/email/suspended', [
                'subscription' => $this->subscription,
            ]))->setMailType('html')
            ->send()) {
            $db->transRollback();
            return redirect()->route('subscription-list', [$this->podcast->id])->with(
                'errors',
                [lang('Subscription.messages.suspendError'), $email->printDebugger([])]
            );
        }

        $db->transComplete();

        return redirect()->route('subscription-list', [$this->podcast->id])->with(
            'messages',
            lang('Subscription.messages.suspendSuccess', [
                'subscriber' => $this->subscription->email,
            ])
        );
    }

    public function resume(): RedirectResponse
    {
        $db = db_connect();
        $db->transStart();

        $this->subscription->resume();

        $subscriptionModel = new SubscriptionModel();
        if (! $subscriptionModel->update($this->subscription->id, $this->subscription)) {
            return redirect()
                ->back()
                ->with('errors', $subscriptionModel->errors());
        }

        /** @var Email $email */
        $email = service('email');

        if (! $email->setTo($this->subscription->email)
            ->setSubject(lang('Subscription.emails.resumed_subject', [], $this->podcast->language_code))
            ->setMessage(view('subscription/email/resumed', [
                'subscription' => $this->subscription,
            ]))->setMailType('html')
            ->send()) {
            $db->transRollback();
            return redirect()->route('subscription-list', [$this->podcast->id])->with(
                'errors',
                [lang('Subscription.messages.resumeError'), $email->printDebugger([])]
            );
        }

        $db->transComplete();

        return redirect()->route('subscription-list', [$this->podcast->id])->with(
            'message',
            lang('Subscription.messages.resumeSuccess', [
                'subscriber' => $this->subscription->email,
            ])
        );
    }

    public function delete(): string
    {
        helper('form');

        $data = [
            'podcast'      => $this->podcast,
            'subscription' => $this->subscription,
        ];

        $this->setHtmlHead(lang('Subscription.delete'));
        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
            1 => '#' . $this->subscription->id,
        ]);
        return view('subscription/delete', $data);
    }

    public function attemptDelete(): RedirectResponse
    {
        $db = db_connect();
        $db->transStart();

        (new SubscriptionModel())->delete($this->subscription->id);

        /** @var Email $email */
        $email = service('email');

        if (! $email->setTo($this->subscription->email)
            ->setSubject(lang('Subscription.emails.deleted_subject', [], $this->podcast->language_code))
            ->setMessage(view('subscription/email/deleted', [
                'subscription' => $this->subscription,
            ]))->setMailType('html')
            ->send()) {
            $db->transRollback();
            return redirect()->route('subscription-list', [$this->podcast->id])->with(
                'errors',
                [lang('Subscription.messages.deleteError'), $email->printDebugger([])]
            );
        }

        $db->transComplete();

        return redirect()->route('subscription-list', [$this->podcast->id])->with(
            'messages',
            lang('Subscription.messages.deleteSuccess', [
                'subscriber' => $this->subscription->email,
            ])
        );
    }
}
