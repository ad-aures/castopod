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
            'title' => 'Propietari de la instància',
            'description' => 'Propietari del Castopod.',
        ],
        'superadmin' => [
            'title' => 'Super administrador',
            'description' => 'Té control complet sobre Castopod.',
        ],
        'manager' => [
            'title' => 'Administrador',
            'description' => 'Administra el contingut de Castopod.',
        ],
        'podcaster' => [
            'title' => 'Podcaster',
            'description' => 'Usos generals de Castopod.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Pot accedir a l\'àrea d\'administració de Castopod.',
        'admin.settings' => 'Pot accedir a la configuració de Castopod.',
        'users.manage' => 'Pot administrar els usuaris de Castopod.',
        'persons.manage' => 'Pot administrar persones.',
        'pages.manage' => 'Pot administrar pàgines.',
        'podcasts.view' => 'Pot veure els pòdcasts.',
        'podcasts.create' => 'Pot crear nous pòdcasts.',
        'podcasts.import' => 'Pot importar pòdcasts.',
        'fediverse.manage-blocks' => 'Pot evitar que actors/dominis del fedivers interactuen amb Castopod.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Propietari del pòdcast',
            'description' => 'El propietari del pòdcast.',
        ],
        'admin' => [
            'title' => 'Administrador',
            'description' => 'Té control complet del pòdcast #{id}.',
        ],
        'editor' => [
            'title' => 'Editor',
            'description' => 'Administra els continguts i la publicació del pòdcast #{id}.',
        ],
        'author' => [
            'title' => 'Autor',
            'description' => 'Administra el contingut del podcast #{id} però no el pot publicar.',
        ],
        'guest' => [
            'title' => 'Convidat',
            'description' => 'Col·laborador general del podcast #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Pot veure el tauler i les estadístiques del podcast #{id}.',
        'edit' => 'Pot editar el podcast #{id}.',
        'delete' => 'Pot suprimir el podcast #{id}.',
        'manage-import' => 'Pot sincronitzar el podcast importat #{id}.',
        'manage-persons' => 'Pot gestionar les subscripcions del podcast #{id}.',
        'manage-subscriptions' => 'Pot gestionar les subscripcions del podcast #{id}.',
        'manage-contributors' => 'Pot gestionar els col·laboradors del podcast #{id}.',
        'manage-platforms' => 'Pot establir/eliminar enllaços de plataforma del podcast #{id}.',
        'manage-publications' => 'Pot publicar el podcast #{id}.',
        'manage-notifications' => 'Pot veure i marcar les notificacions com a llegides per al podcast #{id}.',
        'interact-as' => 'Pot interactuar en nom del podcast #{id} per marcar les publicacions com a preferides, compartir-les o respondre-hi.',
        'episodes' => [
            'view' => 'Pot veure taulers i estadístiques dels episodis del podcast #{id}.',
            'create' => 'Pot crear episodis per al podcast #{id}.',
            'edit' => 'Pot editar episodis del podcast #{id}.',
            'delete' => 'Pot suprimir episodis del podcast #{id}.',
            'manage-persons' => 'Pot gestionar persones d\'episodi del podcast #{id}.',
            'manage-clips' => 'Pot gestionar clips de vídeo o fragments de so del pòdcast #{id}.',
            'manage-publications' => 'Pot publicar/anul·lar la publicació d\'episodis i publicacions del pòdcast #{id}.',
            'manage-comments' => 'Pot crear/eliminar comentaris d\'episodi del pòdcast #{id}.',
        ],
    ],

    // missing keys
    'code' => 'El teu codi de 6 dígits',

    'set_password' => 'Estableix la teva contrasenya',

    // Welcome email
    'welcomeSubject' => 'Has estat convidat a {siteName}',
    'emailWelcomeMailBody' => 'S\'ha creat un compte per a tu a {domain}, fes clic a l\'enllaç d\'inici de sessió següent per configurar la teva contrasenya. L\'enllaç és vàlid durant {numberOfHours} hores després de l\'hora d\'enviament d\'aquest correu electrònic.',
];
