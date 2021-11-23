<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
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
        'subtitle' => 'Vous pouvez ici regénérer toutes les images en se basant sur celles qui ont été téléversées à l’origine.',
        'regenerate' => 'Regénérer les images',
        'regenerationSuccess' => 'Toutes les images ont été regénérés avec succès !',
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
