<?php declare(strict_types=1);

use App\Models\PageModel;
use App\Models\PersonModel;
use App\Models\PodcastModel;
use Modules\Auth\Models\UserModel;

$navigation = [
    'dashboard' => [
        'icon'  => 'dashboard-fill', // @icon('dashboard-fill')
        'items' => ['admin'],
    ],
    'podcasts' => [
        'icon'              => 'mic-fill', // @icon('mic-fill')
        'items'             => ['podcast-list', 'podcast-create', 'all-podcast-imports', 'podcast-imports-add'],
        'items-permissions' => [
            'podcast-create'      => 'podcasts.create',
            'all-podcast-imports' => 'podcasts.import',
            'podcast-imports-add' => 'podcasts.import',
        ],
        'add-cta'     => 'podcast-create',
        'count-route' => 'podcast-list',
    ],
    'plugins' => [
        'icon'         => 'puzzle-fill', // @icon('puzzle-fill')
        'items'        => ['plugins-installed'],
        'items-labels' => [
            'plugins-installed' => lang('Navigation.plugins-installed') . ' (' . service('plugins')->getInstalledCount() . ')',
        ],
        'items-permissions' => [
            'plugins-installed' => 'plugins.manage',
        ],
        'count'       => service('plugins')->getActiveCount(),
        'count-route' => 'plugins-installed',
    ],
    'persons' => [
        'icon'              => 'folder-user-fill', // @icon('folder-user-fill')
        'items'             => ['person-list', 'person-create'],
        'items-permissions' => [
            'person-list'   => 'persons.manage',
            'person-create' => 'persons.manage',
        ],
        'add-cta'     => 'person-create',
        'count'       => (new PersonModel())->countAllResults(),
        'count-route' => 'person-list',
    ],
    'fediverse' => [
        'icon'              => 'rocket-2-fill', // @icon('rocket-2-fill')
        'items'             => ['fediverse-blocked-actors', 'fediverse-blocked-domains'],
        'items-permissions' => [
            'fediverse-blocked-actors'  => 'fediverse.manage-blocks',
            'fediverse-blocked-domains' => 'fediverse.manage-blocks',
        ],
    ],
    'users' => [
        'icon'              => 'group-fill', // @icon('group-fill')
        'items'             => ['user-list', 'user-create'],
        'items-permissions' => [
            'user-list'   => 'users.manage',
            'user-create' => 'users.manage',
        ],
        'add-cta'     => 'user-create',
        'count'       => (new UserModel())->countAllResults(),
        'count-route' => 'user-list',
    ],
    'pages' => [
        'icon'              => 'pages-fill', // @icon('pages-fill')
        'items'             => ['page-list', 'page-create'],
        'items-permissions' => [
            'page-list'   => 'pages.manage',
            'page-create' => 'pages.manage',
        ],
        'add-cta'     => 'page-create',
        'count'       => (new PageModel())->countAllResults(),
        'count-route' => 'page-list',
    ],
    'settings' => [
        'icon'              => 'settings-3-fill', // @icon('settings-3-fill')
        'items'             => ['settings-general', 'settings-theme', 'admin-about'],
        'items-permissions' => [
            'settings-general' => 'admin.settings',
            'settings-theme'   => 'admin.settings',
            'admin-about'      => 'admin.settings',
        ],
    ],
];

foreach (plugins()->getActivePlugins() as $plugin) {
    $route = route_to('plugins-view', $plugin->getVendor(), $plugin->getPackage());
    $navigation['plugins']['items'][] = $route;
    $navigation['plugins']['items-labels'][$route] = $plugin->getName();
    $navigation['plugins']['items-permissions'][$route] = 'plugins.manage';
}

if (auth()->user()->can('podcasts.view')) {
    $navigation['podcasts']['count'] = (new PodcastModel())->countAllResults();
} else {
    $navigation['podcasts']['count'] = count(get_user_podcasts(auth()->user()));
} ?>


<?= view('_partials/_nav_menu', [
    'navigation' => $navigation,
    'langKey'    => 'Navigation',
]) ?>
