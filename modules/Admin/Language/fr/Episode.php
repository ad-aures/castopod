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
    'publish_date_edit' => 'Définir la date de publication',
    'unpublish' => 'Dépublier',
    'publish_error' => 'L’épisode est déjà publié.',
    'publish_edit_error' => 'L’épisode est déjà publié.',
    'publish_cancel_error' => 'L’épisode est déjà publié.',
    'publish_date_edit_error' => 'L\'épisode n\'a pas encore été publié, vous ne pouvez pas modifier sa date de publication.',
    'publish_date_edit_future_error' => 'La date de publication de l\'épisode ne peut être définie qu\'à une date antérieure! Si vous souhaitez la replanifier, dépubliez-la d\'abord.',
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
        'comments' => 'Commentaires',
        'actions' => 'Actions',
    ],
    'messages' => [
        'createSuccess' => 'L’épisode a été créé avec succès !',
        'editSuccess' => 'L’épisode a bien été mis à jour !',
        'publishSuccess' => '{publication_status, select,
            published {Épisode publié avec succès !}
            scheduled {La publication de l\'épisode est planifiée avec succès !}
            with_podcast {Cet épisode sera publié en même temps que le podcast.}
            other {Cet épisode n\'est pas publié.}
        }',
        'publishCancelSuccess' => 'La publication de l’épisode a bien été annulée !',
        'unpublishBeforeDeleteTip' => 'Vous devez dépublier l\'épisode avant de le supprimer.',
        'scheduleDateError' => 'La date de planification doit être définie !',
        'deletePublishedEpisodeError' => 'Vous devez dépublier l\'épisode avant de le supprimer.',
        'deleteSuccess' => 'L\'épisode a bien été supprimé !',
        'deleteError' => 'Impossible de supprimer l\'épisode {type, select,
            transcript {transcription}
            chapters {chapitres}
            image {couverture}
            audio {audio}
            other {média}
        }.',
        'deleteFileError' => 'Impossible de supprimer {type, select,
            transcript {transcription}
            chapters {chapitres}
            image {couverture}
            audio {audio}
            other {média}
        } fichier {file_key}. Vous pouvez le supprimer manuellement de votre disque.',
        'sameSlugError' => 'Il existe déjà un épisode avec le slug choisi.',
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
        'cover_size_hint' => 'L’image doit être carrée et avoir au moins 1400px de largeur et de hauteur.',
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
        'premium_title' => 'Prémium',
        'premium' => 'L\'épisode doit être accessible aux abonnés premium uniquement',
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
            'Ces fichiers pourront être utilisées par d’autres plate-formes pour procurer une meilleure expérience à vos auditeurs. Consulter le {podcastNamespaceLink} pour plus d’informations.',
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
        'block' => 'L\'épisode doit être masqué dans les catalogues publics',
        'block_hint' =>
            'L\'épisode montre ou masque le statut: activer ceci empêche l\'épisode d\'apparaître dans les Podcasts Apple, Google Podcasts, et toutes les applications tierces qui tirent vers ces répertoires. (non garanti)',
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
            'with_podcast' => 'Publier à côté du podcast',
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
    'publish_date_edit_form' => [
        'new_publication_date' => 'Date de la prochaine publication',
        'new_publication_date_hint' => 'Doit être défini à une date antérieure.',
        'submit' => 'Définir la date de publication',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Dépublier l'épisode supprimera tous les commentaires et messages qui lui sont associés et le supprimera du flux RSS du podcast.",
        'understand' => 'Je comprends, je veux dépublier l’épisode',
        'submit' => 'Dépublier',
    ],
    'delete_form' => [
        'disclaimer' =>
            "La suppression de l'épisode supprimera tous les fichiers multimédia, les commentaires, les clips vidéo et les parties sonores qui y sont associées.",
        'understand' => 'Je comprends, je veux supprimer l’épisode',
        'submit' => 'Supprimer',
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
