<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'your_handle' => 'Ваш аккаунт',
    'your_handle_hint' => 'Введите @имя@домен, с которого вы хотите работать.',
    'follow' => [
        'label' => 'Подписаться',
        'title' => 'Подписаться на {actorDisplayName}',
        'subtitle' => 'Вы собираетесь подписаться:',
        'accountNotFound' => 'Не удалось найти учетную запись.',
        'remoteFollowNotAllowed' => 'Похоже, что сервер учетной записи не разрешает авторизацию/подписку…',
        'submit' => 'Продолжить подписку',
    ],
    'favourite' => [
        'title' => "Избранный пост от {actorDisplayName}",
        'subtitle' => 'Вы собираетесь добавить в избранное:',
        'submit' => 'Перейти к избранному',
    ],
    'reblog' => [
        'title' => "Поделиться постом от {actorDisplayName}",
        'subtitle' => 'Вы собираетесь поделиться:',
        'submit' => 'Продолжить делиться',
    ],
    'reply' => [
        'title' => "Ответить на пост от {actorDisplayName}",
        'subtitle' => 'Вы собираетесь ответить на:',
        'submit' => 'Перейти к ответу',
    ],
];
