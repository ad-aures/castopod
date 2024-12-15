<?php declare(strict_types=1);

$episodeNavigation = [
    'dashboard' => [
        'icon'              => 'dashboard-fill', // @icon('dashboard-fill')
        'items'             => ['episode-view', 'episode-edit', 'episode-persons-manage', 'embed-add'],
        'items-permissions' => [
            'episode-view'           => 'episodes.view',
            'episode-edit'           => 'episodes.edit',
            'episode-persons-manage' => 'episodes.manage-persons',
            'embed-add'              => 'episodes.edit',
        ],
    ],
    'plugins' => [
        'icon'              => 'puzzle-fill', // @icon('puzzle-fill')
        'items'             => [],
        'items-labels'      => [],
        'items-permissions' => [],
    ],
    'clips' => [
        'icon'              => 'clapperboard-fill', // @icon('clapperboard-fill')
        'items'             => ['video-clips-list', 'video-clips-create', 'soundbites-list', 'soundbites-create'],
        'items-permissions' => [
            'video-clips-list'   => 'episodes.manage-clips',
            'video-clips-create' => 'episodes.manage-clips',
            'soundbites-list'    => 'episodes.manage-clips',
            'soundbites-create'  => 'episodes.manage-clips',
        ],
        'count'       => $episode->getClipCount(),
        'count-route' => 'video-clips-list',
        'add-cta'     => 'video-clips-create',
    ],
];

foreach (plugins()->getPluginsWithEpisodeSettings() as $plugin) {
    $route = route_to('plugins-settings-episode', $plugin->getVendor(), $plugin->getPackage(), $podcast->id, $episode->id);
    $episodeNavigation['plugins']['items'][] = $route;
    $episodeNavigation['plugins']['items-labels'][$route] = $plugin->getTitle();
    $episodeNavigation['plugins']['items-permissions'][$route] = 'episodes.edit';
}

?>

<a href="<?= route_to('podcast-view', $podcast->id) ?>" class="flex items-center px-4 py-2">
    <?= icon('arrow-left-line', [
        'class' => 'mr-2',
    ]) ?>
    <img
    src="<?= $podcast->cover->tiny_url ?>"
    alt="<?= esc($podcast->title) ?>"
    class="object-cover w-6 h-6 rounded aspect-square"
    loading="lazy"
    />
    <span class="flex-1 w-full px-2 text-xs font-semibold truncate" title="<?= esc($podcast->title) ?>"><?= esc($podcast->title) ?></span>
</a>
<div class="relative flex items-center px-4 py-2 border-y border-navigation">
    <?php if ($episode->is_premium): ?>
        <?= icon('exchange-dollar-fill', [
            'class' => 'absolute pl-1 text-xl rounded-r-full rounded-tl-lg left-4 top-4 text-accent-contrast bg-accent-base',
        ]) ?>
    <?php endif; ?>
    <img
    src="<?= $episode->cover->thumbnail_url ?>"
    alt="<?= esc($episode->title) ?>"
    class="object-cover w-16 h-16 rounded aspect-square"
    loading="lazy"
    />
    <div class="flex flex-col items-start flex-1 w-48 px-2">
        <span class="w-full font-semibold truncate" title="<?= esc($episode->title) ?>"><?= esc($episode->title) ?></span>
        <a href="<?= route_to(
            'episode',
            esc($podcast->handle),
            esc($episode->slug),
        ) ?>" class="inline-flex items-center text-xs hover:underline"><?= lang(
            'EpisodeNavigation.go_to_page',
        ) ?>
        <?= icon('external-link-fill', [
            'class' => 'ml-1 opacity-60',
        ]) ?>
        </a>
    </div>
</div>

<?= view('_partials/_nav_menu', [
    'navigation' => $episodeNavigation,
    'langKey'    => 'EpisodeNavigation',
    'podcastId'  => $podcast->id,
    'episodeId'  => $episode->id,
]) ?>
