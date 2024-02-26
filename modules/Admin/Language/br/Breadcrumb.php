<?php

declare(strict_types=1);

use Modules\Admin\Config\Admin;

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'label' => 'roll-istor',
    config(Admin::class)
        ->gateway => 'Degemer',
    'podcasts' => 'podkastoù',
    'episodes' => 'rannoù',
    'subscriptions' => 'koumanantoù',
    'contributors' => 'perzhidi, perzhiadezed',
    'pages' => 'pajennoù',
    'settings' => 'arventennoù',
    'theme' => 'neuz',
    'about' => 'a-zivout',
    'add' => 'ouzhpennañ',
    'new' => 'krouiñ',
    'edit' => 'kemmañ',
    'persons' => 'emellerien·ezed',
    'publish' => 'embann',
    'publish-edit' => 'kemmañ an embannadur',
    'publish-date-edit' => 'kemmañ deiziad an embannadur',
    'unpublish' => 'diembannañ',
    'delete' => 'dilemel',
    'remove' => 'lemel',
    'fediverse' => 'kevrebed',
    'blocked-actors' => 'aktourien·ezed stanket',
    'blocked-domains' => 'domanioù stanket',
    'users' => 'implijerien·ezed',
    'my-account' => 'ma c\'hont',
    'change-password' => 'kemmañ ar ger-tremen',
    'imports' => 'enporzhiadennoù',
    'sync-feeds' => 'sinkronekaat ar gwazhoù',
    'platforms' => 'savennoù',
    'social' => 'rouedadoù sokial',
    'funding' => 'arc\'hantaouiñ',
    'monetization-other' => 'doare arc\'hantaouiñ all',
    'analytics' => 'muzulioù heklev',
    'locations' => 'lec\'hioù',
    'webpages' => 'pajennoù web',
    'unique-listeners' => 'selaouerien·ezed unel',
    'players' => 'lennerioù',
    'listening-time' => 'padelezh ar selaou',
    'time-periods' => 'mareoù ar selaou',
    'soundbites' => 'tennadoù son',
    'video-clips' => 'klipoù video',
    'embed' => 'lenner enkorfet',
    'notifications' => 'kemennoù',
    'suspend' => 'ehanañ',
];
