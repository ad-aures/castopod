<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Podkast pretplate',
    'add' => 'Nova pretplata',
    'view' => 'Pogledaj pretplatu',
    'edit' => 'Uredi pretplatu',
    'regenerate_token' => 'Regeneriši token',
    'suspend' => 'Ukini pretplatu',
    'resume' => 'Nastavi pretplatu',
    'delete' => 'Obriši pretplatu',
    'status' => [
        'active' => 'Aktivno',
        'suspended' => 'Ukinuto',
        'expired' => 'Isteklo',
    ],
    'list' => [
        'number' => 'Broj',
        'email' => 'E-pošta',
        'expiration_date' => 'Datum Isteka',
        'unlimited' => 'Neograničeno',
        'downloads' => 'Preuzimanja',
        'status' => 'Status',
    ],
    'form' => [
        'email' => 'E-pošta',
        'expiration_date' => 'Datum Isteka',
        'expiration_date_hint' => 'Datum i vreme kada pretplata ističe. Ostavite prazno za neograničenu pretplatu.',
        'submit_create' => 'Napravi pretplatu',
        'submit_edit' => 'Uredi pretplatu',
    ],
    'form_link_add' => [
        'link' => 'Veza strane za pretplate',
        'link_hint' => 'Ovo će dodati poziv na akciju na veb lokaciji koji poziva slušaoce da se pretplate na podkast.',
        'submit' => 'Sačuvaj vezu',
    ],
    'suspend_form' => [
        'disclaimer' => 'Obustavljanje pretplate će ograničiti pretplatniku pristup premijum sadržaju. I dalje ćete moći da uklonite obustavu nakon toga.',
        'reason' => 'Razlog',
        'reason_placeholder' => 'Zašto ukidate pretplatu?',
        "submit" => 'Ukini pretplatu',
    ],
    'delete_form' => [
        'disclaimer' => 'Brisanje {subscriber} pretplate će ukloniti svu analitiku vezanu za tog pretplatnika.',
        'understand' => 'Razumem, želim da trajno ukinem pretplatu',
        'submit' => 'Ukloni pretplatu',
    ],
    'messages' => [
        'addSuccess' => 'Nova pretplata dodata! Poruka dobrodođlice je poslata {subscriber} putem E-pošte.',
        'addError' => 'Nije moguće dodati pretplatu.',
        'editSuccess' => 'Datum isteka pretplate je ažuriran! Poruka je poslata {subscriber} putem E-pošte.',
        'editError' => 'Nije moguće urediti pretplatu.',
        'regenerateTokenSuccess' => 'Token regenerisan! Novi token je poslat {subscriber} putem E-pošte.',
        'regenerateTokenError' => 'Token nije moguće regenerisati.',
        'deleteSuccess' => 'Pretplata je uklonjena! Poruka je poslata {subscriber} putem E-pošte.',
        'deleteError' => 'Nije moguće ukloniti pretplatu.',
        'suspendSuccess' => 'Pretplata je ukinuta! Poruka je poslata {subscriber} putem E-pošte.',
        'suspendError' => 'Nije moguće prekinuti pretplatu.',
        'resumeSuccess' => 'Pretplana je obnovljena! Poruka je poslata {subscriber} putem E-pošte.',
        'resumeError' => 'Nije moguće obnoviti pretplatu.',
        'linkSaveSuccess' => 'Veza za pretplatu je uspešno sačuvana! Pojaviće se na Veb strani kao poziv na akciju!',
        'linkRemoveSuccess' => 'Veza za pretplatu je uspešno uklonjena!',
    ],
    'emails' => [
        'greeting' => 'Hej,',
        'token' => 'Vaš token: {0}',
        'unique_feed_link' => 'Vaša jedinstvena veza sa fidom: {0}',
        'how_to_use' => 'Kako se koristi?',
        'two_ways' => 'Imate dva načina kako možete otključati premijum epizode:',
        'import_into_app' => 'Kopirajte svoj jedinstveni url fid u svoju omiljenu aplikaciju za podkaste (uvezite ga kao privatni fid da biste sprečili otkrivanje vaših akreditiva).',
        'go_to_website' => 'Idite na {podcastWebsite} veb stranicu i otključajte podkast koristeći vaš token.',
        'welcome_subject' => 'Dobrodošli na {podcastTitle}',
        'welcome' => 'Pretplatili ste se na {podcastTitle}, hvala vam i dobrodošli!',
        'welcome_token_title' => 'Evo vaših akreditiva kojima otključavate premijum epizode ovog podkasta:',
        'welcome_expires' => 'Vaša pretplata ističe {0}.',
        'welcome_never_expires' => 'Vaša pretplata je podešena tako da ne može da istekne.',
        'reset_subject' => 'Vaš token je resetovan!',
        'reset_token' => 'Vaš pristup {podcastTitle} je resetovan!',
        'reset_token_title' => 'Nove akreditive su kreirane kako bi ste pristupili premijum epizodama podkasta:',
        'edited_subject' => 'Vaša pretplata je ažurirana!',
        'edited_expires' => 'Vaša pretplata na {podcastTitle} ističe {expiresAt}.',
        'edited_never_expires' => 'Vaša pretplata na {podcastTitle} je podešena tako da nikad ne istekne!',
        'suspended_subject' => 'Vaša pretplata je ukinuta!',
        'suspended' => 'Vaša pretplata na {podcastTitle} je ukinuta! Više ne možete pristupiti premijum epizodama ovog podkasta.',
        'suspended_reason' => 'Razlog: {0}',
        'resumed_subject' => 'Vaša pretplata je ponovo pokrenuta!',
        'resumed' => 'Vaša pretplata na {podcastTitle} je ponovo pokrenuta! Sada ponovo možete pristupiti premijum epizodama ovog podkasta.',
        'deleted_subject' => 'Vaša pretplata je uklonjena!',
        'deleted' => 'Vaša pretplata na {podcastTitle} je uklonjena! Vipe ne možete pristupiti premijum epizodama ovog podkasta.',
        'footer' => '{castopod} hostovan na {host}',
    ],
];
