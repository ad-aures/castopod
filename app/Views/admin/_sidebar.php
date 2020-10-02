<?php
$navigation = [
    'dashboard' => ['icon' => 'dashboard', 'items' => ['admin']],
    'podcasts' => [
        'icon' => 'mic',
        'items' => ['podcast-list', 'podcast-create', 'podcast-import'],
    ],
    'users' => ['icon' => 'group', 'items' => ['user-list', 'user-create']],
    'pages' => ['icon' => 'pages', 'items' => ['page-list', 'page-create']],
]; ?>

<a href="<?= route_to(
    'admin'
) ?>" class="inline-flex items-center px-4 py-2 mb-2 text-xl">
    <?= svg('logo-castopod', 'h-8 mr-2') ?>
    Castopod
</a>
<a href="<?= route_to(
    'home'
) ?>" class="inline-flex items-center px-6 py-2 mb-2 text-sm underline outline-none hover:no-underline focus:shadow-outline">
        <?= lang('AdminNavigation.go_to_website') ?>
        <?= icon('external-link', 'ml-2 text-gray-500') ?>
</a>
<nav class="flex flex-col flex-1 overflow-y-auto">
    <?php foreach ($navigation as $section => $data): ?>
    <div class="mb-4">
        <button class="inline-flex items-center w-full px-6 py-1 outline-none focus:shadow-outline" type="button">
            <?= icon($data['icon'], 'text-gray-500') ?>
            <span class="ml-2"><?= lang('AdminNavigation.' . $section) ?></span>
        </button>
        <ul>
            <?php foreach ($data['items'] as $item): ?>
                <?php $isActive = base_url(route_to($item)) == current_url(); ?>
            <li>
                <a class="block py-1 pl-12 pr-2 text-sm text-gray-600 outline-none hover:text-gray-900 focus:shadow-outline <?= $isActive
                    ? 'font-semibold text-gray-900'
                    : '' ?>" href="<?= route_to($item) ?>"><?= lang(
    'AdminNavigation.' . $item
) ?></a>
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

