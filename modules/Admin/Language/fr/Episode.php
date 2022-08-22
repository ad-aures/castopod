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
    'publish' => 'Publier',
    'publish_edit' => 'Modifier la publication',
    'unpublish' => 'Dépublier',
    'publish_error' => 'L’épisode est déjà publié.',
    'publish_edit_error' => 'L’épisode est déjà publié.',
    'publish_cancel_error' => 'L’épisode est déjà publié.',
    'unpublish_error' => 'L’épisode n’est pas publié.',
    'delete' => 'Supprimer',
    'go_to_page' => 'Voir',
    'create' => 'Ajouter un épisode',
    'publication_status' => [
        'published' => 'Publié',
        'with_podcast' => 'Published',
        'scheduled' => 'Planifié',
        'not_published' => 'Non publié',
    ],
    'with_podcast_hint' => 'To be published at the same time as the podcast',
    'list' => [
        'search' => [
            'placeholder' => 'Search for an episode',
            'clear' => 'Clear search',
            'submit' => 'Search',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# episode}
            other {# episodes}
        }',
        'episode' => 'Épisode',
        'visibility' => 'Visibilité',
        'comments' => 'Commentaires',
        'actions' => 'Actions',
    ],
    'messages' => [
        'createSuccess' => 'L’épisode a été créé avec succès !',
        'editSuccess' => 'L’épisode a bien été mis à jour !',
        'publishSuccess' => '{publication_status, select,
            published {Episode successfully published!}
            scheduled {Episode publication successfully scheduled!}
            with_podcast {This episode will be published at the same time as the podcast.}
            other {This episode is not published.}
        }',
        'publishCancelSuccess' => 'La publication de l’épisode a bien été annulée !',
        'unpublishBeforeDeleteTip' => 'You must unpublish the episode before deleting it.',
        'scheduleDateError' => 'Schedule date must be set!',
        'deletePublishedEpisodeError' => 'Please unpublish the episode before deleting it.',
        'deleteSuccess' => 'Episode successfully deleted!',
        'deleteError' => 'Failed to delete episode {type, select,
            transcript {transcript}
            chapters {chapters}
            image {cover}
            audio {audio}
            other {media}
        }.',
        'deleteFileError' => 'Failed to delete {type, select,
            transcript {transcript}
            chapters {chapters}
            image {cover}
            audio {audio}
            other {media}
        } file {file_path}. You may manually remove it from your disk.',
        'sameSlugError' => 'An episode with the chosen slug already exists.',
    ],
    'form' => [
        'file_size_error' =>
            'Votre fichier est trop lourd ! La taille maximale est de {0}. Augmentez les valeurs de `memory_limit`, `upload_max_filesize` et `post_max_size` dans votre fichier de configuration php puis redémarrez votre serveur web pour téléverser votre fichier.',
        'audio_file' => 'Fichier audio',
        'audio_file_hint' => 'Sélectionnez un fichier audio .mp3 ou .m4a.',
        'info_section_title' => 'Informations épisode',
        'cover' => 'Image de couverture',
        'cover_hint' =>
            'Si vous ne définissez pas d’image, celle du podcast sera utilisée à la place.',
        'cover_size_hint' => 'Cover must be squared and at least 1400px wide and tall.',
        'title' => 'Titre',
        'title_hint' =>
            'Doit contenir un titre d’épisode clair et concis. Ne précisez ici aucun numéro de saison ou d’épisode.',
        'permalink' => 'Lien permanent',
        'season_number' => 'Saison',
        'episode_number' => 'Épisode',
        'type' => [
            'label' => 'Type',
            'full' => 'Complet',
            'full_hint' => 'Épisode complet',
            'trailer' => 'Bande-annonce',
            'trailer_hint' => 'Extrait court, promotionnel du podcast',
            'bonus' => 'Bonus',
            'bonus_hint' => 'Contenu supplémentaire pour le podcast (par exemple des informations sur les coulisses ou des interviews avec les acteurs) ou du contenu promotionnel croisé pour un autre podcast',
        ],
        'parental_advisory' => [
            'label' => 'Avertissement parental',
            'hint' => 'L’épisode contient-il un contenu explicite ?',
            'undefined' => 'non défini',
            'clean' => 'Convenable',
            'explicit' => 'Explicite',
        ],
        'show_notes_section_title' => 'Notes d’épisode (Show Notes)',
        'show_notes_section_subtitle' =>
            'Jusque 4000 caractères, soyez clairs et concis. Les notes d’épisode aident les auditeurs potentiels à le trouver.',
        'description' => 'Description',
        'description_footer' => 'Pied de description',
        'description_footer_hint' =>
            'Ce texte est ajouté à la fin de chaque description d’épisode, c’est un bon endroit pour placer vos liens sociaux par exemple.',
        'additional_files_section_title' => 'Fichiers additionels',
        'additional_files_section_subtitle' =>
            'These files may be used by other platforms to provide better experience to your audience. See the {podcastNamespaceLink} for more information.',
        'location_section_title' => 'Localisation',
        'location_section_subtitle' => 'De quel lieu cet épisode parle-t-il ?',
        'location_name' => 'Nom ou adresse du lieu',
        'location_name_hint' => 'Ce lieu peut être réel ou fictif',
        'transcript' => 'Transcription (sous-titrage)',
        'transcript_hint' => 'Seulement les .srt sont autorisés',
        'transcript_download' => 'Télécharger le transcript',
        'transcript_file' => 'Fichier de transcription (.srt)',
        'transcript_remote_url' => 'URL distante pour le fichier de transcription',
        'transcript_file_delete' => 'Supprimer le fichier de transcription',
        'chapters' => 'Chapitrage',
        'chapters_hint' => 'Le fichier doit être en format “JSON Chapters”.',
        'chapters_download' => 'Télécharger le chapitrage',
        'chapters_file' => 'Fichier de chapitrage',
        'chapters_remote_url' => 'URL distante pour le fichier de chapitrage',
        'chapters_file_delete' => 'Supprimer le fichier de chapitrage',
        'advanced_section_title' => 'Paramètres avancés',
        'advanced_section_subtitle' =>
            'Si vous avez besoin d’une balise que Castopod ne couvre pas, définissez-la ici.',
        'custom_rss' => 'Balises RSS personnalisées pour l’épisode',
        'custom_rss_hint' => 'Ceci sera injecté dans la balise ❬item❭.',
        'block' => 'Episode should be hidden from public catalogues',
        'block_hint' =>
            'The episode show or hide status: toggling this on prevents the episode from appearing in Apple Podcasts, Google Podcasts, and any third party apps that pull shows from these directories. (Not guaranteed)',
        'submit_create' => 'Créer l’épisode',
        'submit_edit' => 'Enregistrer l’épisode',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Retour au tableau de bord de l’épisode',
        'post' => 'Votre message de publication',
        'post_hint' =>
            "Écrivez un message pour annoncer la publication de votre épisode. Le message sera diffusé à toutes les personnes qui vous suivent dans le fédiverse et mis en évidence sur la page d’accueil de votre podcast.",
        'message_placeholder' => 'Entrez votre message…',
        'publication_date' => 'Date de publication',
        'publication_method' => [
            'now' => 'Maintenant',
            'schedule' => 'Planifier',
            'with_podcast' => 'Publish alongside podcast',
        ],
        'scheduled_publication_date' => 'Date de publication programmée',
        'scheduled_publication_date_clear' => 'Effacer la date de publication',
        'scheduled_publication_date_hint' =>
            'Vous pouvez planifier la sortie de l’épisode en saisissant une date de publication future. Ce champ doit être au format YYYY-MM-DD HH:mm',
        'submit' => 'Publier',
        'submit_edit' => 'Modifier la publication',
        'cancel_publication' => 'Annuler la publication',
        'message_warning' => 'Vous n’avez pas saisi de message pour l’annonce de votre épisode !',
        'message_warning_hint' => 'Ajouter un message augmente l’engagement social, menant à une meilleure visibilité pour votre épisode.',
        'message_warning_submit' => 'Publier quand même',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Unpublishing the episode will delete all the comments and posts associated with it and remove it from the podcast's RSS feed.",
        'understand' => 'Je comprends, je veux dépublier l’épisode',
        'submit' => 'Dépublier',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Deleting the episode will delete all media files, comments, video clips and soundbites associated with it.",
        'understand' => 'Je comprends, je veux supprimer l’épisode',
        'submit' => 'Delete',
    ],
    'embed' => [
        'title' => 'Lecteur intégré',
        'label' =>
            'Sélectionnez une couleur de thème, copiez le code dans le presse-papier, puis collez-le sur votre site internet.',
        'clipboard_iframe' => 'Copier le lecteur dans le presse papier',
        'clipboard_url' => 'Copier l’adresse dans le presse papier',
        'dark' => 'Sombre',
        'dark-transparent' => 'Sombre transparent',
        'light' => 'Clair',
        'light-transparent' => 'Clair transparent',
    ],
];
