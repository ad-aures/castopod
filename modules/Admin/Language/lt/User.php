<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_roles' => "Keisti {username} roles",
    'forcePassReset' => 'Reikalauti pasikeisti slaptažodį',
    'ban' => 'Blokuoti',
    'unban' => 'Atblokuoti',
    'delete' => 'Šalinti',
    'create' => 'Naujas naudotojas',
    'view' => "{username} duomenys",
    'all_users' => 'Visi naudotojai',
    'list' => [
        'user' => 'Naudotojas',
        'roles' => 'Rolės',
        'banned' => 'Užblokuotas?',
    ],
    'form' => [
        'email' => 'El. paštas',
        'username' => 'Naudotojo vardas',
        'password' => 'Slaptažodis',
        'new_password' => 'Naujas slaptažodis',
        'roles' => 'Rolės',
        'permissions' => 'Leidimai',
        'submit_create' => 'Kurti naudotoją',
        'submit_edit' => 'Įrašyti',
        'submit_password_change' => 'Pakeisti!',
    ],
    'roles' => [
        'superadmin' => 'Superadministratorius',
    ],
    'messages' => [
        'createSuccess' =>
            'Naudotojas sukurtas sėkmingai! {username} privalės pasikeisti slaptažodį, kai primąkart prisijungs.',
        'rolesEditSuccess' =>
            "{username} rolės sėkmingai atnaujintos.",
        'forcePassResetSuccess' =>
            '{username} privalės pasikeisti slaptažodį, kai kišąkart prisijungs.',
        'banSuccess' => 'Paskyra {username} užblokuota.',
        'unbanSuccess' => 'Paskyra {username} atblokuota.',
        'editOwnerError' =>
            'Paskyra {username} priklauso šio serverio savininkui, jos rolių keisti negalite.',
        'banSuperAdminError' =>
            'Paskyra {username} priklauso superadministratoriui. Jos užblokuoti negalima.',
        'deleteSuperAdminError' =>
            'Paskyra {username} priklauso superadministratoriui, jos pašalinti negalima.',
        'deleteSuccess' => 'Paskyra {username} pašalinta.',
    ],
];
