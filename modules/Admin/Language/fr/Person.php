<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'persons' => 'Intervenants',
    'all_persons' => 'Tous les intervenants',
    'no_person' => 'Aucun intervenant trouvé !',
    'create' => 'Créer un intervenant',
    'view' => 'Voir l’intervenant',
    'edit' => 'Modifier l’intervenant',
    'delete' => 'Supprimer l’intervenant',
    'messages' => [
        'createSuccess' => 'L’intervenant a été créé avec succès !',
        'editSuccess' => 'L’intervenant a bien été mis à jour !',
        'deleteSuccess' => 'L’intervenant a bien été retiré !',
    ],
    'form' => [
        'avatar' => 'Avatar',
        'avatar_size_hint' =>
            'L’image doit être carrée et avoir au moins 400px de largeur et de hauteur.',
        'full_name' => 'Nom complet',
        'full_name_hint' => 'Le nom complet ou le pseudonyme de l’intervenant',
        'unique_name' => 'Nom unique',
        'unique_name_hint' => 'Utilisé pour les URLs',
        'information_url' => 'Adresse d’information',
        'information_url_hint' =>
            'URL pointant vers des informations relatives à l’intervenant, telle qu’une page personnelle ou une page de profil sur une plateforme tierce.',
        'submit_create' => 'Créer l’intervenant',
        'submit_edit' => 'Enregistrer l’intervenant',
    ],
    'podcast_form' => [
        'title' => 'Gérer les intervenants',
        'add_section_title' => 'Ajouter des intervenants à ce podcast',
        'add_section_subtitle' => 'Vous pouvez sélectionner plusieurs intervenants et rôles.',
        'persons' => 'Intervenants',
        'persons_hint' =>
            'Vous pouvez selectionner un ou plusieurs intervenants ayant les mêmes rôles. Les intervenants doivent avoir été préalablement créés.',
        'roles' => 'Groupes et rôles',
        'roles_hint' =>
            'Vous pouvez sélectionner aucun, un ou plusieurs groupes et rôles par intervenant.',
        'submit_add' => 'Ajouter un/des intervenant(s)',
        'remove' => 'Retirer',
    ],
    'episode_form' => [
        'title' => 'Gérer les intervenants',
        'add_section_title' => 'Ajouter des intervenants à cet épisode',
        'add_section_subtitle' => 'Vous pouvez sélectionner plusieurs intervenants et rôles.',
        'persons' => 'Intervenants',
        'persons_hint' =>
            'Vous pouvez selectionner un ou plusieurs intervenants ayant les mêmes rôles. Les intervenants doivent avoir été préalablement créés.',
        'roles' => 'Groupes et rôles',
        'roles_hint' =>
            'Vous pouvez sélectionner aucun, un ou plusieurs groupes et rôles par intervenant.',
        'submit_add' => 'Ajouter un/des intervenant(s)',
        'remove' => 'Retirer',
    ],
    'credits' => 'Crédits',
];
