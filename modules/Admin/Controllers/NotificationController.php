<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Podcast;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\I18n\Time;
use Modules\Fediverse\Entities\Notification;
use Modules\Fediverse\Models\NotificationModel;
use Modules\Fediverse\Models\PostModel;

class NotificationController extends BaseController
{
    protected Podcast $podcast;

    protected Notification $notification;

    public function _remap(string $method, string ...$params): mixed
    {
        if (
            ! ($podcast = (new PodcastModel())->getPodcastById((int) $params[0])) instanceof Podcast
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;

        if (count($params) > 1) {
            if (
                ! ($notification = (new NotificationModel())
                    ->where([
                        'id' => $params[1],
                    ])
                    ->first()) instanceof Notification
            ) {
                throw PageNotFoundException::forPageNotFound();
            }

            $this->notification = $notification;

            unset($params[1]);
            unset($params[0]);
        }

        return $this->{$method}(...$params);
    }

    public function list(): string
    {
        $notifications = (new NotificationModel())->where('target_actor_id', $this->podcast->actor_id)
            ->orderBy('created_at', 'desc');

        $data = [
            'podcast'       => $this->podcast,
            'notifications' => $notifications->paginate(10),
            'pager'         => $notifications->pager,
        ];

        $this->setHtmlHead(lang('Notifications.title'));
        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('podcast/notifications', $data);
    }

    public function markAsRead(): RedirectResponse
    {
        $this->notification->read_at = new Time('now');
        $notificationModel = new NotificationModel();
        $notificationModel->update($this->notification->id, $this->notification);

        if ($this->notification->post_id === null) {
            return redirect()->route('podcast-activity', [esc($this->podcast->handle)]);
        }

        $post = (new PostModel())->getPostById($this->notification->post_id);

        return redirect()->route('post', [$this->podcast->handle, $post->id]);
    }

    public function markAllAsRead(): RedirectResponse
    {
        $notifications = (new NotificationModel())->where('target_actor_id', $this->podcast->actor_id)
            ->where('read_at', null)
            ->findAll();

        foreach ($notifications as $notification) {
            $notification->read_at = new Time('now');
            (new NotificationModel())->update($notification->id, $notification);
        }

        return redirect()->back();
    }
}
