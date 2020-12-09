<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'previous_episode' => 'Épisode précédent',
    'previous_season' => 'Saison précédente',
    'next_episode' => 'Épisode suivant',
    'next_season' => 'Saison suivante',
    'season' => 'Saison {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Épisode {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Saison {seasonNumber} épisode {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}E{episodeNumber}',
    'all_podcast_episodes' => 'Tous les épisodes du podcast',
    'back_to_podcast' => 'Revenir au podcast',
    'edit' => 'Modifier',
    'delete' => 'Supprimer',
    'go_to_page' => 'Voir',
    'create' => 'Ajouter un épisode',
    'publication_status' => [
        'published' => 'Publié le {0}',
        'scheduled' => 'Planifié pour le {0}',
        'not_published' => 'Non publié',
    ],
    'form' => [
        'enclosure' => 'Fichier audio',
        'enclosure_hint' => 'Sélectionnez un fichier audio .mp3 ou .m4a.',
        'info_section_title' => 'Informations épisode',
        'info_section_subtitle' => '',
        'image' => 'Image de couverture',
        'image_hint' =>
            'Si vous ne définissez pas d’image, celle du podcast sera utilisée à la place.',
        'title' => 'Titre',
        'title_hint' =>
            'Doit contenir un titre d’épisode clair et concis. Ne précisez ici aucun numéro de saison ou d’épisode.',
        'slug' => 'Identifiant',
        'slug_hint' => 'Utilisé pour générer l’adresse de l’épisode.',
        'season_number' => 'Saison',
        'episode_number' => 'Épisode',
        'type' => [
            'label' => 'Type',
            'hint' =>
                '- <strong>complet</strong>: épisode complet.<br/>- <strong>bande-annonce</strong>: extrait court, promotionnel du podcast.<br/>- <strong>bonus</strong> :  contenu supplémentaire pour le podcast (par exemple des informations sur les coulisses ou des interviews avec les acteurs) ou du contenu promotionnel croisé pour un autre podcast.',
            'full' => 'Complet',
            'trailer' => 'Bande-annonce',
            'bonus' => 'Bonus',
        ],
        'show_notes_section_title' => 'Notes d’épisode (Show Notes)',
        'show_notes_section_subtitle' =>
            'Jusque 4000 caractères, soyez clairs et concis. Les notes d’épisode aident les auditeurs potentiels à le trouver.',
        'description' => 'Description',
        'description_footer' => 'Pied de description',
        'description_footer_hint' =>
            'Ce texte est ajouté à la fin de chaque description d’épisode, c’est un bon endroit pour placer vos liens sociaux par exemple.',
        'publication_section_title' => 'Information de publication',
        'publication_section_subtitle' => '',
        'publication_date' => 'Date de publication',
        'publication_date_clear' => 'Effacer la date de publication',
        'publication_date_hint' =>
            'Vous pouvez planifier la sortie de l’épisode en saisissant une date de publication future. Ce champ doit être au format YYYY-MM-DD HH:mm',
        'parental_advisory' => [
            'label' => 'Avertissement parental',
            'hint' => 'L’épisode contient-il un contenu explicite ?',
            'undefined' => 'non défini',
            'clean' => 'Convenable',
            'explicit' => 'Explicite',
        ],
        'block' => 'L’épisode doit être masqué de toutes les plateformes',
        'block_hint' =>
            'La visibilité de l’épisode. Si vous souhaitez retirer cet épisode de l’index Apple, activez ce champ.',
        'additional_files_section_title' => 'Fichiers additionels',
        'additional_files_section_subtitle' =>
            'Ces fichiers pourront être utilisées par d’autres plate-formes pour procurer une meilleure expérience à vos auditeurs.<br />Consulter le {podcastNamespaceLink} pour plus d’informations.',
        'transcript' => 'Transcription ou sous-titrage',
        'transcript_hint' =>
            'Les formats autorisés sont txt, html, srt ou json.',
        'transcript_delete' => 'Supprimer la transcription',
        'chapters' => 'Chapitrage',
        'chapters_hint' => 'Le fichier doit être en "JSON Chapters Format".',
        'chapters_delete' => 'Supprimer le chaptrage',
        'submit_create' => 'Créer l’épisode',
        'submit_edit' => 'Enregistrer l’épisode',
    ],
    'soundbites' => 'Extraits sonores',
    'soundbites_form' => [
        'title' => 'Modifier les extraits sonores',
        'info_section_title' => 'Extraits sonores de l’épisode',
        'info_section_subtitle' =>
            'Ajouter, modifier ou supprimer des extraits sonores',
        'start_time' => 'Début',
        'start_time_hint' =>
            'La première seconde de l’extrait sonore, cela peut être un nombre décimal.',
        'duration' => 'Durée',
        'duration_hint' =>
            'La durée de l’extrait sonore (en secondes), cela peut être un nombre décimal.',
        'label' => 'Libellé',
        'label_hint' => 'Texte qui sera affiché.',
        'play' => 'Écouter l’extrait sonore',
        'delete' => 'Supprimer l’extrait sonore',
        'bookmark' =>
            'Cliquez pour récupérer la position actuelle, cliquez à nouveau pour récupérer la durée.',
        'submit_edit' => 'Enregistrer tous les extraits sonores',
    ],
];
