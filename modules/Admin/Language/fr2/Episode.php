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
    'number_of_comments' => '{numberOfComments, plural,
        one {# commentaire}
        other {# commentaires}
    }',
    'all_podcast_episodes' => 'Tous les épisodes du podcast',
    'back_to_podcast' => 'Revenir au podcast',
    'edit' => 'Modifier',
    'preview' => 'Preview',
    'publish' => 'Publier',
    'publish_edit' => 'Modifier la publication',
    'publish_date_edit' => 'Modifier la date de publication',
    'unpublish' => 'Dépublier',
    'publish_error' => 'L’épisode est déjà publié.',
    'publish_edit_error' => 'L’épisode est déjà publié.',
    'publish_cancel_error' => 'L’épisode est déjà publié.',
    'publish_date_edit_error' => 'L\'épisode n\'a pas encore été publié, vous ne pouvez pas modifier sa date de publication.',
    'publish_date_edit_future_error' => 'La date de publication de l\'épisode ne peut être définie qu\'à une date antérieure ! Si vous souhaitez la replanifier, dépubliez-le d\'abord.',
    'publish_date_edit_success' => 'La date de publication de l\'épisode a été mise à jour avec succès !',
    'unpublish_error' => 'L’épisode n’est pas publié.',
    'delete' => 'Supprimer',
    'go_to_page' => 'Voir',
    'create' => 'Ajouter un épisode',
    'publication_status' => [
        'published' => 'Publié',
        'with_podcast' => 'Publié',
        'scheduled' => 'Planifié',
        'not_published' => 'Non publié',
    ],
    'with_podcast_hint' => 'Publier en même temps que le podcast',
    'list' => [
        'search' => [
            'placeholder' => 'Rechercher un épisode',
            'clear' => 'Effacer la recherche',
            'submit' => 'Recherche',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# épisode}
            other {# épisodes}
        }',
        'episode' => 'Épisode',
        'visibility' => 'Visibilité',
        'downloads' => 'Downloads',
        'comments' => 'Commentaires',
        'actions' => 'Actions',
    ],
    'messages' => [
        'createSuccess' => 'L’épisode a été créé avec succès  !',
        'editSuccess' => 'L’épisode a bien été mis à jour  !',
        'publishSuccess' => '{publication_status, select,
            published {Épisode publié avec succès !}
            scheduled {La publication de l\'épisode est planifiée avec succès !}
            with_podcast {Cet épisode sera publié en même temps que le podcast.}
            other {Cet épisode n\'est pas publié.}
        }',
        'publishCancelSuccess' => 'La publication de l’épisode a bien été annulée  !',
        'unpublishBeforeDeleteTip' => 'Vous devez dépublier l\'épisode avant de le supprimer.',
        'scheduleDateError' => 'La date de planification doit être définie !',
        'deletePublishedEpisodeError' => 'Vous devez dépublier l\'épisode avant de le supprimer.',
        'deleteSuccess' => 'L\'épisode a bien été supprimé !',
        'deleteError' => 'Impossible de supprimer {type, select,
            transcript {la transcription}
            chapters {les chapitres}
            image {la couverture}
            audio {l\'audio}
            other {le média}
        } de l\'épisode.',
        'deleteFileError' => 'Failed to delete {type, select,
            transcript {transcript}
            chapters {chapters}
            image {cover}
            audio {audio}
            other {media}
        } file {file_key}. You may manually remove it from your disk.',
        'sameSlugError' => 'Il existe déjà un épisode avec le slug choisi.',
    ],
    'form' => [
        'file_size_error' =>
            'Your file size is too big! Max size is {0}. Increase the `memory_limit`, `upload_max_filesize` and `post_max_size` values in your php configuration file then restart your web server to upload your file.',
        'audio_file' => 'Audio file',
        'audio_file_hint' => 'Choose an .mp3 or .m4a audio file.',
        'info_section_title' => 'Episode info',
        'cover' => 'Episode cover',
        'cover_hint' =>
            'If you do not set a cover, the podcast cover will be used instead.',
        'cover_size_hint' => 'Cover must be squared and at least 1400px wide and tall.',
        'title' => 'Title',
        'title_hint' =>
            'Should contain a clear and concise episode name. Do not specify the episode or season numbers here.',
        'permalink' => 'Permalink',
        'season_number' => 'Season',
        'episode_number' => 'Episode',
        'type' => [
            'label' => 'Type',
            'full' => 'Full',
            'full_hint' => 'Complete content (the episode)',
            'trailer' => 'Trailer',
            'trailer_hint' => 'Short, promotional piece of content that represents a preview of the current show',
            'bonus' => 'Bonus',
            'bonus_hint' => 'Extra content for the show (for example, behind the scenes info or interviews with the cast) or cross-promotional content for another show',
        ],
        'premium_title' => 'Premium',
        'premium' => 'Episode must be accessible to premium subscribers only',
        'parental_advisory' => [
            'label' => 'Parental advisory',
            'hint' => 'Does the episode contain explicit content?',
            'undefined' => 'undefined',
            'clean' => 'Clean',
            'explicit' => 'Explicit',
        ],
        'show_notes_section_title' => 'Show notes',
        'show_notes_section_subtitle' =>
            'Up to 4000 characters, be clear and concise. Show notes help potential listeners in finding the episode.',
        'description' => 'Description',
        'description_footer' => 'Description footer',
        'description_footer_hint' =>
            'This text is added at the end of each episode description, it is a good place to input your social links for example.',
        'additional_files_section_title' => 'Additional files',
        'additional_files_section_subtitle' =>
            'These files may be used by other platforms to provide better experience to your audience. See the {podcastNamespaceLink} for more information.',
        'location_section_title' => 'Location',
        'location_section_subtitle' => 'What place is this episode about?',
        'location_name' => 'Location name or address',
        'location_name_hint' => 'This can be a real or fictional location',
        'transcript' => 'Transcript (subtitles / closed captions)',
        'transcript_hint' => 'Only .srt are allowed.',
        'transcript_download' => 'Download transcript',
        'transcript_file' => 'Transcript file (.srt)',
        'transcript_remote_url' => 'Remote url for transcript',
        'transcript_file_delete' => 'Delete transcript file',
        'chapters' => 'Chapitrage',
        'chapters_hint' => 'Le fichier doit être en format “JSON Chapters”.',
        'chapters_download' => 'Télécharger le chapitrage',
        'chapters_file' => 'Fichier de chapitrage',
        'chapters_remote_url' => 'URL distante pour le fichier de chapitrage',
        'chapters_file_delete' => 'Supprimer le fichier de chapitrage',
        'advanced_section_title' => 'Paramètres avancés',
        'advanced_section_subtitle' =>
            'Si vous avez besoin d’une balise RSS que Castopod ne couvre pas, définissez-la ici.',
        'custom_rss' => 'Balises RSS personnalisées pour l’épisode',
        'custom_rss_hint' => 'Ceci sera injecté dans la balise ❬item❭.',
        'block' => 'L\'épisode doit être masqué dans les catalogues publics',
        'block_hint' =>
            'Statut caché ou visible de l\'épisode : activer ceci empêche l\'épisode d\'apparaître dans les Apple Podcasts, Google Podcasts, et toutes les applications tierces qui utilisent ces répertoires. (Sans garantie)',
        'submit_create' => 'Créer l’épisode',
        'submit_edit' => 'Enregistrer l’épisode',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Retour au tableau de bord de l’épisode',
        'post' => 'Votre message de publication',
        'post_hint' =>
            "Écrivez un message pour annoncer la publication de votre épisode. Ce message sera diffusé à toutes les personnes qui vous suivent dans le fédiverse et mis en évidence sur la page d’accueil de votre podcast.",
        'message_placeholder' => 'Entrez votre message…',
        'publication_date' => 'Date de publication',
        'publication_method' => [
            'now' => 'Maintenant',
            'schedule' => 'Planifier',
            'with_podcast' => 'Publier en même temps que le podcast',
        ],
        'scheduled_publication_date' => 'Date de publication programmée',
        'scheduled_publication_date_clear' => 'Effacer la date de publication',
        'scheduled_publication_date_hint' =>
            'Vous pouvez planifier la sortie de l’épisode en saisissant une date de publication future. Ce champ doit être au format YYYY-MM-DD HH:mm',
        'submit' => 'Publier',
        'submit_edit' => 'Modifier la publication',
        'cancel_publication' => 'Annuler la publication',
        'message_warning' => 'Vous n’avez pas saisi de message pour l’annonce de votre épisode  !',
        'message_warning_hint' => 'Ajouter un message augmente l’engagement sur les réseaux sociaux, donnant une meilleure visibilité à votre épisode.',
        'message_warning_submit' => 'Publier quand même',
    ],
    'publish_date_edit_form' => [
        'new_publication_date' => 'Nouvelle date de publication',
        'new_publication_date_hint' => 'Doit être défini à une date antérieure.',
        'submit' => 'Modifier la date de publication',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Dépublier l'épisode supprimera tous les commentaires et messages qui lui sont associés et le retirera du flux RSS du podcast.",
        'understand' => 'Je comprends, je veux dépublier l’épisode',
        'submit' => 'Dépublier',
    ],
    'delete_form' => [
        'disclaimer' =>
            "La suppression de l'épisode supprimera tous les fichiers multimédia, les commentaires, les clips vidéo et les parties sonores qui y sont associés.",
        'understand' => 'Je comprends, je veux supprimer l’épisode',
        'submit' => 'Supprimer',
    ],
    'embed' => [
        'title' => 'Lecteur intégré',
        'label' =>
            'Sélectionnez une couleur de thème, copiez le code dans le presse-papier, puis collez-le sur votre site internet.',
        'clipboard_iframe' => 'Copier le code du lecteur intégré dans le presse papier',
        'clipboard_url' => 'Copier l’adresse dans le presse papier',
        'dark' => 'Sombre',
        'dark-transparent' => 'Sombre transparent',
        'light' => 'Clair',
        'light-transparent' => 'Clair transparent',
    ],
    'publication_status_banner' => [
        'draft_mode' => 'draft mode',
        'text' => '{publication_status, select,
            published {This episode is not yet published.}
            scheduled {This episode is scheduled for publication on {publication_date}.}
            with_podcast {This episode will be published at the same time as the podcast.}
            other {This episode is not yet published.}
        }',
        'preview' => 'Preview',
    ],
];
