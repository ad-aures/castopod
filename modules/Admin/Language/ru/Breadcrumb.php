<?php

declare(strict_types=1);

use Modules\Admin\Config\Admin;

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'label' => 'навигационная цепочка',
    config(Admin::class)
        ->gateway => 'Главная',
    'podcasts' => 'подкасты',
    'episodes' => 'выпуски',
    'subscriptions' => 'subscriptions',
    'contributors' => 'участников',
    'pages' => 'страниц',
    'settings' => 'настройки',
    'theme' => 'тема',
    'about' => 'about',
    'add' => 'добавить',
    'new' => 'новая',
    'edit' => 'изменить',
    'persons' => 'лица',
    'publish' => 'публикация',
    'publish-edit' => 'редактировать публикацию',
    'publish-date-edit' => 'edit publication date',
    'unpublish' => 'снять с публикации',
    'delete' => 'удалить',
    'remove' => 'remove',
    'fediverse' => 'Федивёрс',
    'blocked-actors' => 'blocked actors',
    'blocked-domains' => 'blocked domains',
    'users' => 'пользователи',
    'my-account' => 'мой аккаунт',
    'change-password' => 'сменить пароль',
    'imports' => 'imports',
    'platforms' => 'платформы',
    'social' => 'социальные сети',
    'funding' => 'финансирование',
    'analytics' => 'аналитика',
    'locations' => 'расположение',
    'webpages' => 'веб-страницы',
    'unique-listeners' => 'уникальные слушатели',
    'players' => 'проигрыватели',
    'listening-time' => 'время прослушивания',
    'time-periods' => 'период',
    'soundbites' => 'звуковые фрагменты',
    'video-clips' => 'видео клипы',
    'embed' => 'встроенный плеер',
    'notifications' => 'notifications',
    'suspend' => 'suspend',
];
