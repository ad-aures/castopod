<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Saison {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Épisode {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Saison {seasonNumber} épisode {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}E{episodeNumber}',
    'back_to_episodes' => 'Retour aux épisodes de {podcast}',
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
        'scheduled' => 'Planifié',
        'not_published' => 'Non publié',
    ],
    'list' => [
        'episode' => 'Épisode',
        'visibility' => 'Visibilité',
        'comments' => 'Commentaires',
        'actions' => 'Actions',
    ],
    'messages' => [
        'createSuccess' => 'L’épisode a été créé avec succès !',
        'editSuccess' => 'L’épisode a bien été mis à jour !',
    ],
    'form' => [
        'warning' =>
            'En cas d’erreur fatale, essayez d’augmenter les valeurs de `memory_limit`, `upload_max_filesize` et `post_max_size` dans votre fichier de configuration php puis redémarrez votre serveur web.<br />Les valeurs doivent être plus grandes que le fichier audio que vous souhaitez téléverser.',
        'audio_file' => 'Fichier audio',
        'audio_file_hint' => 'Sélectionnez un fichier audio .mp3 ou .m4a.',
        'info_section_title' => 'Informations épisode',
        'cover' => 'Image de couverture',
        'cover_hint' =>
            'Si vous ne définissez pas d’image, celle du podcast sera utilisée à la place.',
        'cover_size_hint' => 'La couverture de l’épisode doit être carrée, avec au minimum 1400px de largeur et de hauteur.',
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
            'Ces fichiers pourront être utilisées par d’autres plate-formes pour procurer une meilleure expérience à vos auditeurs.<br />Consulter le {podcastNamespaceLink} pour plus d’informations.',
        'location_section_title' => 'Localisation',
        'location_section_subtitle' => 'De quel lieu cet épisode parle-t-il ?',
        'location_name' => 'Nom ou adresse du lieu',
        'location_name_hint' => 'Ce lieu peut être réel ou fictif',
        'transcript' => 'Transcription ou sous-titrage',
        'transcript_hint' =>
            'Les formats autorisés sont txt, html, srt ou json.',
        'transcript_file' => 'Fichier de transcription',
        'transcript_remote_url' =>
            'URL distante pour le fichier de transcription',
        'transcript_file_delete' => 'Supprimer le fichier de transcription',
        'chapters' => 'Chapitrage',
        'chapters_hint' => 'Le fichier doit être en format “JSON Chapters”.',
        'chapters_file' => 'Fichier de chapitrage',
        'chapters_remote_url' =>
            'URL distante pour le fichier de chapitrage',
        'chapters_file_delete' => 'Supprimer le fichier de chapitrage',
        'advanced_section_title' => 'Paramètres avancés',
        'advanced_section_subtitle' =>
            'Si vous avez besoin d’une balise que Castopod ne couvre pas, définissez-la ici.',
        'custom_rss' => 'Balises RSS personnalisées pour l’épisode',
        'custom_rss_hint' => 'Ceci sera injecté dans la balise ❬item❭.',
        'block' => 'L’épisode doit être masqué de toutes les plateformes',
        'block_hint' =>
            'La visibilité de l’épisode. Si vous souhaitez retirer cet épisode de l’index Apple, activez ce champ.',
        'submit_create' => 'Créer l’épisode',
        'submit_edit' => 'Enregistrer l’épisode',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Retour au tableau de bord de l’épisode',
        'post' => 'Votre message de publication',
        'post_hint' =>
            'Écrivez un message pour annoncer la publication de votre épisode. Le message sera diffusé à toutes les personnes qui vous suivent dans le fédiverse et mis en évidence sur la page d’accueil de votre podcast.',
        'message_placeholder' => 'Entrez votre message…',
        'publication_date' => 'Date de publication',
        'publication_date_clear' => 'Effacer la date de publication',
        'publication_date_hint' =>
            'Vous pouvez planifier la sortie de l’épisode en saisissant une date de publication future. Ce champ doit être au format YYYY-MM-DD HH:mm',
        'publication_method' => [
            'now' => 'Maintenant',
            'schedule' => 'Planifier',
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
        'message_warning_submit' => 'Publish quand même',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            'Dépublier l’épisode supprimera toutes les publications qui lui sont associées et le retirera du flux RSS du podcast.',
        'understand' => 'Je comprends, je veux dépublier l’épisode',
        'submit' => 'Dépublier',
    ],
    'delete_form' => [
        'disclaimer' =>
            'Supprimer l’épisode supprimera toutes les publications qui lui sont associées et le retirera du flux RSS du podcast.',
        'understand' => 'Je comprends, Je veux supprimer l’épisode',
        'submit' => 'Supprimer',
    ],
    'embed' => [
        'add' => 'Ajouter un lecteur intégré',
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
