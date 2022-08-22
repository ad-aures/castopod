<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'persons' => 'Persons',
    'all_persons' => 'All persons',
    'no_person' => 'Nobody found!',
    'create' => 'Create a person',
    'view' => 'View person',
    'edit' => 'Edit person',
    'delete' => 'Delete person',
    'messages' => [
        'createSuccess' => 'Person has been successfully created!',
        'editSuccess' => 'Person has been successfully updated!',
        'deleteSuccess' => 'Person has been removed!',
    ],
    'form' => [
        'avatar' => 'Avatar',
        'avatar_size_hint' =>
            'Avatar must be squared and at least 400px wide and tall.',
        'full_name' => 'Full name',
        'full_name_hint' => 'This is the full name or alias of the person.',
        'unique_name' => 'Unique name',
        'unique_name_hint' => 'Used for URLs',
        'information_url' => 'Information URL',
        'information_url_hint' =>
            'Url to a relevant resource of information about the person, such as a homepage or third-party profile platform.',
        'submit_create' => 'Create person',
        'submit_edit' => 'Save person',
    ],
    'podcast_form' => [
        'title' => 'Manage persons',
        'add_section_title' => 'Add persons to this podcast',
        'add_section_subtitle' => 'You may pick several persons and roles.',
        'persons' => 'Persons',
        'persons_hint' =>
            'You may select one or several persons with the same roles. You need to create the persons first.',
        'roles' => 'Roles',
        'roles_hint' =>
            'You may select none, one or several roles for a person.',
        'submit_add' => 'Add person(s)',
        'remove' => 'Remove',
    ],
    'episode_form' => [
        'title' => 'Manage persons',
        'add_section_title' => 'Add persons to this episode',
        'add_section_subtitle' => 'You may pick several persons and roles.',
        'persons' => 'Persons',
        'persons_hint' =>
            'Môžete vybrať jednu alebo viac osôb s tou istou rolou. Najprv by ste mali osobnosti vytvoriť.',
        'roles' => 'Roly',
        'roles_hint' =>
            'Pre jednu osobu môžete vybrať žiadnu, jednu alebo viac rolí.',
        'submit_add' => 'Pridať osob(y)',
        'remove' => 'Odstrániť',
    ],
    'credits' => 'Zásluhy',
];
