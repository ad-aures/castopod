<?php

declare(strict_types=1);

use Modules\Admin\Config\Admin;

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'label' => 'navigeringslenke',
    config(Admin::class)
        ->gateway => 'Heim',
    'podcasts' => 'podkastar',
    'episodes' => 'episodar',
    'subscriptions' => 'tingingar',
    'contributors' => 'bidragsytarar',
    'pages' => 'sider',
    'settings' => 'innstillingar',
    'theme' => 'bunad',
    'about' => 'om',
    'add' => 'legg til',
    'new' => 'ny',
    'edit' => 'rediger',
    'persons' => 'personar',
    'publish' => 'legg ut',
    'publish-edit' => 'rediger publiseringa',
    'publish-date-edit' => 'rediger publiseringsdato',
    'unpublish' => 'avpubliser',
    'delete' => 'slett',
    'remove' => 'fjern',
    'fediverse' => 'fødiverset',
    'blocked-actors' => 'blokkerte aktørar',
    'blocked-domains' => 'blokkerte domene',
    'users' => 'brukarar',
    'my-account' => 'kontoen min',
    'change-password' => 'endre passord',
    'imports' => 'importar',
    'sync-feeds' => 'synkroniser straumar',
    'platforms' => 'plattformer',
    'social' => 'sosiale nettverk',
    'funding' => 'finansiering',
    'monetization-other' => 'andre måtar å tena pengar på',
    'analytics' => 'analysar',
    'locations' => 'stader',
    'webpages' => 'nettsider',
    'unique-listeners' => 'unike lyttarar',
    'players' => 'spelarar',
    'listening-time' => 'lyttetid',
    'time-periods' => 'tidsperiodar',
    'soundbites' => 'lydbetar',
    'video-clips' => 'videoklypp',
    'embed' => 'innbyggbar spelar',
    'notifications' => 'varslingar',
    'suspend' => 'utvis',
];
