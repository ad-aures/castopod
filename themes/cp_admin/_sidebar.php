<?php declare(strict_types=1);

use App\Models\PageModel;
use App\Models\PersonModel;
use App\Models\PodcastModel;
use Modules\Auth\Models\UserModel;

$navigation = [
    'dashboard' => [
        'icon'  => 'dashboard',
        'items' => ['admin'],
    ],
    'podcasts' => [
        'icon'              => 'mic',
        'items'             => ['podcast-list', 'podcast-create', 'all-podcast-imports', 'podcast-imports-add'],
        'items-permissions' => [
            'podcast-create'      => 'podcasts.create',
            'all-podcast-imports' => 'podcasts.import',
            'podcast-imports-add' => 'podcasts.import',
        ],
        'add-cta'     => 'podcast-create',
        'count-route' => 'podcast-list',
    ],
    'persons' => [
        'icon'              => 'folder-user',
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
        'icon'              => 'rocket-tilted',
        'items'             => ['fediverse-blocked-actors', 'fediverse-blocked-domains'],
        'items-permissions' => [
            'fediverse-blocked-actors'  => 'fediverse.manage-blocks',
            'fediverse-blocked-domains' => 'fediverse.manage-blocks',
        ],
    ],
    'users' => [
        'icon'              => 'group',
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
        'icon'              => 'pages',
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
        'icon'              => 'settings',
        'items'             => ['settings-general', 'settings-theme', 'admin-about'],
        'items-permissions' => [
            'settings-general' => 'admin.settings',
            'settings-theme'   => 'admin.settings',
            'admin-about'      => 'admin.settings',
        ],
    ],
];

if (auth()->user()->can('podcasts.view')) {
    $navigation['podcasts']['count'] = (new PodcastModel())->countAllResults();
} else {
    $navigation['podcasts']['count'] = count(get_user_podcasts(auth()->user()));
} ?>

<?= view('_partials/_nav_menu', [
    'navigation' => $navigation,
    'langKey'    => 'Navigation',
]) ?>
