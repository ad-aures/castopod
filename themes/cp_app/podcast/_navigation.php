<?php declare(strict_types=1);

$navigationItems = [
    [
        'uri' => route_to('podcast-activity', $podcast->handle),
        'label' => lang('Podcast.activity'),
    ],
    [
        'uri' => route_to('podcast-episodes', $podcast->handle),
        'label' => lang('Podcast.episodes'),
    ],
    [
        'uri' => route_to('podcast-about', $podcast->handle),
        'label' => lang('Podcast.about'),
    ],
]
?>
<nav class="flex gap-4 px-8">
    <?php foreach ($navigationItems as $item): ?>
        <?php $isActive = url_is($item['uri']); ?>
        <a href="<?= $item['uri'] ?>" class="px-4 py-1 font-semibold uppercase border-b-4<?= $isActive ? ' border-b-4 text-pine-500 border-pine-500' : ' text-gray-500 hover:text-gray-900 hover:border-gray-200 border-transparent' ?>"><?= $item['label'] ?></a>
    <?php endforeach; ?>
</nav>