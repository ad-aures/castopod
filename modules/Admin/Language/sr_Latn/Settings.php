<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Opšta podešavanja',
    'instance' => [
        'title' => 'Instance',
        'site_icon' => 'Ikonica sajta',
        'site_icon_delete' => 'Obriši ikonicu sajta',
        'site_icon_hint' => 'Ikone sajtova su ono što vidite na karticama pregledača, traci sa obeleživačima i kada dodate veb lokaciju kao prečicu na mobilnim uređajima.',
        'site_icon_helper' => 'Ikona mora biti kvadratnog oblika i minimum 512px široka i visoka.',
        'site_name' => 'Naziv veb strane',
        'site_description' => 'Opis veb strane',
        'submit' => 'Sačuvaj',
        'editSuccess' => 'Instanca je uspešno ažurirana!',
        'deleteIconSuccess' => 'Ikona veb strane je uspešno uklonjena!',
    ],
    'images' => [
        'title' => 'Slike',
        'subtitle' => 'Ovde možete regenerisati sve slike na osnovu originala koji su otpremljeni. Koristi se ako ustanovite da neke slike nedostaju. Ovaj zadatak može potrajati.',
        'regenerate' => 'Regeneriši slike',
        'regenerationSuccess' => 'Sve slike su uspešno regenerisane!',
    ],
    'housekeeping' => [
        'title' => 'Održavanje',
        'subtitle' => 'Obavlja razne poslove u održavanju. Koristite ovu funkciju ako ikada naiđete na probleme sa medijskim datotekama ili integritetom podataka. Ovi zadaci mogu potrajati.',
        'reset_counts' => 'Resetujte brojače',
        'reset_counts_helper' => 'Ova opcija će ponovo izračunati i resetovati sve podatke (broj pratilaca, objava, komentara,…).',
        'rewrite_media' => 'Ponovo upiši medijske metapodatke',
        'rewrite_media_helper' => 'Ova opcija će izbrisati sve suvišne medijske datoteke i ponovo ih kreirati (slike, audio datoteke, transkripte, poglavlja,…)',
        'rename_episodes_files' => 'Preimenuj audio datoteku epizode',
        'rename_episodes_files_hint' => 'Ova opcija će preimenovati sve audio datoteke epizoda u nasumični niz znakova. Koristite ovo ako je neka od vaših privatnih epizoda procurila jer će je to efektivno sakriti.',
        'clear_cache' => 'Obriši sav keš',
        'clear_cache_helper' => 'Ova opcija će isprazniti redis keš ili datoteke za pisanje/keširanje.',
        'run' => 'Pokreni održavanje',
        'runSuccess' => 'Održavanje je uspešno obavljeno!',
    ],
    'theme' => [
        'title' => 'Tema',
        'accent_section_title' => 'Naglašena boja',
        'accent_section_subtitle' => 'Izaberite boju da biste odredili izgled svih javnih stranica.',
        'pine' => 'Bor zelena',
        'crimson' => 'Tamnocrvena',
        'amber' => 'Ćilibar',
        'lake' => 'Jezero plava',
        'jacaranda' => 'Jakaranda ljubičasta',
        'onyx' => 'Oniks crna',
        'submit' => 'Sačuvaj',
        'setInstanceThemeSuccess' => 'Tema je uspešno ažurirana!',
    ],
];
