<?php
$navigation = [
    'dashboard' => ['icon' => 'dashboard', 'items' => ['admin']],
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

<a href="<?= route_to(
    'admin',
) ?>" class="inline-flex items-baseline px-6 py-2 mb-2 text-2xl font-semibold font-display text-pine-700">
    <?= 'castopod' . svg('castopod-logo', 'h-5 ml-1') ?>
</a>
<a href="<?= route_to(
    'home',
) ?>" class="inline-flex items-center px-6 py-2 mb-2 text-sm underline outline-none hover:no-underline focus:ring">
        <?= lang('AdminNavigation.go_to_website') ?>
        <?= icon('external-link', 'ml-2 text-gray-500') ?>
</a>
<nav class="flex flex-col flex-1 overflow-y-auto">
    <?php foreach ($navigation as $section => $data): ?>
    <div class="mb-4">
        <button class="inline-flex items-center w-full px-6 py-1 font-semibold text-gray-600 outline-none focus:ring" type="button">
            <?= icon($data['icon'], 'text-gray-400 text-xl mr-3') ?>
            <?= lang('AdminNavigation.' . $section) ?>
        </button>
        <ul class="flex flex-col">
            <?php foreach ($data['items'] as $item): ?>
                <?php $isActive = url_is(route_to($item)); ?>
            <li class="inline-flex">
                <a class="w-full py-1 pl-14 pr-2 text-sm text-gray-600 outline-none hover:text-gray-900 focus:ring <?= $isActive
                    ? 'font-semibold text-gray-900'
                    : '' ?>" href="<?= route_to($item) ?>"><?= lang(
    'AdminNavigation.' . $item,
) ?></a>
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
class="absolute z-50 flex flex-col py-2 text-black whitespace-no-wrap bg-white border rounded shadow"
aria-labelledby="my-accountDropdown"
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
