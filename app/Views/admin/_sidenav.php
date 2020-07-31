<?php
$navigation = [
    'dashboard' => ['icon' => 'dashboard', 'items' => ['admin_home']],
    'podcasts' => [
        'icon' => 'mic',
        'items' => ['my_podcasts', 'podcast_list', 'podcast_create'],
    ],
    'users' => ['icon' => 'group', 'items' => ['user_list', 'user_create']],
]; ?>

<nav class="<?= $class ?>">
    <?php foreach ($navigation as $section => $data): ?>
    <div class="mb-4">
        <button class="inline-flex items-center w-full px-4 py-1 outline-none focus:shadow-outline" type="button">
            <?= icon($data['icon'], 'text-gray-500') ?>
            <span class="ml-2"><?= lang('AdminNavigation.' . $section) ?></span>
        </button>
        <ul>
            <?php foreach ($data['items'] as $item): ?>
            <?php $isActive = base_url(route_to($item)) == current_url(); ?>
            <li>
                <a class="block py-1 pl-10 pr-2 text-sm text-gray-600 outline-none hover:text-gray-900 focus:shadow-outline <?= $isActive
                    ? 'font-semibold text-gray-900'
                    : '' ?>" href="<?= route_to($item) ?>"><?= lang(
    'AdminNavigation.' . $item
) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endforeach; ?>

    <a href="<?= route_to(
        'home'
    ) ?>" class="inline-flex items-center px-4 py-1 mt-auto text-sm underline outline-none hover:no-underline focus:shadow-outline">
        <?= lang('AdminNavigation.go_to_website') ?>
        <?= icon('external-link', 'ml-2 text-gray-500') ?>
    </a>
</nav>
