<?php declare(strict_types=1);

$podcastNavigation = [
    'dashboard' => [
        'icon' => 'dashboard',
        'items' => ['podcast-view', 'podcast-edit', 'podcast-persons-manage'],
    ],
    'episodes' => [
        'icon' => 'mic',
        'items' => ['episode-list', 'episode-create'],
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
]; ?>

<div class="flex items-center px-4 py-2 border-b border-navigation">
    <img
    src="<?= $podcast->cover->thumbnail_url ?>"
    alt="<?= $podcast->title ?>"
    class="object-cover w-16 h-16 rounded"
    />
    <div class="flex flex-col items-start flex-1 w-48 px-2">
        <span class="w-full font-semibold truncate" title="<?= $podcast->title ?>"><?= $podcast->title ?></span>
        <a href="<?= route_to(
    'podcast-activity',
    $podcast->handle,
) ?>" class="inline-flex items-center text-sm hover:underline focus:ring-accent"
        data-tooltip="bottom" title="<?= lang(
    'PodcastNavigation.go_to_page',
) ?>">@<?= $podcast->handle ?>
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
            <li class="inline-flex">
                <a class="w-full py-1 pl-14 pr-2 text-sm hover:opacity-100 focus:ring-inset focus:ring-accent <?= $isActive
                    ? 'font-semibold opacity-100 inline-flex items-center'
                    : 'opacity-75' ?>" href="<?= route_to(
                        $item,
                        $podcast->id,
                    ) ?>"><?= ($isActive ? icon('chevron-right', 'mr-2') : '') . lang('PodcastNavigation.' . $item) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endforeach; ?>
</nav>
