<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Bendrosios nuostatos',
    'instance' => [
        'title' => 'Serveris',
        'site_icon' => 'Svetainės piktograma',
        'site_icon_delete' => 'Šalinti svetainės piktogramą',
        'site_icon_hint' => 'Svetainės piktograma – tai ženkliukas, matomas naršyklių kortelėse, adresynuose ar įtraukus svetainės nuorodą į mobilųjį telefoną.',
        'site_icon_helper' => 'Piktograma turi būti kvadratinė ir bent 512 taškų aukščio ir pločio.',
        'site_name' => 'Svetainės pavadinimas',
        'site_description' => 'Svetainės aprašymas',
        'submit' => 'Įrašyti',
        'editSuccess' => 'Serveris atnaujintas sėkmingai!',
        'deleteIconSuccess' => 'Svetainės piktograma pašalinta sėkmingai!',
    ],
    'images' => [
        'title' => 'Vaizdai',
        'subtitle' => 'Čia galite iš naujo sugeneruoti visus vaizdo failus, remiantis įkeltais originalais. Galite pasinaudoti, jei kurių nors vaizdo failų pasigendate. Šis procesas gali užtrukti.',
        'regenerate' => 'Pergeneruoti vaizdus',
        'regenerationSuccess' => 'Visi vaizdai sėkmingai pergeneruoti!',
    ],
    'housekeeping' => [
        'title' => 'Apsitvarkymas',
        'subtitle' => 'Atliekami įvairūs apsitvarkymo darbai. Pasinaudokite šia funkcija, jei kada pastebėtumėte problemų su daugialypės terpės failais ar duomenų vientisumu. Šie procesai gali užtrukti.',
        'reset_counts' => 'Atkurti skaitliukus',
        'reset_counts_helper' => 'Perskaičiuoti ir perrašyti visus skaitliukus (sekėjų, įrašų, komentarų ir kt. skaičius).',
        'rewrite_media' => 'Perrašyti daugialypės terpės failų metaduomenis',
        'rewrite_media_helper' => 'Pašalinti visus generuotus daugialypės terpės failus (vaizdus, garso įrašus, nuorašus, skyrelius ir kt.) ir sukurti juos iš naujo',
        'rename_episodes_files' => 'Pervardinti epizodų garso įrašų failus',
        'rename_episodes_files_hint' => 'Pervardinti visus garso įrašų failus atsitiktiniais vardais. Šia parinktimi galite pasinaudoti, jei kas nors nutekintų nuorodą į kurį nors jūsų privatų epizodą, nes tai – paprastas būdas jį vėl paslėpti.',
        'clear_cache' => 'Išvalyti visą podėlį',
        'clear_cache_helper' => 'Ištuštinti „Redis“ podėlį ar podėlio failus.',
        'run' => 'Pradėti apsitvarkymą',
        'runSuccess' => 'Apsitvarkymas sėkmingai paleistas!',
    ],
    'theme' => [
        'title' => 'Apipavidalinimas',
        'accent_section_title' => 'Akcento spalva',
        'accent_section_subtitle' => 'Pasirinkite spalvą, naudotiną visuose viešuosiuose tinklalapiuose.',
        'pine' => 'Pušis',
        'crimson' => 'Raudonis',
        'amber' => 'Gintaras',
        'lake' => 'Ežeras',
        'jacaranda' => 'Žibuoklė',
        'onyx' => 'Oniksas',
        'submit' => 'Įrašyti',
        'setInstanceThemeSuccess' => 'Tema atnaujinta sėkmingai!',
    ],
];
