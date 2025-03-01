<?php

declare(strict_types=1);

namespace Modules\WebSub\Commands;

use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\HTTP\CURLRequest;
use Exception;
use Override;

class Publish extends BaseCommand
{
    protected $group = 'Websub';

    protected $name = 'websub:publish';

    protected $description = 'Publishes feed updates to websub hubs.';

    #[Override]
    public function run(array $params): void
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

        /** @var CURLRequest $request */
        $request = service('curlrequest');

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
                        'warning',
                        "COULD NOT PUBLISH @{$podcast->handle} ON {$hub}" . PHP_EOL . $exception->getMessage(),
                    );
                }
            }

            // set podcast feed as having been pushed onto hubs
            (new PodcastModel())->update($podcast->id, [
                'is_published_on_hubs' => 1,
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
