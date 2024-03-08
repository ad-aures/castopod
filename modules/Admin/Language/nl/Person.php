<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'persons' => 'Personen',
    'all_persons' => 'Alle personen',
    'no_person' => 'Niemand gevonden!',
    'create' => 'Een persoon aanmaken',
    'view' => 'Persoon weergeven',
    'edit' => 'Persoon bewerken',
    'delete' => 'Persoon verwijderen',
    'messages' => [
        'createSuccess' => 'Persoon is succesvol aangemaakt!',
        'editSuccess' => 'Persoon is succesvol bijgewerkt!',
        'deleteSuccess' => 'Persoon is verwijderd!',
    ],
    'form' => [
        'avatar' => 'Avatar',
        'avatar_size_hint' =>
            'Avatar must be squared and at least 400px wide and tall.',
        'full_name' => 'Volledige naam',
        'full_name_hint' => 'Dit is de volledige naam of alias van de persoon.',
        'unique_name' => 'Unieke naam',
        'unique_name_hint' => 'Gebruikt voor URLs',
        'information_url' => 'Informatie URL',
        'information_url_hint' =>
            'Url to a relevant resource of information about the person, such as a homepage or third-party profile platform.',
        'submit_create' => 'Persoon aanmaken',
        'submit_edit' => 'Persoon opslaan',
    ],
    'podcast_form' => [
        'title' => 'Personen beheren',
        'add_section_title' => 'Voeg personen toe aan deze podcast',
        'add_section_subtitle' => 'U kunt meerdere personen en rollen kiezen.',
        'persons' => 'Personen',
        'persons_hint' =>
            'You may select one or several persons with the same roles. You need to create the persons first.',
        'roles' => 'Rollen',
        'roles_hint' =>
            'You may select none, one or several roles for a person.',
        'submit_add' => 'Add person(s)',
        'remove' => 'Verwijderen',
    ],
    'episode_form' => [
        'title' => 'Personen beheren',
        'add_section_title' => 'Voeg personen toe aan deze aflevering',
        'add_section_subtitle' => 'U kunt meerdere personen en rollen kiezen.',
        'persons' => 'Personen',
        'persons_hint' =>
            'You may select one or several persons with the same roles. You need to create the persons first.',
        'roles' => 'Rollen',
        'roles_hint' =>
            'You may select none, one or several roles for a person.',
        'submit_add' => 'Add person(s)',
        'remove' => 'Verwijderen',
    ],
    'credits' => 'Credits',
];
