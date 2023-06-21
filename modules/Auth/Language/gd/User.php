<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Deasaich an dreuchd aig {username}",
    'ban' => 'Toirmisg',
    'unban' => 'Dì-thoirmisg',
    'delete' => 'Sguab às',
    'create' => 'Cleachdaiche ùr',
    'view' => "Am fiosrachadh aig {username}",
    'all_users' => 'A h-uile cleachdaiche',
    'list' => [
        'user' => 'Cleachdaiche',
        'role' => 'Dreuchd',
        'banned' => 'Air a thoirmeasg?',
    ],
    'form' => [
        'email' => 'Post-d',
        'username' => 'Ainm-cleachdaiche',
        'password' => 'Facal-faire',
        'new_password' => 'Am facal-faire ùr',
        'role' => 'Dreuchd',
        'roles' => 'Dreuchdan',
        'permissions' => 'Ceadan',
        'submit_create' => 'Cruthaich cleachdaiche',
        'submit_edit' => 'Sàbhail',
        'submit_password_change' => 'Atharraich!',
    ],
    'delete_form' => [
        'title' => 'Sguab às {user}',
        'disclaimer' =>
            "Tha thu an impis {user} a sguabadh às gu buan. Chan urrainn dhaibh raon na rianachd inntrigeadh tuilleadh an uairsin.",
        'understand' => 'Tha mi agaibh, tha mi airson {user} a sguabadh às gu buan',
        'submit' => 'Sguab às',
    ],
    'messages' => [
        'createSuccess' =>
            'Chaidh an cleachdaiche a chruthachadh! Chaidh post-d fàilteachaidh a chur gu {username} le ceangal clàraidh a-steach, thèid iarraidh orra gun ath-shuidhich iad am facal-faire aca a’ chiad turas a nì iad dearbhadh.',
        'roleEditSuccess' =>
            "Chaidh na dreuchdan aig {username} ùrachadh.",
        'banSuccess' => 'Chaidh {username} a thoirmeasg.',
        'unbanSuccess' => 'Chaidh {username} a dhì-thoirmeasg.',
        'editOwnerError' =>
            'Is {username} sealbhadair an ionstans, na bean ris an t-sealbhadair…',
        'banSuperAdminError' =>
            'Tha {username} ’na shàr-rianaire, na toirmisg sàr-rianaire…',
        'deleteOwnerError' =>
            'Is {username} sealbhadair an ionstans, na sguab às an sealbhadair…',
        'deleteSuperAdminError' =>
            'Tha {username} ’na shàr-rianaire, na sguab às sàr-rianaire…',
        'deleteSuccess' => 'Chaidh {username} a sguabadh às.',
    ],
];
