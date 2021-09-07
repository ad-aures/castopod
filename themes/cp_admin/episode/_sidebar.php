<?php
$podcastNavigation = [
    'dashboard' => [
        'icon' => 'dashboard',
        'items' => ['episode-view', 'episode-edit', 'episode-persons-manage', 'embeddable-player-add', 'soundbites-edit'],
    ],
]; ?>

<a href="<?= route_to('podcast-view', $podcast->id) ?>" class="flex items-center px-4 py-2 border-b border-pine-900 focus:ring">
    <?= icon('arrow-left', 'mr-2' ) ?>
    <img
    src="<?= $podcast->image->thumbnail_url ?>"
    alt="<?= $podcast->title ?>"
    class="object-cover w-6 h-6 rounded"
    />
    <span class="flex-1 w-full px-2 text-xs font-semibold truncate" title="<?= $podcast->title ?>"><?= $podcast->title ?></span>
</a>
<div class="flex items-center px-4 py-2 border-b border-pine-900">
    <img
    src="<?= $episode->image->thumbnail_url ?>"
    alt="<?= $episode->title ?>"
    class="object-cover w-16 h-16 rounded"
    />
    <div class="flex flex-col items-start flex-1 w-48 px-2">
        <span class="w-full font-semibold truncate" title="<?= $episode->title ?>"><?= $episode->title ?></span>
        <a href="<?= route_to(
            'episode',
            $podcast->handle,
            $episode->slug,
        ) ?>" class="inline-flex items-center text-xs outline-none hover:underline focus:ring"><?= lang(
            'EpisodeNavigation.go_to_page',
        ) ?>
        <?= icon('external-link', 'ml-1 opacity-60') ?>
        </a>
    </div>
</div>
<nav class="flex flex-col flex-1 py-4 overflow-y-auto gap-y-4">
    <?php foreach ($podcastNavigation as $section => $data): ?>
    <div>
        <button class="inline-flex items-center w-full px-4 py-1 font-semibold outline-none focus:ring" type="button">
            <?= icon($data['icon'], 'opacity-60 text-2xl mr-4') .
                lang('EpisodeNavigation.' . $section) ?>
        </button>
        <ul class="flex flex-col">
            <?php foreach ($data['items'] as $item): ?>
                <?php $isActive = url_is(route_to($item, $podcast->id, $episode->id)); ?>
            <li class="inline-flex">
                <a class="w-full py-1 pl-14 pr-2 text-sm outline-none hover:opacity-100 focus:ring <?= $isActive
                    ? 'font-semibold opacity-100 inline-flex items-center'
                    : 'opacity-75' ?>" href="<?= route_to(
                    $item,
                    $podcast->id,
                    $episode->id
                ) ?>"><?= ($isActive ? icon('chevron-right', 'mr-2') : '') .lang('EpisodeNavigation.' . $item) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endforeach; ?>
</nav>
