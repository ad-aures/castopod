<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Endre rollene til {username}",
    'ban' => 'Steng ute',
    'unban' => 'Slepp inn att',
    'delete' => 'Slett',
    'create' => 'Ny brukar',
    'view' => "{username} sin informasjon",
    'all_users' => 'Alle brukarane',
    'list' => [
        'user' => 'Brukar',
        'role' => 'Rolle',
        'banned' => 'Utestengd?',
    ],
    'form' => [
        'email' => 'Epost',
        'username' => 'Brukarnamn',
        'password' => 'Passord',
        'new_password' => 'Nytt passord',
        'role' => 'Rolle',
        'roles' => 'Roller',
        'permissions' => 'Løyve',
        'submit_create' => 'Lag brukar',
        'submit_edit' => 'Lagre',
        'submit_password_change' => 'Endre!',
    ],
    'delete_form' => [
        'title' => 'Slett {user}',
        'disclaimer' =>
            "Du er i ferd med å sletta {user} for alltid. Dei vil ikkje få tilgang til styringspanelet lenger.",
        'understand' => 'Eg forstår, og vil sletta {user} for alltid',
        'submit' => 'Slett',
    ],
    'messages' => [
        'createSuccess' =>
            'Brukaren er oppretta! {username} vil få spørsmål om å endra passord fyrste gong hen loggar inn.',
        'roleEditSuccess' =>
            "Rollene til {username} er oppdaterte.",
        'banSuccess' => '{username} er utestengd.',
        'unbanSuccess' => '{username} fekk sleppa inn att.',
        'editOwnerError' =>
            '{username} is the instance owner, you cannot edit its roles.',
        'banSuperAdminError' =>
            '{username} er superstyrar, og du stengjer ikkje ute ein superstyrar…',
        'deleteOwnerError' =>
            '{username} eig nettstaden. Du kan ikkje berre sletta eigaren…',
        'deleteSuperAdminError' =>
            '{username} er superstyrar, og du slettar ikkje ein superstyrar…',
        'deleteSuccess' => '{username} er sletta.',
    ],
];
