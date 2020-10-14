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
    'form' => [
        'enclosure' => 'Sélectionnez un fichier audio .mp3 ou .m4a…',
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
        'published_at' => [
            'label' => 'Date de publication',
            'date' => 'Date',
            'time' => 'Heure',
        ],
        'parental_advisory' => [
            'label' => 'Avertissement parental',
            'hint' => 'L’épisode contient-il un contenu explicite ?',
            'undefined' => 'non défini',
            'clean' => 'Convenable',
            'explicit' => 'Explicite',
        ],
        'block' => 'L’épisode doit être masqué de toutes les plateformes',
        'block_hint' =>
            'La visibilité de l’épisode. Si vous souhaitez retirer cet épisode de l’index Apple, activez ce champs.',
        'submit_create' => 'Créer l’épisode',
        'submit_edit' => 'Enregistrer l’épisode',
    ],
];
