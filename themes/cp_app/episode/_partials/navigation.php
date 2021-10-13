<?php declare(strict_types=1);

$navigationItems = [
    [
        'uri' => route_to('episode', $podcast->handle, $episode->slug),
        'label' => lang('Episode.comments'),
        'labelInfo' => $episode->comments_count,
    ],
    [
        'uri' => route_to('episode-activity', $podcast->handle, $episode->slug),
        'label' => lang('Episode.activity'),
        'labelInfo' => $episode->posts_count,
    ],
]
?>
<nav class="sticky z-40 flex col-start-2 px-4 pt-4 bg-white shadow md:px-8 gap-x-2 md:gap-x-4 -top-4 md:rounded-b-xl">
    <?php foreach ($navigationItems as $item): ?>
        <?php $isActive = url_is($item['uri']); ?>
        <a href="<?= $item['uri'] ?>" class="px-4 py-1 text-sm font-semibold uppercase border-b-4<?= $isActive ? ' border-b-4 text-pine-500 border-pine-500' : ' text-gray-500 hover:text-gray-900 hover:border-gray-200 border-transparent' ?>"><?= $item['label'] ?><span class="px-2 ml-1 font-semibold rounded-full <?= $isActive ? ' bg-pine-100' : ' bg-gray-100' ?>"><?= $item['labelInfo'] ?></span></a>
    <?php endforeach; ?>
    <button type="button" class="p-2 ml-auto rotate-180 rounded-full sm:hidden focus:outline-none focus:ring-2 focus:ring-pine-500 focus:ring-offset-2 focus:ring-offset-pine-100" data-toggle="podcast-sidebar" data-toggle-class="absolute sticky top-0 right-0 hidden bg-white top-12"><?= icon('menu') ?></button>
</nav>