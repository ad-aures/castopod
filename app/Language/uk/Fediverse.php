<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'your_handle' => 'Ваш псевдонім',
    'your_handle_hint' => 'Будь ласка, введіть @username@domain з яким ви хочете працювати.',
    'follow' => [
        'label' => 'Підписатися',
        'title' => 'Підписатись на {actorDisplayName}',
        'subtitle' => 'Ви збираєтеся підписатися:',
        'accountNotFound' => 'Ваш обліковий запис не знайдено.',
        'remoteFollowNotAllowed' => 'Схоже, сервер облікового запису не дозволяє підписатись…',
        'submit' => 'Перейти до підписки',
    ],
    'favourite' => [
        'title' => "Вибрана публікація {actorDisplayName}",
        'subtitle' => 'Ви збираєтеся підписатися:',
        'submit' => 'Перейти до улюбленого',
    ],
    'reblog' => [
        'title' => "Поділитися публікацією {actorDisplayName}",
        'subtitle' => 'Ви збираєтеся поділитись:',
        'submit' => 'Перейти до публікації',
    ],
    'reply' => [
        'title' => "Відповісти на пост {actorDisplayName}",
        'subtitle' => 'Ви збираєтеся відповісти на:',
        'submit' => 'Перейти до відповіді',
    ],
];
