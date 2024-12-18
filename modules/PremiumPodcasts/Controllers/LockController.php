<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\PremiumPodcasts\Controllers;

use App\Controllers\BaseController;
use App\Entities\Podcast;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use Modules\PremiumPodcasts\PremiumPodcasts;

class LockController extends BaseController
{
    protected Podcast $podcast;

    protected PremiumPodcasts $premiumPodcasts;

    public function __construct()
    {
        $this->premiumPodcasts = service('premium_podcasts');
    }

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (! ($podcast = (new PodcastModel())->getPodcastByHandle($params[0])) instanceof Podcast) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;

        return $this->{$method}();
    }

    public function index(): RedirectResponse|string
    {
        if (! $this->podcast->is_premium) {
            return redirect()->route('podcast-activity', [$this->podcast->handle]);
        }

        $data = [
            'podcast' => $this->podcast,
        ];

        helper('form');

        return view('podcast/unlock', $data);
    }

    public function unlockAction(): RedirectResponse
    {
        $rules = [
            'token' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $token = $validData['token'];

        // attempt unlocking the podcast with the token
        if (! $this->premiumPodcasts->unlock($this->podcast->handle, $token)) {
            // bad key or subscription is not active
            return redirect()->back()
                ->withInput()
                ->with('error', lang('PremiumPodcasts.messages.unlockBadAttempt'));
        }

        $redirectURL = session('redirect_url') ?? site_url('/');
        unset($_SESSION['redirect_url']);

        return redirect()
            ->to($redirectURL)
            ->withCookies()
            ->with('message', lang('PremiumPodcasts.messages.unlockSuccess'));
    }

    public function lockAction(): RedirectResponse
    {
        $this->premiumPodcasts->lock($this->podcast->handle);

        $redirectURL = session('redirect_url') ?? site_url('/');
        unset($_SESSION['redirect_url']);

        return redirect()->to($redirectURL)
            ->withCookies()
            ->with('message', lang('PremiumPodcasts.messages.lockSuccess'));
    }
}
