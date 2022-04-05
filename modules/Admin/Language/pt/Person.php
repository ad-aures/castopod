<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'persons' => 'Pessoas',
    'all_persons' => 'Todas as pessoas',
    'no_person' => 'Ninguém encontrado!',
    'create' => 'Criar uma pessoa',
    'view' => 'Visualizar pessoa',
    'edit' => 'Editar pessoa',
    'delete' => 'Excluir pessoa',
    'messages' => [
        'createSuccess' => 'Pessoa criada com sucesso!',
        'editSuccess' => 'Pessoa foi atualizada com sucesso!',
        'deleteSuccess' => 'Pessoa foi removida!',
    ],
    'form' => [
        'avatar' => 'Avatar',
        'avatar_size_hint' =>
            'Avatar deve ser quadrado com pelo menos 400px de largura e altura.',
        'full_name' => 'Nome completo',
        'full_name_hint' => 'Este é o nome completo ou apelido da pessoa.',
        'unique_name' => 'Nome único',
        'unique_name_hint' => 'Utilizado para URLs',
        'information_url' => 'URL de informação',
        'information_url_hint' =>
            'URL para um recurso relevante de informações sobre a pessoa, como uma página inicial ou uma plataforma de perfil de terceiros.',
        'submit_create' => 'Criar pessoa',
        'submit_edit' => 'Salvar pessoa',
    ],
    'podcast_form' => [
        'title' => 'Gerenciar pessoas',
        'add_section_title' => 'Adicionar pessoas a este podcast',
        'add_section_subtitle' => 'Você pode escolher várias pessoas e cargos.',
        'persons' => 'Pessoas',
        'persons_hint' =>
            'Você pode selecionar uma ou várias pessoas com as mesmas funções. Você precisa primeiro criar as pessoas.',
        'roles' => 'Cargos',
        'roles_hint' =>
            'Você pode selecionar nenhum, um ou vários cargos para uma pessoa.',
        'submit_add' => 'Adicionar pessoa(s)',
        'remove' => 'Remover',
    ],
    'episode_form' => [
        'title' => 'Gerenciar pessoas',
        'add_section_title' => 'Adicionar pessoas a este episódio',
        'add_section_subtitle' => 'Você pode escolher várias pessoas e cargos.',
        'persons' => 'Pessoas',
        'persons_hint' =>
            'Você pode selecionar uma ou várias pessoas com os mesmos cargos. Você precisa primeiro criar as pessoas.',
        'roles' => 'Cargos',
        'roles_hint' =>
            'Você pode selecionar nenhum, um ou vários cargos para uma pessoa.',
        'submit_add' => 'Adicionar pessoa(s)',
        'remove' => 'Remover',
    ],
    'credits' => 'Créditos',
];
