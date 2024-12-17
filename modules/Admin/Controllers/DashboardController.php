<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\I18n\Time;
use Modules\Media\Models\MediaModel;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $podcastsData = [];
        $podcastsCount = (new PodcastModel())->builder()
            ->countAll();
        $podcastsLastPublishedAt = (new PodcastModel())->builder()
            ->selectMax('published_at', 'last_published_at')
            ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
            ->get()
            ->getResultArray()[0]['last_published_at'];
        $podcastsData['number_of_podcasts'] = (int) $podcastsCount;
        $podcastsData['last_published_at'] = $podcastsLastPublishedAt === null ? null : new Time(
            $podcastsLastPublishedAt
        );

        $episodesData = [];
        $episodesCount = (new EpisodeModel())->builder()
            ->countAll();
        $episodesLastPublishedAt = (new EpisodeModel())->builder()
            ->selectMax('published_at', 'last_published_at')
            ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
            ->get()
            ->getResultArray()[0]['last_published_at'];
        $episodesData['number_of_episodes'] = (int) $episodesCount;
        $episodesData['last_published_at'] = $episodesLastPublishedAt === null ? null : new Time(
            $episodesLastPublishedAt
        );

        $totalUploaded = (new MediaModel())->builder()
            ->selectSum('file_size')
            ->get()
            ->getResultArray()[0];

        $appStorageLimit = config('App')
            ->storageLimit;
        if ($appStorageLimit === null || $appStorageLimit < 0) {
            $storageLimitBytes = disk_total_space('./');
        } else {
            $storageLimitBytes = $appStorageLimit * 1000000000;
        }

        $storageData = [
            'limit'          => formatBytes((int) $storageLimitBytes),
            'percentage'     => round((((int) $totalUploaded['file_size']) / $storageLimitBytes) * 100, 0),
            'total_uploaded' => formatBytes((int) $totalUploaded['file_size']),
        ];

        $onlyPodcastId = null;
        if ($podcastsData['number_of_podcasts'] === 1) {
            $onlyPodcastId = (new PodcastModel())->first()
                ->id;
        }

        $bandwidthLimit = config('App')
            ->bandwidthLimit;

        $data = [
            'podcastsData'   => $podcastsData,
            'episodesData'   => $episodesData,
            'storageData'    => $storageData,
            'bandwidthLimit' => $bandwidthLimit === null ? null : formatBytes($bandwidthLimit * 1000000000),
            'onlyPodcastId'  => $onlyPodcastId,
        ];

        $this->setHtmlHead(lang('Dashboard.home'));
        return view('dashboard', $data);
    }
}
