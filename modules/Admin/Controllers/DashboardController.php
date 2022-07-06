<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Models\EpisodeModel;
use App\Models\MediaModel;
use App\Models\PodcastModel;
use CodeIgniter\I18n\Time;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $podcastsData = [];
        $podcastsCount = (new PodcastModel())->builder()
            ->countAll();
        $podcastsLastPublishedAt = (new PodcastModel())->builder()
            ->select('MAX(published_at) as last_published_at')
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
            ->select('MAX(published_at) as last_published_at')
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
            $storageLimitBytes = disk_free_space('./');
        } else {
            $storageLimitBytes = $appStorageLimit * 1000000000;
        }

        $storageData = [
            'limit' => formatBytes((int) $storageLimitBytes),
            'percentage' => round((((int) $totalUploaded['file_size']) / $storageLimitBytes) * 100, 0),
            'total_uploaded' => formatBytes((int) $totalUploaded['file_size']),
        ];

        $onlyPodcastId = null;
        if ($podcastsData['number_of_podcasts'] === 1) {
            $onlyPodcastId = (new PodcastModel())->first()
                ->id;
        }

        $data = [
            'podcastsData' => $podcastsData,
            'episodesData' => $episodesData,
            'storageData' => $storageData,
            'onlyPodcastId' => $onlyPodcastId,
        ];

        return view('dashboard', $data);
    }
}
