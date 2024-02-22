<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'banner' => [
        'disclaimer' => 'Importation',
        'text' => '{podcastTitle} est actuellement en cours d\'import.',
        'cta' => 'Voir l\'état d\'import',
    ],
    'old_podcast_section_title' => 'Le podcast à importer',
    'old_podcast_legal_disclaimer_title' => 'Avertissement légal',
    'old_podcast_legal_disclaimer' =>
        'Assurez-vous d’être détenteur des droits du podcast avant de l’importer. Copier et diffuser un podcast sans en détenir les droits est assimilable à de la contrefaçon et est passible de poursuites.',
    'imported_feed_url' => 'Adresse du flux',
    'imported_feed_url_hint' => 'Le flux doit être au format xml ou rss.',
    'new_podcast_section_title' => 'Le nouveau podcast',
    'lock_import' =>
        'Ce flux est protégé. Vous ne pouvez pas l’importer. Si en vous êtes le propriétaire, déverrouillez-le sur la plate-forme d’origine.',
    'submit' => 'Ajouter l\'import à la file d\'attente',
    'queue' => [
        'status' => [
            'label' => 'État',
            'queued' => 'en attente',
            'queued_hint' => 'L’import est dans la file d’attente.',
            'canceled' => 'annulé',
            'canceled_hint' => 'L’import a été annulé.',
            'running' => 'en cours',
            'running_hint' => 'L’import est en cours de traitement.',
            'failed' => 'échec',
            'failed_hint' => 'L’import n’a pas pu se terminer : échec du script.',
            'passed' => 'succès',
            'passed_hint' => 'L’import a été complété avec succès !',
        ],
        'feed' => 'Flux',
        'duration' => 'Durée de l’import',
        'imported_episodes' => 'Épisodes importés',
        'imported_episodes_hint' => '{newlyImportedCount} newly imported, {alreadyImportedCount} already imported.',
        'actions' => [
            'cancel' => 'Annuler',
            'retry' => 'Réessayer',
            'delete' => 'Supprimer',
        ],
    ],
    'syncForm' => [
        'title' => 'Synchroniser les flux',
        'feed_url' => 'Adresse du flux',
        'feed_url_hint' => 'L\'URL du flux que vous voulez synchroniser avec le podcast actuel.',
        'submit' => 'Ajouter à la file d\'attente',
    ],
    'messages' => [
        'canceled' => 'L’import a été annulé avec succès !',
        'notRunning' => 'Impossible d’annuler l’import car il n’est pas en cours d’exécution.',
        'alreadyRunning' => 'L’import est déjà en cours d’exécution. Vous devez l’annuler avant de réessayer.',
        'retried' => 'L’import a été placé dans la file d’attente, il sera exécuté sous peu !',
        'deleted' => 'L’import a bien été supprimé !',
        'importTaskQueued' => 'Une nouvelle tâche a été mise attente, l’import va bientôt commencer !',
        'syncTaskQueued' => 'Une nouvelle tâche a été mise attente, la synchronisation va bientôt commencer !',
    ],
];
