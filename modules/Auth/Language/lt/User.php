<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Keisti {username} roles",
    'ban' => 'Blokuoti',
    'unban' => 'Atblokuoti',
    'delete' => 'Šalinti',
    'create' => 'Naujas naudotojas',
    'view' => "{username} duomenys",
    'all_users' => 'Visi naudotojai',
    'list' => [
        'user' => 'Naudotojas',
        'role' => 'Rolė',
        'banned' => 'Užblokuotas?',
    ],
    'form' => [
        'email' => 'El. paštas',
        'username' => 'Naudotojo vardas',
        'password' => 'Slaptažodis',
        'new_password' => 'Naujas slaptažodis',
        'role' => 'Rolė',
        'roles' => 'Rolės',
        'permissions' => 'Leidimai',
        'submit_create' => 'Kurti naudotoją',
        'submit_edit' => 'Įrašyti',
        'submit_password_change' => 'Pakeisti!',
    ],
    'delete_form' => [
        'title' => 'Šalinti {user}',
        'disclaimer' =>
            "Ketinate visam laikui pašalinti {user} paskyrą. Šis asmuo nebegalės pasiekti administratoriaus srities.",
        'understand' => 'Suprantu, noriu pašalinti {user} visam laikui',
        'submit' => 'Šalinti',
    ],
    'messages' => [
        'createSuccess' =>
            'Naudotojo paskyra {username} sėkmingai sukurta! Jos savininkui(-ei) nusiųstas el. laiškas su prisijungimo nuoroda. Pirmo prisijungimo metu jis (ji) turės pasikeisti slaptažodį.',
        'roleEditSuccess' =>
            "{username} rolės sėkmingai atnaujintos.",
        'banSuccess' => 'Paskyra {username} užblokuota.',
        'unbanSuccess' => 'Paskyra {username} atblokuota.',
        'editOwnerError' =>
            'Paskyra {username} priklauso šio serverio savininkui, jos keisti negalite.',
        'banSuperAdminError' =>
            'Paskyra {username} priklauso superadministratoriui. Jos užblokuoti negalite.',
        'deleteOwnerError' =>
            'Paskyra {username} priklauso šio serverio savininkui, jos pašalinti negalite.',
        'deleteSuperAdminError' =>
            'Paskyra {username} priklauso superadministratoriui, jos pašalinti negalite.',
        'deleteSuccess' => 'Paskyra {username} pašalinta.',
    ],
];
