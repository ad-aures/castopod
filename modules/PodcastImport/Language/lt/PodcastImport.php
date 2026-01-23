<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'banner' => [
        'disclaimer' => 'Importuojama',
        'text' => 'Tinklalaidė „{podcastTitle}“ šiuo metu importuojama.',
        'cta' => 'Rodyti importo būseną',
    ],
    'old_podcast_section_title' => 'Importuotina tinklalaidė',
    'old_podcast_legal_disclaimer_title' => 'Atsakomybės išsižadėjimas',
    'old_podcast_legal_disclaimer' =>
        'Prieš importuodami šią tinklalaidę, įsitikinkite, jog turite teisę tai daryti. Kopijuojant ir retransliuojant tinklalaidę, neturint tam reikiamų teisių, yra piratavimas, už tai gali būti baudžiama.',
    'imported_feed_url' => 'Sklaidos kanalo URL',
    'imported_feed_url_hint' => 'Sklaidos kanalas turi būti XML arba RSS formatu.',
    'new_podcast_section_title' => 'Naujoji tinklalaidė',
    'lock_import' =>
        'Šis sklaidos kanalas apsaugotas. Jo importuoti negalite. Jei esate savininkas, atjunkite jo apsaugą dabartinėje platformoje.',
    'submit' => 'Įtraukti importą į eilę',
    'queue' => [
        'status' => [
            'label' => 'Būsena',
            'queued' => 'eilėje',
            'queued_hint' => 'Importo užduotis laukia apdorojimo.',
            'canceled' => 'atsisakyta',
            'canceled_hint' => 'Importo užduotis atšaukta.',
            'running' => 'vykdoma',
            'running_hint' => 'Importo užduotis šiuo metu apdorojama.',
            'failed' => 'nepavyko',
            'failed_hint' => 'Importo užduotis nepayko: scenarijaus klaida.',
            'passed' => 'atlikta',
            'passed_hint' => 'Importo užduotis užbaigta sėkmingai!',
        ],
        'feed' => 'Sklaidos kanalas',
        'duration' => 'Importo trukmė',
        'imported_episodes' => 'Importuota epizodų',
        'imported_episodes_hint' => '{newlyImportedCount, plural,
            one {# importuotas naujai}
            few {# importuoti naujai}
            other {# importuota naujai}
        }, {alreadyImportedCount, plural,
            one {# jau buvo importuotas}
            few {# jau buvo importuoti}
            other {# jau buvo importuota}
        }.',
        'actions' => [
            'cancel' => 'Atsisakyti',
            'retry' => 'Bandyti dar kartą',
            'delete' => 'Šalinti',
        ],
    ],
    'syncForm' => [
        'title' => 'Sinchronizuoti sklaidos kanalus',
        'feed_url' => 'Sklaidos kanalo URL',
        'feed_url_hint' => 'Sklaidos kanalo, kurį norite sinchronizuoti su šia tinklalaide, URL.',
        'submit' => 'Įtraukti į eilę',
    ],
    'messages' => [
        'canceled' => 'Importo užduotis sėkmingai atšaukta!',
        'notRunning' => 'Importo užduoties atšaukti nepavyko, nes ji nevykdoma.',
        'alreadyRunning' => 'Importo užduotis jau vykdoma. Prieš bandydami iš naujo, galite ją atšaukti.',
        'retried' => 'Importo užduotis įtraukta į eilę, netrukus bus ją bus bandoma vykdyti iš naujo!',
        'deleted' => 'Importo užduotis sėkmingai pašalinta!',
        'importTaskQueued' => 'Nauja importo užduotis įtraukta į eilę, importas bus pradėtas netrukus!',
        'syncTaskQueued' => 'Nauja importo užduotis įtraukta į eilę, sinchronizavimas bus pradėtas netrukus!',
    ],
];
