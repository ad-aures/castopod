<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Modifier le rôle de {username}",
    'ban' => 'Bloquer',
    'unban' => 'Débloquer',
    'delete' => 'Supprimer',
    'create' => 'Créer un utilisateur',
    'view' => "Informations de {username}",
    'all_users' => 'Tous les utilisateurs',
    'list' => [
        'user' => 'Utilisateurs',
        'role' => 'Rôle',
        'banned' => 'Bloqué ?',
    ],
    'form' => [
        'email' => 'E-mail',
        'username' => 'Identifiant',
        'password' => 'Mot de passe',
        'new_password' => 'Nouveau mot de passe',
        'role' => 'Rôle',
        'roles' => 'Rôles',
        'permissions' => 'Permissions',
        'submit_create' => 'Créer un utilisateur',
        'submit_edit' => 'Enregistrer',
        'submit_password_change' => 'Valider !',
    ],
    'delete_form' => [
        'title' => 'Supprimer {user}',
        'disclaimer' =>
            "Vous êtes sur le point de supprimer {user} définitivement. Ils ne pourront plus accéder à la zone d'administration.",
        'understand' => 'Je comprends, je veux supprimer {user} définitivement',
        'submit' => 'Supprimer',
    ],
    'messages' => [
        'createSuccess' =>
            'Utilisateur créé avec succès ! {username} devra modifier son mot de passe à la première authentification.',
        'roleEditSuccess' =>
            "Les rôles de {username} ont été mis à jour avec succès.",
        'banSuccess' => '{username} a été bloqué.',
        'unbanSuccess' => '{username} a été débloqué.',
        'editOwnerError' =>
            '{username} is the instance owner, you cannot edit its roles.',
        'banSuperAdminError' =>
            '{username} est un super-utilisateur, on ne bloque pas un super-utilisateur comme ça…',
        'deleteOwnerError' =>
            '{username} est le propriétaire de l\'instance, on ne supprime pas le propriétaire…',
        'deleteSuperAdminError' =>
            '{username} est un super-utilisateur, on ne supprime pas un super-utilisateur comme ça…',
        'deleteSuccess' => '{username} a été supprimé.',
    ],
];
