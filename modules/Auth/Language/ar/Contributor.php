<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Podcast contributors',
    'view' => "{username}'s contribution to {podcastTitle}",
    'add' => 'إضافة مساهم',
    'add_contributor' => 'Add a contributor for {0}',
    'edit_role' => 'Update role for {0}',
    'edit' => 'تعديل',
    'remove' => 'إزالة',
    'list' => [
        'username' => 'اسم المستخدم',
        'role' => 'الدور',
    ],
    'form' => [
        'user' => 'مستخدم',
        'user_placeholder' => 'اختر مستخدمًا…',
        'role' => 'الدور',
        'role_placeholder' => 'اختر دوره…',
        'submit_add' => 'إضافة مساهم',
        'submit_edit' => 'حدّث الدور',
    ],
    'roles' => [
        'podcast_admin' => 'Podcast admin',
    ],
    'messages' => [
        'removeOwnerError' => "لا يمكنك إزالة صاحب البودكاست!",
        'removeSuccess' =>
            'You have successfully removed {username} from {podcastTitle}',
        'alreadyAddedError' =>
            "The contributor you're trying to add has already been added!",
    ],
];
