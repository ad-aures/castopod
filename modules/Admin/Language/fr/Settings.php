<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Paramètres généraux',
    'instance' => [
        'title' => 'Instance',
        'site_icon' => 'Favicon du site',
        'site_icon_delete' => 'Supprimer la favicon du site',
        'site_icon_hint' => 'Les favicons sont ce que vous voyez sur les onglets de votre navigateur, dans votre barre de favoris, et lorsque vous ajoutez un site web en raccourci sur des appareils mobiles.',
        'site_icon_helper' => 'La favicon doit être carrée, avec au minimum 512px de largeur et de hauteur.',
        'site_name' => 'Titre du site',
        'site_description' => 'Description du site',
        'submit' => 'Sauvegarder',
        'editSuccess' => 'L’instance a bien été mise à jour !',
        'deleteIconSuccess' => 'La favicon du site a bien été retirée !',
    ],
    'images' => [
        'title' => 'Images',
        'subtitle' => 'Vous pouvez ici regénérer toutes les images en se basant sur celles qui ont été téléversées à l’origine. À utiliser si vous remarquez qu’il y a des images manquantes. Cette tâche peut prendre du temps.',
        'regenerate' => 'Regénérer les images',
        'regenerationSuccess' => 'Toutes les images ont été regénérés avec succès !',
    ],
    'housekeeping' => [
        'title' => 'Ménage',
        'subtitle' => 'Exécute un nombre de tâches de nettoyage. Utilisez cette fonctionnalité si vous rencontrez des problèmes avec les fichiers multimédias ou l’intégrité des données. Ces tâches peuvent prendre du temps.',
        'reset_counts' => 'Réinitialiser les compteurs',
        'reset_counts_helper' => 'Cette option recalcul et réinitialise les compteurs de données (nombre d’abonné·e·s, de publications, de commentaires, …).',
        'rewrite_media' => 'Réécrire les métadonnées des fichiers média',
        'rewrite_media_helper' => 'Cette option supprimera tous les fichiers média superflus et les recréera (images, fichiers audio, transcripts, chapitrages, …)',
        'clear_cache' => 'Supprimer tout le cache',
        'clear_cache_helper' => 'Cette option supprimera l’intégralité du cache redis ou des fichiers cache du dossier writable/cache.',
        'run' => 'Faire le ménage',
        'runSuccess' => 'Le ménage a été effectué avec succès !',
    ],
    'theme' => [
        'title' => 'Thème',
        'accent_section_title' => 'Couleur d’accentuation',
        'accent_section_subtitle' => 'Sélectionnez une couleur qui déterminera l’apparence de toutes les pages publiques.',
        'pine' => 'Pin',
        'crimson' => 'Cramoisi',
        'amber' => 'Ambre',
        'lake' => 'Lac',
        'jacaranda' => 'Jacaranda',
        'onyx' => 'Onyx',
        'submit' => 'Sauvegarder',
        'setInstanceThemeSuccess' => 'Le thème a bien été mis à jour !',
    ],
];
