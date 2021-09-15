<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'warning' =>
        'Cette procédure peut prendre du temps.<br/>Dans la mesure où la version actuelle ne montre aucune progression durant l’exécution, vous ne pourrez voir aucun changement avant la fin.<br/>En cas d’erreur de timeout,  augmentez la valeur de `max_execution_time`.',
    'old_podcast_section_title' => 'Le podcast à importer',
    'old_podcast_section_subtitle' =>
        'Assurez-vous d’être détenteur des droits du podcast avant de l’importer. Copier et diffuser un podcast sans en détenir les droits est assimilable à de la contrefaçon et est passible de poursuites.',
    'imported_feed_url' => 'Adresse du flux',
    'imported_feed_url_hint' => 'Le flux doit être au format xml ou rss.',
    'new_podcast_section_title' => 'Le nouveau podcast',
    'advanced_params_section_title' => 'Paramètres avancés',
    'advanced_params_section_subtitle' =>
        'Si vous ne savez pas à quoi servent ces champs, conservez les valeurs par défaut.',
    'slug_field' => [
        'label' =>
            'Champ à utiliser pour calculer l’identifiant de l’épisode',
        'link' => '&lt;link&gt; (adresse)',
        'title' => '&lt;title&gt; (titre)',
    ],
    'description_field' => 'Champs pour la description des épisodes',
    'force_renumber' => 'Forcer la re-numérotation des épisodes',
    'force_renumber_hint' =>
        'Utilisez ceci si le podcast à importer ne contient pas de numéros d’épisodes mais que vous souhaitez en ajouter pendant l’import.',
    'season_number' => 'Numéro de saison',
    'season_number_hint' =>
        'Utilisez ceci si le podcast à importer ne contient pas de numéros de saison mais que vous souhaitez en définir un. Laissez vide sinon.',
    'max_episodes' => 'Nombre maximum d’épisodes à importer',
    'max_episodes_hint' => 'Laissez vide pour importer tous les épisodes',
    'lock_import' =>
        'Ce flux est protégé. Vous ne pouvez pas l’importer. Si en vous êtes le propriétaire, déprotégez-le sur la plate-forme d’origine.',
    'submit' => 'Importer le podcast',
];
