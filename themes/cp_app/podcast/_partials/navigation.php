<?php declare(strict_types=1);

$navigationItems = [
    [
        'uri' => route_to('podcast-activity', esc($podcast->handle)),
        'label' => lang('Podcast.activity'),
    ],
    [
        'uri' => route_to('podcast-episodes', esc($podcast->handle)),
        'label' => lang('Podcast.episodes'),
    ],
    [
        'uri' => route_to('podcast-about', esc($podcast->handle)),
        'label' => lang('Podcast.about'),
    ],
]
?>
<nav class="sticky z-40 flex col-start-2 pt-8 shadow bg-elevated gap-x-2 md:gap-x-4 md:px-8 -top-6 md:-top-10 rounded-conditional-b-xl md:pt-12 ">
    <?php foreach ($navigationItems as $item): ?>
        <?php $isActive = url_is($item['uri']); ?>
        <a href="<?= $item['uri'] ?>" class="px-4 py-1 text-sm font-semibold uppercase focus:ring-accent border-b-4<?= $isActive ? ' border-b-4 text-black border-accent-base' : ' text-skin-muted hover:text-skin-base hover:border-subtle border-transparent' ?>"><?= $item['label'] ?></a>
    <?php endforeach; ?>
    <button type="button" class="p-2 ml-auto rotate-180 rounded-full md:hidden focus:ring-accent" data-sidebar-toggler="toggler" aria-label="<?= lang('Navigation.toggle_sidebar') ?>"><?= icon('menu') ?></button>
</nav>