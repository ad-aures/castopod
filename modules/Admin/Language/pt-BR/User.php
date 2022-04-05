<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_roles' => "Editar cargos de {username}",
    'forcePassReset' => 'Forçar redefinição da senha',
    'ban' => 'Banir',
    'unban' => 'Desbanir',
    'delete' => 'Excluir',
    'create' => 'Novo usuário',
    'view' => "Informações de {username}",
    'all_users' => 'Todos os usuários',
    'list' => [
        'user' => 'Usuário',
        'roles' => 'Cargos',
        'banned' => 'Banido?',
    ],
    'form' => [
        'email' => 'E-mail',
        'username' => 'Nome de usuário',
        'password' => 'Senha',
        'new_password' => 'Nova Senha',
        'roles' => 'Cargos',
        'permissions' => 'Permissões',
        'submit_create' => 'Criar usuário',
        'submit_edit' => 'Salvar',
        'submit_password_change' => 'Alterar!',
    ],
    'roles' => [
        'superadmin' => 'Super admin',
    ],
    'messages' => [
        'createSuccess' =>
            'Usuário criado com sucesso! {username} terá que alterar sua senha na primeira autenticação.',
        'rolesEditSuccess' =>
            "Cargos de {username} foram atualizados com sucesso.",
        'forcePassResetSuccess' =>
            '{username} precisará alterar sua senha na próxima visita.',
        'banSuccess' => '{username} foi banido.',
        'unbanSuccess' => '{username} foi desbanido.',
        'banSuperAdminError' =>
            '{username} é um super admin, não bloqueamos um super admin assim…',
        'deleteSuperAdminError' =>
            '{username} é um super admin, você não exclui um super admin assim…',
        'deleteSuccess' => '{username} foi excluído.',
    ],
];
