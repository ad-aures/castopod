<?php declare(strict_types=1);

$navigationItems = [
    [
        'uri' => route_to('episode', esc($podcast->handle), esc($episode->slug)),
        'label' => lang('Episode.comments'),
        'labelInfo' => $episode->comments_count,
    ],
    [
        'uri' => route_to('episode-activity', esc($podcast->handle), esc($episode->slug)),
        'label' => lang('Episode.activity'),
        'labelInfo' => $episode->posts_count,
    ],
]
?>
<nav class="sticky z-40 flex col-start-2 pt-4 shadow bg-elevated md:px-8 gap-x-2 md:gap-x-4 -top-4 rounded-conditional-b-xl">
    <?php foreach ($navigationItems as $item): ?>
        <?php $isActive = url_is($item['uri']); ?>
        <a href="<?= $item['uri'] ?>" class="px-4 py-1 text-sm font-semibold uppercase focus:ring-accent border-b-4<?= $isActive ? ' border-b-4 text-black border-accent-base' : ' text-skin-muted hover:text-skin-base hover:border-subtle border-transparent' ?>"><?= $item['label'] ?><span class="px-2 ml-1 font-semibold rounded-full bg-base"><?= $item['labelInfo'] ?></span></a>
    <?php endforeach; ?>
    <button type="button" class="p-2 ml-auto rotate-180 rounded-full md:hidden focus:ring-accent" data-sidebar-toggler="toggler" aria-label="<?= lang('Navigation.toggle_sidebar') ?>"><?= icon('menu') ?></button>
</nav>