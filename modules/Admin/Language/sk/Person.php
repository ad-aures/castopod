<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'persons' => 'Osobnosti',
    'all_persons' => 'Všetky osobnosti',
    'no_person' => 'Nikto nenájdený!',
    'create' => 'Vytvoriť osobnosť',
    'view' => 'Ukázať osobnosť',
    'edit' => 'Upraviť osobnosť',
    'delete' => 'Vymazať osobnosť',
    'messages' => [
        'createSuccess' => 'Person has been successfully created!',
        'editSuccess' => 'Person has been successfully updated!',
        'deleteSuccess' => 'Osobnosť bol/a odstránená!',
    ],
    'form' => [
        'avatar' => 'Avatar',
        'avatar_size_hint' =>
            'Obrázok musí byť štvorcový a minimálne 400px široký a vysoký.',
        'full_name' => 'Celé meno',
        'full_name_hint' => 'This is the full name or alias of the person.',
        'unique_name' => 'Unikátne meno',
        'unique_name_hint' => 'Použité pre URL odkazy',
        'information_url' => 'Informačná URL adresa',
        'information_url_hint' =>
            'Url to a relevant resource of information about the person, such as a homepage or third-party profile platform.',
        'submit_create' => 'Vytvoriť osobnosť',
        'submit_edit' => 'Uložiť osobnosť',
    ],
    'podcast_form' => [
        'title' => 'Spravovať osobnosti',
        'add_section_title' => 'Pridať osobnosti k tomuto podcastu',
        'add_section_subtitle' => 'You may pick several persons and roles.',
        'persons' => 'Osobnosti',
        'persons_hint' =>
            'Môžete vybrať jednu, alebo viac osôb s tou istou rolou. Najprv musíte osobnosti vytvoriť.',
        'roles' => 'Úlohy',
        'roles_hint' =>
            'Pre osobu môžete vybrať žiadnu, jednu, alebo viac rolí.',
        'submit_add' => 'Pridať osob(y)',
        'remove' => 'Odstrániť',
    ],
    'episode_form' => [
        'title' => 'Spravovať osobnosti',
        'add_section_title' => 'Pridať osobnosti k tejto epizóde',
        'add_section_subtitle' => 'Môžete vybrať viacero osôb a rolí.',
        'persons' => 'Osobnosti',
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
