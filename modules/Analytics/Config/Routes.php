<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

$routes = service('routes');

/**
 * Analytics routes file
 */
$routes->addPlaceholder(
    'class',
    '\bPodcastByCountry|\bPodcastByEpisode|\bPodcastByHour|\bPodcastByPlayer|\bPodcastByRegion|\bPodcastByService|\bPodcast|\bWebsiteByBrowser|\bWebsiteByEntryPage|\bWebsiteByReferer',
);
$routes->addPlaceholder(
    'filter',
    '\bWeekly|\bYearly|\bByDay|\bByWeekday|\bByMonth|\bByAppWeekly|\bByAppYearly|\bByOsWeekly|\bByDeviceWeekly|\bBots|\bByServiceWeekly|\bBandwidthByDay|\bUniqueListenersByDay|\bUniqueListenersByMonth|\bTotalListeningTimeByDay|\bTotalListeningTimeByMonth|\bByDomainWeekly|\bByDomainYearly|\bTotalBandwidthByMonth|\bTotalStorageByMonth',
);

$routes->group('', [
    'namespace' => 'Modules\Analytics\Controllers',
], static function ($routes): void {
    $routes->group(config('Analytics')->gateway . '/(:num)/(:class)', static function ($routes): void {
        $routes->get('/', 'AnalyticsController::getData/$1/$2', [
            'as' => 'analytics-full-data',
            'filter' => config('Analytics')
                ->routeFilters[
                'analytics-full-data'
            ],
        ]);
        $routes->get('(:filter)', 'AnalyticsController::getData/$1/$2/$3', [
            'as' => 'analytics-data',
            'filter' => config('Analytics')
                ->routeFilters['analytics-data'],
        ]);
        $routes->get(
            '(:filter)/(:num)',
            'AnalyticsController::getData/$1/$2/$3/$4',
            [
                'as' => 'analytics-filtered-data',
                'filter' => config('Analytics')
                    ->routeFilters[
                    'analytics-filtered-data'
                ],
            ],
        );
    });
    $routes->get(config('Analytics')->gateway . '/(:class)/(:filter)', 'AnalyticsController::getData/$1/$2', [
        'as' => 'analytics-data-instance',
    ]);

    /**
     * @deprecated Route for podcast audio file analytics (/audio/pack(podcast_id,episode_id,bytes_threshold,filesize,duration,date)/podcast_folder/filename.mp3)
     */
    $routes->head('audio/(:base64)/(:any)', 'EpisodeAnalyticsController::hit/$1/$2');
    $routes->get('audio/(:base64)/(:any)', 'EpisodeAnalyticsController::hit/$1/$2');
});

// Show the Unknown UserAgents
$routes->get('.well-known/unknown-useragents', 'UnknownUserAgentsController');
$routes->get('.well-known/unknown-useragents/(:num)', 'UnknownUserAgentsController/$1');
