<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'instance_groups' => [
        'owner' => [
            'title' => 'Instância proprietário',
            'description' => 'O proprietário do Castopod.',
        ],
        'superadmin' => [
            'title' => 'Super administrador',
            'description' => 'Tem controle completo sobre Castopod.',
        ],
        'manager' => [
            'title' => 'Gerente',
            'description' => 'Gerencia o conteúdo de Castopod.',
        ],
        'podcaster' => [
            'title' => 'Podcaster',
            'description' => 'Usuários gerais do Castopod.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Pode acessar a área de administração do Castopod.',
        'admin.settings' => 'Pode acessar as configurações de Castopod.',
        'users.manage' => 'Pode gerenciar usuários do Castopod.',
        'persons.manage' => 'Pode gerenciar pessoas.',
        'pages.manage' => 'Pode gerenciar páginas.',
        'podcasts.view' => 'Pode ver todos os podcasts.',
        'podcasts.create' => 'Pode criar novos podcasts.',
        'podcasts.import' => 'Pode importar podcasts.',
        'fediverse.manage-blocks' => 'Pode bloquear ator/domínios distintos de interagir com Castopod.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Dono do Podcast',
            'description' => 'O proprietário do podcast.',
        ],
        'admin' => [
            'title' => 'Administrador',
            'description' => 'Tem controle completo do podcast #{id}.',
        ],
        'editor' => [
            'title' => 'Editor',
            'description' => 'Gerencia o conteúdo e as publicações do podcast #{id}.',
        ],
        'author' => [
            'title' => 'Autor',
            'description' => 'Gerencia o conteúdo do podcast #{id} mas não pode publicá-los.',
        ],
        'guest' => [
            'title' => 'Convidado',
            'description' => 'Contribuidor geral do podcast #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Pode visualizar o painel de controle e análises do podcast #{id}.',
        'edit' => 'Pode editar o podcast #{id}.',
        'delete' => 'Pode deletar episódios do podcast #{id}.',
        'manage-import' => 'Pode sincronizar o podcast importado #{id}.',
        'manage-persons' => 'Pode gerenciar assinaturas do podcast #{id}.',
        'manage-subscriptions' => 'Pode gerenciar assinaturas do podcast #{id}.',
        'manage-contributors' => 'Pode gerenciar contribuidores do podcast #{id}.',
        'manage-platforms' => 'Pode definir/remover links de plataforma do podcast #{id}.',
        'manage-publications' => 'Pode publicar podcast #{id}.',
        'manage-notifications' => 'Pode ver e marcar notificações como lidas para o podcast #{id}.',
        'interact-as' => 'Pode interagir com o podcast #{id} para favorito, compartilhar ou responder às publicações.',
        'episodes.view' => 'Pode ver painéis e análises de episódios de podcast #{id}.',
        'episodes.create' => 'Pode criar episódios para o podcast #{id}.',
        'episodes.edit' => 'Pode editar episódios de podcast #{id}.',
        'episodes.delete' => 'Pode excluir episódios do podcast #{id}.',
        'episodes.manage-persons' => 'Pode gerenciar pessoas de episódios do podcast #{id}.',
        'episodes.manage-clips' => 'Pode gerenciar clipes de vídeo ou sons de episódios do podcast #{id}.',
        'episodes.manage-publications' => 'Pode publicar/remover a publicação de episódios e postagens de podcast #{id}.',
        'episodes.manage-comments' => 'Pode criar/remover comentários de episódio do podcast #{id}.',
    ],

    // missing keys
    'code' => 'Seu código de 6 dígitos',

    'set_password' => 'Defina sua senha',

    // Welcome email
    'welcomeSubject' => 'Você foi convidado(a) para o {siteName}',
    'emailWelcomeMailBody' => 'Uma conta foi criada para você no {domain}, clique no link de login abaixo para definir sua senha. O link é válido por {numberOfHours} horas após o envio deste e-mail.',
];
