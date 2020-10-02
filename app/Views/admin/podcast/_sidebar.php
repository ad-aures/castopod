<?php
$podcastNavigation = [
    'dashboard' => [
        'icon' => 'dashboard',
        'items' => ['podcast-view', 'podcast-edit'],
    ],
    'episodes' => [
        'icon' => 'mic',
        'items' => ['episode-list', 'episode-create'],
    ],
    'analytics' => [
        'icon' => 'line-chart',
        'items' => [],
    ],
    'contributors' => [
        'icon' => 'group',
        'items' => ['contributor-list', 'contributor-add'],
    ],
    'settings' => [
        'icon' => 'settings',
        'items' => ['platforms'],
    ],
]; ?>

<a href="<?= route_to(
    'admin'
) ?>" class="inline-flex items-center px-4 py-2 border-b">
    <?= icon('arrow-left', 'mr-4') ?>
    <?= svg('logo-castopod', 'h-8 mr-2') ?>
    Castopod
</a>
<div class="flex items-center border-b">
    <img
    src="<?= $podcast->image->thumbnail_url ?>"
    alt="<?= $podcast->title ?>"
    class="object-cover w-16 h-16 mr-2"
    />
    <div class="flex flex-col items-start flex-1">
        <span class="font-semibold truncate"><?= $podcast->title ?></span>
        <a href="<?= route_to(
            'podcast',
            $podcast->name
        ) ?>" class="inline-flex items-center text-sm underline outline-none hover:no-underline focus:shadow-outline"
        data-toggle="tooltip" data-placement="bottom" title="<?= lang(
            'PodcastNavigation.go_to_page'
        ) ?>">@<?= $podcast->name ?>
        <?= icon('external-link', 'ml-1 text-gray-500') ?>
        </a>
    </div>
</div>
<nav class="flex flex-col flex-1 py-6 overflow-y-auto">
    <?php foreach ($podcastNavigation as $section => $data): ?>
    <div class="mb-4">
        <button class="inline-flex items-center w-full px-6 py-1 outline-none focus:shadow-outline" type="button">
            <?= icon($data['icon'], 'text-gray-500') ?>
            <span class="ml-2"><?= lang(
                'PodcastNavigation.' . $section
            ) ?></span>
        </button>
        <ul>
            <?php foreach ($data['items'] as $item): ?>
                <?php $isActive =
                    base_url(route_to($item, $podcast->id)) == current_url(); ?>
            <li>
                <a class="block py-1 pl-12 pr-2 text-sm text-gray-600 outline-none hover:text-gray-900 focus:shadow-outline <?= $isActive
                    ? 'font-semibold text-gray-900'
                    : '' ?>" href="<?= route_to(
    $item,
    $podcast->id
) ?>"><?= lang('PodcastNavigation.' . $item) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endforeach; ?>
</nav>
<div class="w-full mt-auto border-t" data-toggle="dropdown">
    <button type="button" class="inline-flex items-center w-full px-6 py-2 outline-none focus:shadow-outline" id="my-accountDropdown" data-popper="button" aria-haspopup="true" aria-expanded="false">
        <?= icon('user', 'text-gray-500 mr-2') ?>
        <?= user()->username ?>
        <?= icon('caret-right', 'ml-auto') ?>
    </button>
    <nav class="absolute z-50 flex-col hidden py-2 text-black whitespace-no-wrap bg-white border rounded shadow" aria-labelledby="my-accountDropdown" data-popper="menu" data-popper-placement="right-end">
        <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
            'my-account'
        ) ?>">My Account</a>
        <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
            'change-password'
        ) ?>">Change password</a>
        <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
            'logout'
        ) ?>">Logout</a>
    </nav>
</div>
