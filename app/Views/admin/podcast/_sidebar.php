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
    'persons' => [
        'icon' => 'folder-user',
        'items' => ['podcast-person-manage'],
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

<a href="<?= route_to(
    'admin',
) ?>" class="inline-flex items-center px-4 py-2 border-b">
    <?= icon('arrow-left', 'mr-4 text-xl') ?>
        <span class="inline-flex items-baseline text-2xl font-semibold font-display text-pine-700"> <?= 'castopod' .
            svg('castopod-logo', 'h-5 ml-1') ?></span>

</a>
<div class="flex items-center border-b">
    <img
    src="<?= $podcast->image->thumbnail_url ?>"
    alt="<?= $podcast->title ?>"
    class="object-cover w-16 h-16"
    />
    <div class="flex flex-col items-start flex-1 w-48 px-2">
        <span class="w-40 text-sm font-semibold truncate" title="<?= $podcast->title ?>"><?= $podcast->title ?></span>
        <a href="<?= route_to(
            'podcast-activity',
            $podcast->handle,
        ) ?>" class="inline-flex items-center text-xs underline outline-none hover:no-underline focus:ring"
        data-toggle="tooltip" data-placement="bottom" title="<?= lang(
            'PodcastNavigation.go_to_page',
        ) ?>">@<?= $podcast->handle ?>
        <?= icon('external-link', 'ml-1 text-gray-500') ?>
        </a>
    </div>
</div>
<nav class="flex flex-col flex-1 py-6 overflow-y-auto">
    <?php foreach ($podcastNavigation as $section => $data): ?>
    <div class="mb-4">
        <button class="inline-flex items-center w-full px-6 py-1 outline-none focus:ring" type="button">
            <?= icon($data['icon'], 'text-gray-400 text-xl mr-3') .
                lang('PodcastNavigation.' . $section) ?>
        </button>
        <ul class="flex flex-col">
            <?php foreach ($data['items'] as $item): ?>
                <?php $isActive = url_is(route_to($item, $podcast->id)); ?>
            <li class="inline-flex">
                <a class="w-full py-1 pl-14 pr-2 text-sm text-gray-600 outline-none hover:text-gray-900 focus:ring <?= $isActive
                    ? 'font-semibold text-gray-900'
                    : '' ?>" href="<?= route_to(
    $item,
    $podcast->id,
) ?>"><?= lang('PodcastNavigation.' . $item) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endforeach; ?>
</nav>
    <button
        type="button"
        class="inline-flex items-center w-full px-6 py-2 mt-auto border-t outline-none focus:ring"
        id="my-account-dropdown"
        data-dropdown="button"
        data-dropdown-target="my-account-dropdown-menu"
        aria-haspopup="true"
        aria-expanded="false">
        <?= icon('user', 'text-gray-500 mr-2') ?>
        <?= user()->username ?>
        <?= icon('caret-right', 'ml-auto') ?>
    </button>
    <nav
        id="my-account-dropdown-menu"
        class="flex flex-col py-2 text-black whitespace-no-wrap bg-white border rounded shadow"
        aria-labelledby="my-account-dropdown"
        data-dropdown="menu"
        data-dropdown-placement="right-end">
        <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
            'my-account',
        ) ?>"><?= lang('AdminNavigation.account.my-account') ?></a>
        <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
            'change-password',
        ) ?>"><?= lang('AdminNavigation.account.change-password') ?></a>
        <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
            'logout',
        ) ?>"><?= lang('AdminNavigation.account.logout') ?></a>
    </nav>
</div>
