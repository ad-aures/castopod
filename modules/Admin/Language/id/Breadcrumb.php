<?php

declare(strict_types=1);

use Modules\Admin\Config\Admin;

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'label' => 'breadcrumb',
    config(Admin::class)
        ->gateway => 'Home',
    'podcasts' => 'podcasts',
    'episodes' => 'episodes',
    'subscriptions' => 'subscriptions',
    'contributors' => 'contributors',
    'pages' => 'pages',
    'settings' => 'settings',
    'theme' => 'theme',
    'about' => 'about',
    'add' => 'add',
    'new' => 'new',
    'edit' => 'edit',
    'persons' => 'persons',
    'publish' => 'publish',
    'publish-edit' => 'edit publication',
    'publish-date-edit' => 'edit publication date',
    'unpublish' => 'unpublish',
    'delete' => 'delete',
    'remove' => 'remove',
    'fediverse' => 'fediverse',
    'blocked-actors' => 'blocked actors',
    'blocked-domains' => 'blocked domains',
    'users' => 'pengguna',
    'my-account' => 'akun saya',
    'change-password' => 'ubah kata sandi',
    'imports' => 'imports',
    'sync-feeds' => 'synchronize feeds',
    'platforms' => 'platforms',
    'social' => 'social networks',
    'funding' => 'funding',
    'monetization-other' => 'other monetization',
    'analytics' => 'analitik',
    'locations' => 'locations',
    'webpages' => 'web pages',
    'unique-listeners' => 'unique listeners',
    'players' => 'players',
    'listening-time' => 'listening time',
    'time-periods' => 'time periods',
    'soundbites' => 'soundbites',
    'video-clips' => 'video clips',
    'embed' => 'embeddable player',
    'notifications' => 'notifications',
    'suspend' => 'suspend',
];
