<?php declare(strict_types=1);

$podcastNavigation = [
    'dashboard' => [
        'icon'  => 'dashboard',
        'items' => ['podcast-view', 'podcast-edit', 'podcast-persons-manage', 'podcast-imports', 'podcast-imports-sync'],
    ],
    'episodes' => [
        'icon'        => 'play-circle',
        'items'       => ['episode-list', 'episode-create'],
        'add-cta'     => 'episode-create',
        'count'       => $podcast->getEpisodesCount(),
        'count-route' => 'episode-list',
    ],
    'analytics' => [
        'icon'  => 'line-chart',
        'items' => [
            'podcast-analytics',
            'podcast-analytics-unique-listeners',
            'podcast-analytics-listening-time',
            'podcast-analytics-players',
            'podcast-analytics-locations',
            'podcast-analytics-time-periods',
            'podcast-analytics-webpages',
        ],
    ],
    'broadcast' => [
        'icon'  => 'broadcast',
        'items' => [
            'platforms-podcasting',
            'platforms-social',
        ],
    ],
    'monetization' => [
        'icon'  => 'money-dollar-circle',
        'items' => [
            'subscription-list',
            'subscription-create',
            'platforms-funding',
            'podcast-monetization-other',
        ],
    ],
    'contributors' => [
        'icon'        => 'group',
        'items'       => ['contributor-list', 'contributor-add'],
        'add-cta'     => 'contributor-add',
        'count'       => count($podcast->contributors),
        'count-route' => 'contributor-list',
    ],
];

?>

<div class="relative flex items-stretch px-2 py-2 border-b border-navigation">
    <?php if ($podcast->is_premium): ?>
        <Icon glyph="exchange-dollar" class="absolute pl-1 text-xl rounded-r-full rounded-tl-lg left-4 top-4 text-accent-contrast bg-accent-base" />
    <?php endif; ?>
    <img
    src="<?= $podcast->cover->thumbnail_url ?>"
    alt="<?= esc($podcast->title) ?>"
    class="object-cover w-20 h-20 rounded aspect-square"
    loading="lazy"
    />
    <div class="flex flex-col items-start flex-1 w-48 px-2">
        <span class="w-full font-semibold truncate" title="<?= esc($podcast->title) ?>"><?= esc($podcast->title) ?></span>
        <a href="<?= route_to(
            'podcast-activity',
            esc($podcast->handle),
        ) ?>" class="inline-flex items-center text-sm hover:underline focus:ring-accent"
        data-tooltip="bottom" title="<?= lang(
            'PodcastNavigation.go_to_page',
        ) ?>">@<?= esc($podcast->handle) ?>
        <?= icon('external-link', 'ml-1 opacity-60') ?>
        </a>
        <a href="<?= $podcast->feed_url ?>" class="inline-flex items-center mt-auto text-xs gap-x-1 focus:ring-accent group hover:underline" target="_blank" rel="noopener noreferrer">
            <?= icon('rss', 'text-xl text-orange-400 inline-flex items-center justify-center rounded') . lang('PodcastNavigation.rss_feed') . icon('external-link', 'text-sm opacity-60') ?>
        </a>
    </div>
</div>

<?= view('_partials/_nav_menu', [
            'navigation' => $podcastNavigation,
            'langKey'    => 'PodcastNavigation',
            'podcastId'  => $podcast->id,
        ]) ?>
