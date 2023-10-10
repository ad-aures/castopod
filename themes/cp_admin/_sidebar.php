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
        'icon'        => 'mic',
        'items'       => ['podcast-list', 'podcast-create', 'all-podcast-imports', 'podcast-imports-add'],
        'add-cta'     => 'podcast-create',
        'count-route' => 'podcast-list',
    ],
    'persons' => [
        'icon'        => 'folder-user',
        'items'       => ['person-list', 'person-create'],
        'add-cta'     => 'person-create',
        'count'       => (new PersonModel())->countAllResults(),
        'count-route' => 'person-list',
    ],
    'fediverse' => [
        'icon'  => 'rocket-tilted',
        'items' => ['fediverse-blocked-actors', 'fediverse-blocked-domains'],
    ],
    'users' => [
        'icon'        => 'group',
        'items'       => ['user-list', 'user-create'],
        'add-cta'     => 'user-create',
        'count'       => (new UserModel())->countAllResults(),
        'count-route' => 'user-list',
    ],
    'pages' => [
        'icon'        => 'pages',
        'items'       => ['page-list', 'page-create'],
        'add-cta'     => 'page-create',
        'count'       => (new PageModel())->countAllResults(),
        'count-route' => 'page-list',
    ],
    'settings' => [
        'icon'  => 'settings',
        'items' => ['settings-general', 'settings-theme', 'admin-about'],
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
