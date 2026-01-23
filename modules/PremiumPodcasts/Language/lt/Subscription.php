<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Tinklalaidžių prenumeratos',
    'add' => 'Nauja prenumerata',
    'view' => 'Peržiūrėti prenumeratą',
    'edit' => 'Keisti prenumeratą',
    'regenerate_token' => 'Perkurti prieigos raktą',
    'suspend' => 'Pristabdyti prenumeratą',
    'resume' => 'Atstatyti prenumeratą',
    'delete' => 'Šalinti prenumeratą',
    'status' => [
        'active' => 'Aktyvi',
        'suspended' => 'Pristabdyta',
        'expired' => 'Nebegalioja',
    ],
    'list' => [
        'number' => 'Numeris',
        'email' => 'El. paštas',
        'expiration_date' => 'Galiojimo pabaigos data',
        'unlimited' => 'Neribota',
        'downloads' => 'Parsisiuntimai',
        'status' => 'Būsena',
    ],
    'form' => [
        'email' => 'El. paštas',
        'expiration_date' => 'Galiojimo pabaigos data',
        'expiration_date_hint' => 'Data ir laikas, iki kada prenumerata galioja. Palikite lauką tuščią neribotai prenumeratai.',
        'submit_create' => 'Kurti prenumeratą',
        'submit_edit' => 'Taisyti prenumeratą',
    ],
    'form_link_add' => [
        'link' => 'Prenumeratos tinklalapio adresas',
        'link_hint' => 'Užpildžius šią formą, svetainėje bus pridėta raginimo šią tinklalaidę prenumeruoti forma.',
        'submit' => 'Įrašyti nuorodą',
    ],
    'suspend_form' => [
        'disclaimer' => 'Pristabdžius šią prenumeratą, bus apribota prenumeratoriaus prieiga prie premium turinio. Prenumeratą galėsite atstatyti.',
        'reason' => 'Priežastis',
        'reason_placeholder' => 'Kodėl pristabdote šią prenumeratą?',
        "submit" => 'Pristabdyti prenumeratą',
    ],
    'delete_form' => [
        'disclaimer' => 'Pašalinus {subscriber} prenumeratą, bus pašalinti ir visi su ja susiję analitikos duomenys.',
        'understand' => 'Suprantu, noriu visam laikui pašalinti prenumeratą',
        'submit' => 'Pašalinti prenumeratą',
    ],
    'messages' => [
        'addSuccess' => 'Nauja prenumerata pridėta! {subscriber} turėtų netrukus gauti pasisveikinimo el. laišką.',
        'addError' => 'Prenumeratos pridėti nepavyko.',
        'editSuccess' => 'Prenumeratos galiojimo pabaigos data atnaujinta! {subscriber} netrukus turėtų gauti el. laišką.',
        'editError' => 'Prenumeratos pakeisti nepavyko.',
        'regenerateTokenSuccess' => 'Prieigos raktas perkurtas! {subscriber} turėtų netrukus gauti el. laišką su naujuoju prieigos raktu.',
        'regenerateTokenError' => 'Prieigos rakto perkurti nepavyko.',
        'deleteSuccess' => 'Prenumerata pašalinta! {subscriber} turėtų netrukus gauti el. laišką.',
        'deleteError' => 'Prenumeratos pašalinti nepavyko.',
        'suspendSuccess' => 'Prenumerata pristabdyta! {subscriber} turėtų netrukus gauti el. laišką.',
        'suspendError' => 'Prenumeratos pristabdyti nepavyko.',
        'resumeSuccess' => 'Prenumerata atstatyta! {subscriber} turėtų netrukus gauti el. laišką.',
        'resumeError' => 'Prenumeratos atstatyti nepavyko.',
        'linkSaveSuccess' => 'Prenumeratos nuoroda įrašyta sėkmingai! Ji bus rodoma svetainėje kaip raginimas veikti!',
        'linkRemoveSuccess' => 'Prenumeratos nuoroda pašalinta sėkmingai!',
    ],
    'emails' => [
        'greeting' => 'Sveiki,',
        'token' => 'Jūsų prieigos raktas: {0}',
        'unique_feed_link' => 'Jūsų asmeninio sklaidos kanalo adresas: {0}',
        'how_to_use' => 'Kaip naudotis?',
        'two_ways' => 'Yra du būdai premium epizodams atrakinti:',
        'import_into_app' => 'Galite nukopijuoti savo asmeninio sklaidos kanalo URL į mėgstamą tinklalaidžių klausymosi programą. Nepamirškite pasirinkti, jog tai privatus sklaidos kanalas, kad neatskleistumėte savo prisijungimo duomenų.',
        'go_to_website' => 'Galite atverti „{podcastWebsite}“ svetainę ir atrakinti tinklalaidę, naudodamiesi prieigos raktu.',
        'welcome_subject' => 'Jus sveikina „{podcastTitle}“',
        'welcome' => 'Jūs užsiprenumeravote tinklalaidę „{podcastTitle}“. Dėkojame ir sveikiname prisijungus!',
        'welcome_token_title' => 'Žemiau pateikiame jūsų prisijungimo duomenis tinklalaidės premium epizodams atrakinti:',
        'welcome_expires' => 'Jūsų prenumerata galioja iki {0}.',
        'welcome_never_expires' => 'Jūsų prenumerata galioja neterminuotai.',
        'reset_subject' => 'Jūsų prieigos raktas perkurtas!',
        'reset_token' => 'Jūsų prieigos prie tinklalaidės „{podcastTitle}“ raktas perkurtas!',
        'reset_token_title' => 'Jums sugeneruoti nauji prisijungimo duomenys šios tinklalaidės premium epizodams atrakinti:',
        'edited_subject' => 'Jūsų prenumerata pakoreguota!',
        'edited_expires' => 'Jūsų tinklalaidės „{podcastTitle}“ prenumerata galios iki {expiresAt}.',
        'edited_never_expires' => 'Jūsų tinklalaidės „{podcastTitle}“ prenumerata galios neterminuotai!',
        'suspended_subject' => 'Jūsų prenumerata pristabdyta!',
        'suspended' => 'Jūsų tinklalaidės „{podcastTitle}“ prenumerata pristabdyta! Šios tinklalaidės premium epizodų pasiekti nebegalėsite.',
        'suspended_reason' => 'Tai įvyko dėl šios priežasties: {0}',
        'resumed_subject' => 'Jūsų prenumerata atstatyta!',
        'resumed' => 'Jūsų tinklalaidės „{podcastTitle}“ prenumerata atstatyta! Jūs vėl galte pasiekti šios tinklalaidės premium epizodus.',
        'deleted_subject' => 'Jūsų prenumerata atšaukta!',
        'deleted' => 'Jūsų tinklalaidės „{podcastTitle}“ prenumerata atšaukta! Šios tinklalaidės premium epizodų pasiekti nebegalėsite.',
        'footer' => '{castopod}, veikianti serveryje {host}',
    ],
];
