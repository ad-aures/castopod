<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'warning' =>
        'Šis procesas gali ilgai užtrukti. Šioje versijoje jokios proceso eigos jūs nematysite, kol jis nebus užbaigtas. Jei procesas netilptų į jam skirtąjį laiką ir gautumėte apie tai klaidos pranešimą, padidinkite `max_execution_time` reiškmę.',
    'old_podcast_section_title' => 'Importuotina tinklalaidė',
    'old_podcast_section_subtitle' =>
        'Prieš importuodami šią tinklalaidę, įsitikinkite, jog turite teisę tai daryti. Kopijuojant ir retransliuojant tinklalaidę, neturint tam reikiamų teisių, yra piratavimas, už tai gali būti baudžiama.',
    'imported_feed_url' => 'Sklaidos kanalo URL',
    'imported_feed_url_hint' => 'Sklaidos kanalas turi būti XML arba RSS formatu.',
    'new_podcast_section_title' => 'Naujoji tinklalaidė',
    'advanced_params_section_title' => 'Papildomi parametrai',
    'advanced_params_section_subtitle' =>
        'Jei nežinote, kam šie laukai reikalingi, palikite numatytąsias reikšmes.',
    'slug_field' => 'Laukas, naudotinas epizodų nuorodiniams pavadinimams formuoti',
    'description_field' =>
        'Laukas su epizodų aprašymais ir rodomomis pastabomis',
    'force_renumber' => 'Pernumeruoti epizodus',
    'force_renumber_hint' =>
        'Pasirinkite, jei jūsų tinklalaidėje epizodai nesunumberuoti, bet norite, kad jie būtų sunumeruoti importo metu.',
    'season_number' => 'Sezono numeris',
    'season_number_hint' =>
        'Įveskite reikšmę, jei jūsų tinklalaidė nenurodo sezono numerio, tačiau norite jį nustatyti importo metu. Priešingu atveju lauką palikite tuščią.',
    'max_episodes' => 'Didžiausias leistinas importuotinų epizodų skaičius',
    'max_episodes_hint' => 'Palikite lauką tuščią, jeigu norite importuoti visus epizodus',
    'lock_import' =>
        'Šis sklaidos kanalas apsaugotas. Jo importuoti negalite. Jei esate savininkas, atjunkite jo apsaugą dabartinėje platformoje.',
    'submit' => 'Importuoti tinklalaidę',
];
