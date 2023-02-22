<?php declare(strict_types=1);

$podcastNavigation = [
    'dashboard' => [
        'icon' => 'dashboard',
        'items' => ['podcast-view', 'podcast-edit', 'podcast-persons-manage'],
    ],
    'episodes' => [
        'icon' => 'play-circle',
        'items' => ['episode-list', 'episode-create'],
    ],
    'premium' => [
        'icon' => 'exchange-dollar',
        'items' => ['subscription-list', 'subscription-add'],
    ],
    'analytics' => [
        'icon' => 'line-chart',
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
    'contributors' => [
        'icon' => 'group',
        'items' => ['contributor-list', 'contributor-add'],
    ],
    'platforms' => [
        'icon' => 'link',
        'items' => [
            'platforms-podcasting',
            'platforms-social',
            'platforms-funding',
        ],
    ],
];

$counts = [
    'episode-list' => $podcast->getEpisodesCount(),
];

?>

<div class="relative flex items-center px-4 py-2 border-b border-navigation">
    <?php if ($podcast->is_premium): ?>
        <Icon glyph="exchange-dollar" class="absolute pl-1 text-xl rounded-r-full rounded-tl-lg left-4 top-4 text-accent-contrast bg-accent-base" />
    <?php endif; ?>
    <img
    src="<?= $podcast->cover->thumbnail_url ?>"
    alt="<?= esc($podcast->title) ?>"
    class="object-cover w-16 h-16 rounded aspect-square"
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
    </div>
</div>
<nav class="flex flex-col flex-1 py-4 overflow-y-auto gap-y-4">
    <?php foreach ($podcastNavigation as $section => $data): ?>
    <div>
        <button class="inline-flex items-center w-full px-4 py-1 font-semibold focus:ring-accent" type="button">
            <?= icon($data['icon'], 'opacity-60 text-2xl mr-4') .
                        lang('PodcastNavigation.' . $section) ?>
        </button>
        <ul class="flex flex-col">
            <?php foreach ($data['items'] as $item): ?>
                <?php $isActive = url_is(route_to($item, $podcast->id)); ?>
                <?php
                            $itemLabel = lang('PodcastNavigation.' . $item);
                if (array_key_exists($item, $counts)) {
                    $itemLabel .= ' (' . $counts[$item] . ')';
                }
                ?>
            <li class="inline-flex">
                <a class="w-full py-1 pl-14 pr-2 text-sm hover:opacity-100 focus:ring-inset focus:ring-accent <?= $isActive
                    ? 'font-semibold opacity-100 inline-flex items-center'
                    : 'opacity-75' ?>" href="<?= route_to(
                        $item,
                        $podcast->id,
                    ) ?>"><?= ($isActive ? icon('chevron-right', 'mr-2') : '') . $itemLabel ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endforeach; ?>
</nav>
