<?php
$navigation = [
    'podcasts' => [
        'icon' => 'mic',
        'items' => ['podcast-list', 'podcast-create', 'podcast-import'],
    ],
    'persons' => [
        'icon' => 'folder-user',
        'items' => ['person-list', 'person-create'],
    ],
    'fediverse' => [
        'icon' => 'star-smile',
        'items' => ['fediverse-blocked-actors', 'fediverse-blocked-domains'],
    ],
    'users' => ['icon' => 'group', 'items' => ['user-list', 'user-create']],
    'pages' => ['icon' => 'pages', 'items' => ['page-list', 'page-create']],
]; ?>

<nav class="flex flex-col flex-1 py-4 overflow-y-auto gap-y-4">
    <?php foreach ($navigation as $section => $data): ?>
    <div>
        <button class="inline-flex items-center w-full px-4 py-1 font-semibold outline-none focus:ring" type="button">
            <?= icon($data['icon'], 'opacity-60 text-2xl mr-4') ?>
            <?= lang('AdminNavigation.' . $section) ?>
        </button>
        <ul class="flex flex-col">
            <?php foreach ($data['items'] as $item): ?>
                <?php $isActive = url_is(route_to($item)); ?>
            <li class="inline-flex">
                <a class="w-full py-1 pl-14 pr-2 text-sm outline-none hover:opacity-100 focus:ring<?= $isActive
                    ? ' font-semibold opacity-100 inline-flex items-center'
                    : ' opacity-75' ?>" href="<?= route_to($item) ?>"><?= ($isActive ? icon('chevron-right', 'mr-2') : '') .lang(
                    'AdminNavigation.' . $item,
                ) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endforeach; ?>
</nav>
