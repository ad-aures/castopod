<?php declare(strict_types=1);

$podcastNavigation = [
    'dashboard' => [
        'icon'  => 'dashboard',
        'items' => ['episode-view', 'episode-edit', 'episode-persons-manage', 'embed-add'],
    ],
    'clips' => [
        'icon'  => 'clapperboard',
        'items' => ['video-clips-list', 'video-clips-create', 'soundbites-list', 'soundbites-create'],
    ],
]; ?>

<a href="<?= route_to('podcast-view', $podcast->id) ?>" class="flex items-center px-4 py-2 focus:ring-inset focus:ring-accent">
    <?= icon('arrow-left', 'mr-2') ?>
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
        <Icon glyph="exchange-dollar" class="absolute pl-1 text-xl rounded-r-full rounded-tl-lg left-4 top-4 text-accent-contrast bg-accent-base" />
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
        ) ?>" class="inline-flex items-center text-xs hover:underline focus:ring-accent"><?= lang(
            'EpisodeNavigation.go_to_page',
        ) ?>
        <?= icon('external-link', 'ml-1 opacity-60') ?>
        </a>
    </div>
</div>
<nav class="flex flex-col flex-1 py-4 overflow-y-auto gap-y-4">
    <?php foreach ($podcastNavigation as $section => $data): ?>
    <div>
        <button class="inline-flex items-center w-full px-4 py-1 font-semibold focus:ring-accent" type="button">
            <?= icon($data['icon'], 'opacity-60 text-2xl mr-4') .
                        lang('EpisodeNavigation.' . $section) ?>
        </button>
        <ul class="flex flex-col">
            <?php foreach ($data['items'] as $item): ?>
                <?php $isActive = url_is(route_to($item, $podcast->id, $episode->id)); ?>
            <li class="inline-flex">
                <a class="w-full py-1 pl-14 pr-2 text-sm hover:opacity-100 focus:ring-inset focus:ring-accent <?= $isActive
                            ? 'font-semibold opacity-100 inline-flex items-center'
                            : 'opacity-75' ?>" href="<?= route_to(
                                $item,
                                $podcast->id,
                                $episode->id
                            ) ?>"><?= ($isActive ? icon('chevron-right', 'mr-2') : '') . lang('EpisodeNavigation.' . $item) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endforeach; ?>
</nav>
