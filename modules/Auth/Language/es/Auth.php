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
            'title' => 'Propietario de Instancia',
            'description' => 'Propietario de Castopod.',
        ],
        'superadmin' => [
            'title' => 'Super administrador',
            'description' => 'Tiene control completo sobre Castopod.',
        ],
        'manager' => [
            'title' => 'Administrador',
            'description' => 'Administrar contenido de Castopod.',
        ],
        'podcaster' => [
            'title' => 'Podcaster',
            'description' => 'Usuarios generales de Castopod.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Puedes acceder al área de administración de Castopod.',
        'admin.settings' => 'Puede acceder a la configuración de Castopod.',
        'users.manage' => 'Puede administrar usuarios de Castopod.',
        'persons.manage' => 'Puede administrar personas.',
        'pages.manage' => 'Puede administrar páginas.',
        'podcasts.view' => 'Puede ver todos los podcasts.',
        'podcasts.create' => 'Puede crear nuevos podcasts.',
        'podcasts.import' => 'Puede importar podcasts.',
        'fediverse.manage-blocks' => 'Puedes bloquear la interacción de actores/dominios del fediverso con Castopod.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Propietario de Podcast',
            'description' => 'El propietario del podcast.',
        ],
        'admin' => [
            'title' => 'Administrador',
            'description' => 'Tiene el control completo del podcast #{id}.',
        ],
        'editor' => [
            'title' => 'Editor',
            'description' => 'Gestiona el contenido y las publicaciones del podcast #{id}.',
        ],
        'author' => [
            'title' => 'Autor',
            'description' => 'Gestiona el contenido del podcast #{id} pero no puede publicarlo.',
        ],
        'guest' => [
            'title' => 'Invitado',
            'description' => 'Colaborador general del podcast #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Puede ver el panel de control y analíticas del episodio #{id}.',
        'edit' => 'Puede editar el podcast #{id}.',
        'delete' => 'Puede borrar el podcast #{id}.',
        'manage-import' => 'Puede sincronizar el podcast importado #{id}.',
        'manage-persons' => 'Puede administrar las suscripciones del podcast #{id}.',
        'manage-subscriptions' => 'Puede administrar las suscripciones del podcast #{id}.',
        'manage-contributors' => 'Puede administrar colaboradores del podcast #{id}.',
        'manage-platforms' => 'Puede establecer/eliminar enlaces a la plataforma del podcast #{id}.',
        'manage-publications' => 'Puede publicar el podcast #{id}.',
        'manage-notifications' => 'Puede ver y marcar las notificaciones como leídas para podcast #{id}.',
        'interact-as' => 'Puede interactuar como el podcast #{id} para marcar como favarito, compartir o responder a las publicaciones.',
        'episodes.view' => 'Puede ver el panel de control y analíticas del episodio #{id}.',
        'episodes.create' => 'Puede crear episodios para el podcast #{id}.',
        'episodes.edit' => 'Puede editar episodios del podcast #{id}.',
        'episodes.delete' => 'Puede borrar episodios del podcast #{id}.',
        'episodes.manage-persons' => 'Puede administrar las personas de los episodios del podcast #{id}.',
        'episodes.manage-clips' => 'Puedes administrar video clips o sonidos del podcast #{id}.',
        'episodes.manage-publications' => 'Puede publicar/despublicar episodios y publicaciones del podcast #{id}.',
        'episodes.manage-comments' => 'Puede crear/eliminar los comentarios de episodio del podcast #{id}.',
    ],

    // missing keys
    'code' => 'Introduce un código de 6 dígitos',

    'notEnoughPrivilege' => 'No tiene permisos suficientes para acceder a esa página.',
    'set_password' => 'Establece tu contraseña',

    // Welcome email
    'welcomeSubject' => 'Has sido invitado a {siteName}',
    'emailWelcomeMailBody' => 'An account was created for you on {domain}, click on the login link below to set your password. The link is valid for {numberOfHours} hours after this email was sent.',
];
