<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Edit {username}'s role",
    'ban' => 'Banir',
    'unban' => 'Desbanir',
    'delete' => 'Excluir',
    'create' => 'Novo usuário',
    'view' => "Informações de {username}",
    'all_users' => 'Todos os usuários',
    'list' => [
        'user' => 'Usuário',
        'role' => 'Role',
        'banned' => 'Banido?',
    ],
    'form' => [
        'email' => 'E-mail',
        'username' => 'Nome de usuário',
        'password' => 'Senha',
        'new_password' => 'Nova Senha',
        'role' => 'Role',
        'roles' => 'Cargos',
        'permissions' => 'Permissões',
        'submit_create' => 'Criar usuário',
        'submit_edit' => 'Salvar',
        'submit_password_change' => 'Alterar!',
    ],
    'delete_form' => [
        'title' => 'Delete {user}',
        'disclaimer' =>
            "You are about to delete {user} permanently. They will not be able to access the admin area anymore.",
        'understand' => 'I understand, I want to delete {user} permanently',
        'submit' => 'Delete',
    ],
    'messages' => [
        'createSuccess' =>
            'Usuário criado com sucesso! {username} terá que alterar sua senha na primeira autenticação.',
        'roleEditSuccess' =>
            "Cargos de {username} foram atualizados com sucesso.",
        'banSuccess' => '{username} foi banido.',
        'unbanSuccess' => '{username} foi desbanido.',
        'editOwnerError' =>
            '{username} is the instance owner, you cannot edit its roles.',
        'banSuperAdminError' =>
            '{username} é um super admin, não bloqueamos um super admin assim…',
        'deleteOwnerError' =>
            '{username} is the instance owner, one does not simply delete the owner…',
        'deleteSuperAdminError' =>
            '{username} é um super admin, você não exclui um super admin assim…',
        'deleteSuccess' => '{username} foi excluído.',
    ],
];
