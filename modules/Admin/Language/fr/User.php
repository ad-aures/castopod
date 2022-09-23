<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_roles' => "Modifier les rôles de {username}",
    'forcePassReset' => 'Forcer la réinitialisation du mot de passe',
    'ban' => 'Bloquer',
    'unban' => 'Débloquer',
    'delete' => 'Supprimer',
    'create' => 'Créer un utilisateur',
    'view' => "Informations de {username}",
    'all_users' => 'Tous les utilisateurs',
    'list' => [
        'user' => 'Utilisateurs',
        'roles' => 'Rôles',
        'banned' => 'Bloqué ?',
    ],
    'form' => [
        'email' => 'E-mail',
        'username' => 'Identifiant',
        'password' => 'Mot de passe',
        'new_password' => 'Nouveau mot de passe',
        'roles' => 'Rôles',
        'permissions' => 'Permissions',
        'submit_create' => 'Créer un utilisateur',
        'submit_edit' => 'Enregistrer',
        'submit_password_change' => 'Valider !',
    ],
    'roles' => [
        'superadmin' => 'Super-utilisateur',
    ],
    'messages' => [
        'createSuccess' =>
            'Utilisateur créé avec succès ! {username} devra modifier son mot de passe à la première authentification.',
        'rolesEditSuccess' =>
            "Les rôles de {username} ont été mis à jour avec succès.",
        'forcePassResetSuccess' =>
            '{username} devra modifier son mot de passe à la prochaine visite.',
        'banSuccess' => '{username} a été bloqué.',
        'unbanSuccess' => '{username} a été débloqué.',
        'editOwnerError' =>
            '{username} is the instance owner, you cannot edit its roles.',
        'banSuperAdminError' =>
            '{username} est un super-utilisateur, on ne bloque pas un super-utilisateur comme ça…',
        'deleteSuperAdminError' =>
            '{username} est un super-utilisateur, on ne supprime pas un super-utilisateur comme ça…',
        'deleteSuccess' => '{username} a été supprimé.',
    ],
];
