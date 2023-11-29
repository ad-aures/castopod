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
            'title' => 'Propriétaire de l\'instance',
            'description' => 'Le propriétaire du Castopod.',
        ],
        'superadmin' => [
            'title' => 'Super administrat·rice·eur',
            'description' => 'A un contrôle complet sur Castopod.',
        ],
        'manager' => [
            'title' => 'Gestionnaire',
            'description' => 'Gère le contenu de Castopod.',
        ],
        'podcaster' => [
            'title' => 'Podcast·rice·eur',
            'description' => 'Utilisateurs généraux de Castopod.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Peut accéder à la zone d\'administration Castopod.',
        'admin.settings' => 'Peut accéder aux paramètres de Castopod.',
        'users.manage' => 'Peut gérer les utilisateurs de Castopod.',
        'persons.manage' => 'Permet de gérer les personnes.',
        'pages.manage' => 'Permet de gérer les pages.',
        'podcasts.view' => 'Peut voir tous les podcasts.',
        'podcasts.create' => 'Peut créer de nouveaux podcasts.',
        'podcasts.import' => 'Peut importer des podcasts.',
        'fediverse.manage-blocks' => 'Peut empêcher des act·rice·eur·s/domaines d\'interagir avec Castopod.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Propriétaire du Podcast',
            'description' => 'Le/la propriétaire du podcast.',
        ],
        'admin' => [
            'title' => 'Administrateur',
            'description' => 'A un contrôle total sur le podcast #{id}.',
        ],
        'editor' => [
            'title' => 'Éditeur',
            'description' => 'Gère le contenu et les publications du podcast #{id}.',
        ],
        'author' => [
            'title' => 'Auteur / Autrice',
            'description' => 'Gère le contenu du podcast #{id} , mais ne peut pas le publier.',
        ],
        'guest' => [
            'title' => 'Invité',
            'description' => 'Contributeur général du podcast #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Peut voir le tableau de bord et les analyses du podcast #{id}.',
        'edit' => 'Peut éditer le podcast #{id}.',
        'delete' => 'Peut supprimer le podcast #{id}.',
        'manage-import' => 'Peut synchroniser le podcast importé #{id}.',
        'manage-persons' => 'Permet de gérer les abonnements au podcast #{id}.',
        'manage-subscriptions' => 'Permet de gérer les abonnements au podcast #{id}.',
        'manage-contributors' => 'Permet de gérer les contributeurs du podcast #{id}.',
        'manage-platforms' => 'Peut configurer/supprimer les liens de la plateforme du podcast #{id}.',
        'manage-publications' => 'Peut publier le podcast #{id}.',
        'manage-notifications' => 'Peut afficher et marquer les notifications comme lues pour le podcast #{id}.',
        'interact-as' => 'Peut interagir en tant que podcast #{id} pour mettre en favori, partager ou répondre aux messages.',
        'episodes.view' => 'Peut voir le tableau de bord et les statistiques du podcast #{id}.',
        'episodes.create' => 'Peut créer des épisodes pour le podcast #{id}.',
        'episodes.edit' => 'Peut modifier les épisodes du podcast #{id}.',
        'episodes.delete' => 'Peut supprimer les épisodes du podcast #{id}.',
        'episodes.manage-persons' => 'Peut gérer les intervenants des épisodes du podcast #{id}.',
        'episodes.manage-clips' => 'Permet de gérer les clips vidéo ou les parties sonores du podcast #{id}.',
        'episodes.manage-publications' => 'Peut publier/dépublier des épisodes et des messages de podcast #{id}.',
        'episodes.manage-comments' => 'Peut créer/supprimer les commentaires de l\'épisode du podcast #{id}.',
    ],

    // missing keys
    'code' => 'Votre code à 6 chiffres',

    'set_password' => 'Choisis ton mot de passe',

    // Welcome email
    'welcomeSubject' => 'Vous avez été invité·e à rejoindre {siteName}',
    'emailWelcomeMailBody' => 'Un compte a été créé pour vous sur {domain}, cliquez sur le lien de connexion ci-dessous pour définir votre mot de passe. Le lien est valide pendant {numberOfHours} heures après l\'envoi de cet e-mail.',
];
