<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'persons' => 'Personer',
    'all_persons' => 'Alla personer',
    'no_person' => 'Ingen hittades!',
    'create' => 'Skapa en person',
    'view' => 'Visa person',
    'edit' => 'Redigera person',
    'delete' => 'Ta bort person',
    'messages' => [
        'createSuccess' => 'Person har skapats framgångsrikt!',
        'editSuccess' => 'Person har uppdaterats!',
        'deleteSuccess' => 'Person har tagits bort!',
    ],
    'form' => [
        'avatar' => 'Avatar',
        'avatar_size_hint' =>
            'Avatar måste vara kvadratisk och minst 400px bred och hög.',
        'full_name' => 'Fullständigt namn',
        'full_name_hint' => 'Detta är personens fullständiga namn eller alias.',
        'unique_name' => 'Unikt namn',
        'unique_name_hint' => 'Används för URL: er',
        'information_url' => 'Information URL',
        'information_url_hint' =>
            'Url till en relevant resurs av information om personen, såsom en hemsida eller en tredje parts profilplattform.',
        'submit_create' => 'Skapa person',
        'submit_edit' => 'Spara person',
    ],
    'podcast_form' => [
        'title' => 'Hantera personer',
        'add_section_title' => 'Lägg till personer till denna podcast',
        'add_section_subtitle' => 'Du kan välja flera personer och roller.',
        'persons' => 'Personer',
        'persons_hint' =>
            'Du kan välja en eller flera personer med samma roller. Du måste skapa personerna först.',
        'roles' => 'Roller',
        'roles_hint' =>
            'Du kan välja ingen, en eller flera roller för en person.',
        'submit_add' => 'Lägg till person(er)',
        'remove' => 'Ta bort',
    ],
    'episode_form' => [
        'title' => 'Hantera personer',
        'add_section_title' => 'Lägg till personer till detta avsnitt',
        'add_section_subtitle' => 'Du kan välja flera personer och roller.',
        'persons' => 'Personer',
        'persons_hint' =>
            'Du kan välja en eller flera personer med samma roller. Du måste skapa personerna först.',
        'roles' => 'Roller',
        'roles_hint' =>
            'Du kan välja ingen, en eller flera roller för en person.',
        'submit_add' => 'Lägg till person(er)',
        'remove' => 'Ta bort',
    ],
    'credits' => 'Tack till',
];
