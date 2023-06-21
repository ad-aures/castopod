<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Luchd-cuideachaidh a’ phod-chraolaidh',
    'view' => "Na chuir {username} ri {podcastTitle}",
    'add' => 'Cuir neach-cuideachaidh ris',
    'add_contributor' => 'Cuir neach-cuideachaidh ris airson {0}',
    'edit_role' => 'Ùraich an dreuchd airson {0}',
    'edit' => 'Deasaich',
    'remove' => 'Thoir air falbh',
    'list' => [
        'username' => 'Ainm-cleachdaiche',
        'role' => 'Dreuchd',
    ],
    'form' => [
        'user' => 'Cleachdaiche',
        'user_placeholder' => 'Tagh cleachdaiche…',
        'role' => 'Dreuchd',
        'role_placeholder' => 'Tagh dreuchd dhaibh…',
        'submit_add' => 'Cuir neach-cuideachaidh ris',
        'submit_edit' => 'Ùraich an dreuchd',
    ],
    'delete_form' => [
        'title' => 'Thoir {contributor} air falbh',
        'disclaimer' =>
            'Tha thu an impis {contributor} a toirt air falbh on luchd-cuideachaidh. Chan urrainn dhaibh “{podcastTitle}” inntrigeadh tuilleadh an uairsin.',
        'understand' => 'Tha mi agaibh, tha mi airson {contributor} a thoirt air falbh o “{podcastTitle}”',
        'submit' => 'Thoir air falbh',
    ],
    'messages' => [
        'editSuccess' => 'Chaidh an dreuchd atharrachadh!',
        'editOwnerError' => "Chan urrainn dhut sealbhadair a’ phod-chraolaidh a dheasachadh!",
        'removeOwnerError' => "Chan urrainn dhut sealbhadair a’ phod-chraolaidh a thoirt air falbh!",
        'removeSuccess' =>
            'Thug thu {username} air falbh o {podcastTitle}',
        'alreadyAddedError' =>
            "Chaidh an neach-cuideachaidh a tha thu airson cur ris a chur ris mu thràth!",
    ],
];
