<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\WebSub\Controllers;

use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\Controller;
use Config\Services;
use Exception;

class WebSubController extends Controller
{
    public function publish(): void
    {
        if (ENVIRONMENT !== 'production') {
            return;
        }

        helper('misc');

        // get all podcasts that haven't been published yet
        // or having a published episode that hasn't been pushed yet
        $podcastModel = new PodcastModel();
        $podcastModel->builder()
            ->select('podcasts.*')
            ->distinct()
            ->join('episodes', 'podcasts.id = episodes.podcast_id', 'left outer')
            ->where('podcasts.is_published_on_hubs', false)
            ->where('`' . $podcastModel->db->getPrefix() . 'podcasts`.`published_at` <= UTC_TIMESTAMP()', null, false)
            ->orGroupStart()
            ->where('episodes.is_published_on_hubs', false)
            ->where('`' . $podcastModel->db->getPrefix() . 'episodes`.`published_at` <= UTC_TIMESTAMP()', null, false)
            ->groupEnd();
        $podcasts = $podcastModel->findAll();

        if ($podcasts === []) {
            return;
        }

        $request = Services::curlrequest();

        $requestOptions = [
            'headers' => [
                'User-Agent'   => 'Castopod/' . CP_VERSION . '; +' . base_url('', 'https'),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ];

        $hubUrls = config('WebSub')
            ->hubs;

        foreach ($podcasts as $podcast) {
            $requestOptions['form_params'] = [
                'hub.mode' => 'publish',
                'hub.url'  => $podcast->feed_url,
            ];

            foreach ($hubUrls as $hub) {
                try {
                    $request->post($hub, $requestOptions);
                } catch (Exception $exception) {
                    log_message(
                        'critical',
                        "COULD NOT PUBLISH @{$podcast->handle} ON {$hub}" . PHP_EOL . $exception->getMessage()
                    );
                }
            }

            // set podcast feed as having been pushed onto hubs
            (new PodcastModel())->update($podcast->id, [
                'is_published_on_hubs' => true,
            ]);

            // set newly published episodes as pushed onto hubs
            (new EpisodeModel())->set('is_published_on_hubs', true)
                ->where([
                    'podcast_id'           => $podcast->id,
                    'is_published_on_hubs' => false,
                ])
                ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
                ->update();
        }
    }
}
