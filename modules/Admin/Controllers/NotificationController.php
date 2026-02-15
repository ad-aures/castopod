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
        if ($params === []) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ! ($podcast = new PodcastModel()->getPodcastById((int) $params[0])) instanceof Podcast
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $params[0] = $podcast;

        if (count($params) > 1) {
            if (
                ! ($notification = new NotificationModel()->find($params[1])) instanceof Notification
            ) {
                throw PageNotFoundException::forPageNotFound();
            }

            $params[1] = $notification;
        }

        return $this->{$method}(...$params);
    }

    public function list(Podcast $podcast): string
    {
        $notifications = new NotificationModel()
            ->where('target_actor_id', $podcast->actor_id)
            ->orderBy('created_at', 'desc');

        $data = [
            'podcast'       => $podcast,
            'notifications' => $notifications->paginate(10),
            'pager'         => $notifications->pager,
        ];

        $this->setHtmlHead(lang('Notifications.title'));
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/notifications', $data);
    }

    public function markAllAsReadAction(Podcast $podcast): RedirectResponse
    {
        $notifications = new NotificationModel()
            ->where('target_actor_id', $podcast->actor_id)
            ->where('read_at')
            ->findAll();

        foreach ($notifications as $notification) {
            $notification->read_at = new Time('now');
            new NotificationModel()
                ->update($notification->id, $notification);
        }

        return redirect()->back();
    }

    public function markAsReadAction(Podcast $podcast, Notification $notification): RedirectResponse
    {
        $notification->read_at = new Time('now');
        $notificationModel = new NotificationModel();
        $notificationModel->update($notification->id, $notification);

        if ($notification->post_id === null) {
            return redirect()->route('podcast-activity', [esc($podcast->handle)]);
        }

        $post = new PostModel()
            ->getPostById($notification->post_id);

        return redirect()->route('post', [$podcast->handle, $post->id]);
    }
}
