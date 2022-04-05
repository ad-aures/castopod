<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Contribuidores do Podcast',
    'view' => "Contribuição de {username} para {podcastTitle}",
    'add' => 'Adicionar contribuidor',
    'add_contributor' => 'Adicionar um contribuidor para {0}',
    'edit_role' => 'Atualizar cargo para {0}',
    'edit' => 'Editar',
    'remove' => 'Remover',
    'list' => [
        'username' => 'Nome de usuário',
        'role' => 'Cargo',
    ],
    'form' => [
        'user' => 'Usuário',
        'user_placeholder' => 'Selecione um usuário…',
        'role' => 'Cargo',
        'role_placeholder' => 'Selecione seu cargo…',
        'submit_add' => 'Adicionar contribuidor',
        'submit_edit' => 'Atualizar cargo',
    ],
    'roles' => [
        'podcast_admin' => 'Administrador do podcast',
    ],
    'messages' => [
        'removeOwnerError' => "Você não pode remover o dono do podcast!",
        'removeSuccess' =>
            'Você removeu {username} com sucesso de {podcastTitle}',
        'alreadyAddedError' =>
            "O contribuidor que você está tentando adicionar já foi adicionado!",
    ],
];
