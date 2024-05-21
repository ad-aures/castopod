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
            'title' => 'Propietaria da instancia',
            'description' => 'Propietaria de Castopod.',
        ],
        'superadmin' => [
            'title' => 'Super Admin',
            'description' => 'Ten control completo sobre Castopod.',
        ],
        'manager' => [
            'title' => 'Xestora',
            'description' => 'Quen xestiona o contido de Castopod.',
        ],
        'podcaster' => [
            'title' => 'Podcaster',
            'description' => 'Usuaria común de Castopod.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Pode acceder á área de administración.',
        'admin.settings' => 'Pode acceder aos axustes de Castopod.',
        'users.manage' => 'Pode xestionar as usuarias de Castopod.',
        'persons.manage' => 'Pode xestionar persoas.',
        'pages.manage' => 'Pode xestionar páxinas.',
        'podcasts.view' => 'Pode ver tódolos podcast.',
        'podcasts.create' => 'Pode crear novos podcast.',
        'podcasts.import' => 'Pode importar podcasts.',
        'fediverse.manage-blocks' => 'Pode bloquear actores/dominios do fediverso evitando interactuar con Castopod.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Dona do Podcast',
            'description' => 'A propietaria do podcast.',
        ],
        'admin' => [
            'title' => 'Admin',
            'description' => 'Ten control total sobre o podcast #{id}.',
        ],
        'editor' => [
            'title' => 'Editora',
            'description' => 'Persoa que xestiona o contido e publicacións do podcast #{id}.',
        ],
        'author' => [
            'title' => 'Autora',
            'description' => 'Persoa que xestiona o contido do podcast #{id} pero non pode publicalo.',
        ],
        'guest' => [
            'title' => 'Convidada',
            'description' => 'Contribuínte básico ao podcast #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Pode ver o taboleiro e estatísticas do podcast #{id}.',
        'edit' => 'Pode editar o podcast #{id}.',
        'delete' => 'Pode eliminar o podcast #{id}.',
        'manage-import' => 'Pode sincronizar o podcast importado #{id}.',
        'manage-persons' => 'Pode xestionar as subscricións do podcast #{id}.',
        'manage-subscriptions' => 'Pode xestionar as subscricións do podcast #{id}.',
        'manage-contributors' => 'Pode xestionar as contribucións ao podcast #{id}.',
        'manage-platforms' => 'Pode establecer/eliminar ligazóns a plataformas do podcast #{id}.',
        'manage-publications' => 'Pode publicar o podcast #{id}.',
        'manage-notifications' => 'Pode ver e marcar as notificacións como lidas no podcast #{id}.',
        'interact-as' => 'Pode actuar como o podcast #{id} para compartir, favorecer ou responder a publicacións.',
        'episodes' => [
            'view' => 'Pode ver os taboleiros e estatísticas dos episodios do podcast #{id}.',
            'create' => 'Pode crear episodios para o podcast #{id}.',
            'edit' => 'Pode editar os episodios do podcast #{id}.',
            'delete' => 'Pode eliminar episodios do podcast #{id}.',
            'manage-persons' => 'Pode xestionar as persoas do episodio do podcast #{id}.',
            'manage-clips' => 'Pode xestionar os clips de vídeo e extractos de audio do podcast #{id}.',
            'manage-publications' => 'Pode publicar/retirar episodios e publicacións do podcast #{id}.',
            'manage-comments' => 'Pode crear/eliminar comentarios dos episodios do podcast #{id}.',
        ],
    ],

    // missing keys
    'code' => 'Código de 6 díxitos',

    'set_password' => 'Establece un contrasinal',

    // Welcome email
    'welcomeSubject' => 'Recibiches un convite para {siteName}',
    'emailWelcomeMailBody' => 'Creouse unha conta para ti en {domain}, preme na ligazón inferior de acceso para establecer un contrasinal. A ligazón é válida durante {numberOfHours} horas desde que se enviou este email.',
];
