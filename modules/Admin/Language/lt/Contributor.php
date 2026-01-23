<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Tinklalaidės talkininkai',
    'view' => "{username} indėlis į „{podcastTitle}“",
    'add' => 'Pridėti talkininką',
    'add_contributor' => 'Pridėti „{0}“ talkininką',
    'edit_role' => 'Atnaujinti {0} rolę',
    'edit' => 'Taisyti',
    'remove' => 'Šalinti',
    'list' => [
        'username' => 'Naudotojo vardas',
        'role' => 'Rolė',
    ],
    'form' => [
        'user' => 'Naudotojas',
        'user_placeholder' => 'Pasirinkite naudotoją…',
        'role' => 'Rolė',
        'role_placeholder' => 'Pasirinkite rolę…',
        'submit_add' => 'Pridėti talkininką',
        'submit_edit' => 'Atnaujinti rolę',
    ],
    'roles' => [
        'podcast_admin' => 'Tinklalaidės administratorius',
    ],
    'messages' => [
        'removeOwnerError' => "Tinklalaidės savininko pašalinti negalite!",
        'removeSuccess' =>
            '{username} pašalinta(s) iš „{podcastTitle}“',
        'alreadyAddedError' =>
            "Bandomas pridėti talkininkas jau ir taip pridėtas!",
    ],
];
