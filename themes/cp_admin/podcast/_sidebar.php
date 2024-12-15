<?php declare(strict_types=1);

$podcastNavigation = [
    'dashboard' => [
        'icon'              => 'dashboard-fill', // @icon('dashboard-fill')
        'items'             => ['podcast-view', 'podcast-edit', 'podcast-persons-manage', 'podcast-imports', 'podcast-imports-sync'],
        'items-permissions' => [
            'podcast-view'           => 'view',
            'podcast-edit'           => 'edit',
            'podcast-persons-manage' => 'manage-persons',
            'podcast-imports'        => 'manage-import',
            'podcast-imports-sync'   => 'manage-import',
        ],
    ],
    'episodes' => [
        'icon'              => 'play-circle-fill', // @icon('play-circle-fill')
        'items'             => ['episode-list', 'episode-create'],
        'items-permissions' => [
            'episode-list'   => 'episodes.view',
            'episode-create' => 'episodes.create',
        ],
        'add-cta'     => 'episode-create',
        'count'       => $podcast->getEpisodesCount(),
        'count-route' => 'episode-list',
    ],
    'plugins' => [
        'icon'              => 'puzzle-fill', // @icon('puzzle-fill')
        'items'             => [],
        'items-labels'      => [],
        'items-permissions' => [],
    ],
    'analytics' => [
        'icon'  => 'line-chart-fill', // @icon('line-chart-fill')
        'items' => [
            'podcast-analytics',
            'podcast-analytics-unique-listeners',
            'podcast-analytics-listening-time',
            'podcast-analytics-players',
            'podcast-analytics-locations',
            'podcast-analytics-time-periods',
            'podcast-analytics-webpages',
        ],
        'items-permissions' => [
            'podcast-analytics'                  => 'view',
            'podcast-analytics-unique-listeners' => 'view',
            'podcast-analytics-listening-time'   => 'view',
            'podcast-analytics-players'          => 'view',
            'podcast-analytics-locations'        => 'view',
            'podcast-analytics-time-periods'     => 'view',
            'podcast-analytics-webpages'         => 'view',
        ],
    ],
    'broadcast' => [
        'icon'  => 'broadcast-fill', // @icon('broadcast-fill')
        'items' => [
            'platforms-podcasting',
            'platforms-social',
        ],
        'items-permissions' => [
            'platforms-podcasting' => 'manage-platforms',
            'platforms-social'     => 'manage-platforms',
        ],
    ],
    'monetization' => [
        'icon'  => 'money-dollar-circle-fill', // @icon('money-dollar-circle-fill')
        'items' => [
            'subscription-list',
            'subscription-create',
            'platforms-funding',
        ],
        'items-permissions' => [
            'subscription-list'   => 'manage-subscriptions',
            'subscription-create' => 'manage-subscriptions',
            'platforms-funding'   => 'manage-platforms',
        ],
    ],
    'contributors' => [
        'icon'              => 'group-fill', // @icon('group-fill')
        'items'             => ['contributor-list', 'contributor-add'],
        'items-permissions' => [
            'contributor-list' => 'manage-contributors',
            'contributor-add'  => 'manage-contributors',
        ],
        'add-cta'     => 'contributor-add',
        'count'       => count($podcast->contributors),
        'count-route' => 'contributor-list',
    ],
];

foreach (plugins()->getPluginsWithPodcastSettings() as $plugin) {
    $route = route_to('plugins-settings-podcast', $plugin->getVendor(), $plugin->getPackage(), $podcast->id);
    $podcastNavigation['plugins']['items'][] = $route;
    $podcastNavigation['plugins']['items-labels'][$route] = $plugin->getTitle();
    $podcastNavigation['plugins']['items-permissions'][$route] = 'edit';
}

?>

<div class="flex gap-2 px-2 py-2 border-b border-navigation">
    <div class="relative">
        <?php if ($podcast->is_premium): ?>
            <?= icon('exchange-dollar-fill', [
                'class' => 'absolute left-0 pl-1 text-xl rounded-r-full rounded-tl-lg top-2 text-accent-contrast bg-accent-base',
            ]) ?>
        <?php endif; ?>
        <img
        src="<?= $podcast->cover->thumbnail_url ?>"
        alt="<?= esc($podcast->title) ?>"
        class="object-cover w-20 h-20 rounded aspect-square"
        loading="lazy"
        />
    </div>
    <div class="flex flex-col gap-4">
        <div class="flex flex-col items-start flex-1 w-48">
            <span class="w-full font-semibold truncate" title="<?= esc($podcast->title) ?>"><?= esc($podcast->title) ?></span>
            <a href="<?= route_to(
                'podcast-activity',
                esc($podcast->handle),
            ) ?>" class="inline-flex items-center text-sm hover:underline"
            data-tooltip="bottom" title="<?= lang(
                'PodcastNavigation.go_to_page',
            ) ?>">@<?= esc($podcast->handle) ?>
            <?= icon('external-link-fill', [
                'class' => 'ml-1 opacity-60',
            ]) ?>
            </a>
        </div>
        <div class="flex flex-col items-start gap-1">
            <a href="<?= $podcast->feed_url ?>" class="inline-flex items-center text-xs gap-x-1 group hover:underline" target="_blank" rel="noopener noreferrer" data-tooltip="bottom" title="<?= lang('PodcastNavigation.rss_feed') ?>">
                <?= icon('rss-fill', [
                    'class' => 'text-xl text-orange-400 inline-flex items-center justify-center rounded',
                ]) . 'RSS Feed' . icon('external-link-fill', [
                    'class' => 'text-sm opacity-60',
                ]) ?>
            </a>
        </div>
    </div>
</div>

<?= view('_partials/_nav_menu', [
    'navigation' => $podcastNavigation,
    'langKey'    => 'PodcastNavigation',
    'podcastId'  => $podcast->id,
]) ?>
