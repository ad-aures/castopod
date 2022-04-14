<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_roles' => "Endre rollene til {username}",
    'forcePassReset' => 'Tving passordnullstilling',
    'ban' => 'Steng ute',
    'unban' => 'Slepp inn att',
    'delete' => 'Slett',
    'create' => 'Ny brukar',
    'view' => "{username} sin informasjon",
    'all_users' => 'Alle brukarane',
    'list' => [
        'user' => 'Brukar',
        'roles' => 'Roller',
        'banned' => 'Utestengd?',
    ],
    'form' => [
        'email' => 'Epost',
        'username' => 'Brukarnamn',
        'password' => 'Passord',
        'new_password' => 'Nytt passord',
        'roles' => 'Roller',
        'permissions' => 'Løyve',
        'submit_create' => 'Lag brukar',
        'submit_edit' => 'Lagre',
        'submit_password_change' => 'Endre!',
    ],
    'roles' => [
        'superadmin' => 'Superstyrar',
    ],
    'messages' => [
        'createSuccess' =>
            'Brukaren er oppretta! {username} vil få spørsmål om å endra passord fyrste gong hen loggar inn.',
        'rolesEditSuccess' =>
            "Rollene til {username} er oppdaterte.",
        'forcePassResetSuccess' =>
            '{username} vil bli beden om å endra passord neste gong hen loggar inn.',
        'banSuccess' => '{username} er utestengd.',
        'unbanSuccess' => '{username} fekk sleppa inn att.',
        'banSuperAdminError' =>
            '{username} er superstyrar, og du stengjer ikkje ute ein superstyrar…',
        'deleteSuperAdminError' =>
            '{username} er superstyrar, og du slettar ikkje ein superstyrar…',
        'deleteSuccess' => '{username} er sletta.',
    ],
];
