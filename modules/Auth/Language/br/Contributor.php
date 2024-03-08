<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Perzhidi ha perzhiadezed ar podkast',
    'view' => "Perzh {username} e {podcastTitle}",
    'add' => 'Ouzhpennañ ur perzhiad pe ur berzhiadez',
    'add_contributor' => 'Ouzhpennañ ur perzhiad pe ur berzhiadez da {0}',
    'edit_role' => 'Nevesaat roll {0}',
    'edit' => 'Kemmañ',
    'remove' => 'Lemel',
    'list' => [
        'username' => 'Anv implijer·ez',
        'role' => 'Roll',
    ],
    'form' => [
        'user' => 'Implijer·ez',
        'user_placeholder' => 'Dibabit un implijer·ez…',
        'role' => 'Roll',
        'role_placeholder' => 'Dibabit e·he roll…',
        'submit_add' => 'Ouzhpennañ ur perzhiad pe ur berzhiadez',
        'submit_edit' => 'Nevesaat ar roll',
    ],
    'delete_form' => [
        'title' => 'Dilemel {contributor}',
        'disclaimer' =>
            'Emaoc\'h o vont da lemel {contributor} eus ar berzhidi/perzhiadezed. Ne c\'hallo ket gwelet "{podcastTitle}" ken.',
        'understand' => 'Komprenet em eus. Fellout a ra din lemel {contributor} eus "{podcastTitle}"',
        'submit' => 'Lemel',
    ],
    'messages' => [
        'editSuccess' => 'Cheñchet eo bet ar roll gant berzh!',
        'editOwnerError' => "Ne c'hellit ket kemmañ perc'henn·ez ar podkast!",
        'removeOwnerError' => "Ne c'hellit ket lemel perc'henn ar podkast!",
        'removeSuccess' =>
            'Lamet ho peus {username} diouzh {podcastTitle} gant berzh',
        'alreadyAddedError' =>
            "Ar perzhiad pe ar berzhiadez emaoc'h o klask ouzhpennañ zo bet ouzhpennet dija!",
    ],
];
