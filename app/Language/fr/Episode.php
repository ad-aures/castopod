<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Saison {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Épisode {episodeNumber}',
    'number_abbr' => 'Ép. {episodeNumber}',
    'season_episode' => 'Saison {seasonNumber} épisode {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# intervenant·e}
        other {# intervenant·e·s}
    }',
    'persons_list' => 'Intervenant·e·s',
    'back_to_episodes' => 'Retour aux épisodes de {podcast}',
    'comments' => 'Commentaires',
    'activity' => 'Activité',
    'chapters' => 'Chapitres',
    'transcript' => 'Transcription',
    'description' => 'Description de l’épisode',
    'number_of_comments' => '{numberOfComments, plural,
        one {# commentaire}
        other {# commentaires}
    }',
    'all_podcast_episodes' => 'Tous les épisodes du podcast',
    'back_to_podcast' => 'Revenir au podcast',
    'preview' => [
        'title' => 'Prévisualisation',
        'not_published' => 'Non publié',
        'text' => '{publication_status, select,
            published {Cet épisode n’est pas encore publié.}
            scheduled {Cet épisode est programmé pour le {publication_date}.}
            with_podcast {Cet épisode va être publié au même moment que le podcast.}
            other {Cet épisode n’est pas encore publié.}
        }',
        'publish' => 'Publier',
        'publish_edit' => 'Modifier la publication',
    ],
    'no_chapters' => 'Aucun chapitre n’est disponible pour cet épisode.',
    'download_transcript' => 'Télécharger la transcription ({extension})',
    'no_transcript' => 'Aucune transcription disponible pour cet épisode.',
];
