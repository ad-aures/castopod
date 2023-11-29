<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Abonnement til podkasten',
    'add' => 'Nytt abonnement',
    'view' => 'Vis abonnementet',
    'edit' => 'Rediger abonnementet',
    'regenerate_token' => 'Regenerer nykel',
    'suspend' => 'Stopp abonnementet',
    'resume' => 'Start oppatt abonnementet',
    'delete' => 'Slett abonnementet',
    'status' => [
        'active' => 'Aktiv',
        'suspended' => 'Stoppa',
        'expired' => 'Utgått',
    ],
    'list' => [
        'number' => 'Nummer',
        'email' => 'Epost',
        'expiration_date' => 'Gyldig til',
        'unlimited' => 'Uavgrensa',
        'downloads' => 'Nedlastingar',
        'status' => 'Status',
    ],
    'form' => [
        'email' => 'Epost',
        'expiration_date' => 'Gyldig til',
        'expiration_date_hint' => 'Datoen og tidspunket abonnementet stoppar. La det stå tomt viss abonnementet skal gå utan sluttdato.',
        'submit_create' => 'Create subscription',
        'submit_edit' => 'Rediger abonnementet',
    ],
    'form_link_add' => [
        'link' => 'Lenke til abonnementssida',
        'link_hint' => 'Her legg du til ei oppmoding på nettsida di, der du inviterer lyttarane til å abonnera på podkasten din.',
        'submit' => 'Lagre lenka',
    ],
    'suspend_form' => [
        'disclaimer' => 'Viss du stoppar abonnementet, vil ikkje abonnenten lenger få tilgang til betalt innhald. Du kan starta abonnementet att seinare.',
        'reason' => 'Grunngjeving',
        'reason_placeholder' => 'Kvifor stoppar du abonnementet?',
        "submit" => 'Stopp abonnementet',
    ],
    'delete_form' => [
        'disclaimer' => 'Viss du slettar abonnementet til {subscriber}, slettar du òg alle analysedata knytt til abonnementet.',
        'understand' => 'Eg forstår, slett abonnementet',
        'submit' => 'Slett abonnementet',
    ],
    'messages' => [
        'addSuccess' => 'Du har fått ein ny abonnent! Me har sendt ein velkomstepost til {subscriber}.',
        'addError' => 'Greidde ikkje leggja til abonnementet.',
        'editSuccess' => 'Stoppdatoen for abonnementet er oppdatert! Me har sendt ein epost til {subscriber}.',
        'editError' => 'Greidde ikkje redigera abonnementet.',
        'regenerateTokenSuccess' => 'Nykelen er regenerert! Me sende ein epost til {subscriber} med den nye nykelen.',
        'regenerateTokenError' => 'Greidde ikkje regenerera nykelen.',
        'deleteSuccess' => 'Abonnementet er sletta! Me sende ein epost til {subscriber}.',
        'deleteError' => 'Greidde ikkje sletta abonnementet.',
        'suspendSuccess' => 'Abonnementet vart stoppa! Me sende ein epost til {subscriber}.',
        'suspendError' => 'Greidde ikkje stoppa abonnementet.',
        'resumeSuccess' => 'Abonnementet er starta att! Me sende ein epost til {subscriber}.',
        'resumeError' => 'Greidde ikkje starta abonnementet att.',
        'linkSaveSuccess' => 'Abonnementslenka er lagra. Ho vil visa på nettstaden som ei handlingsvarsling.',
        'linkRemoveSuccess' => 'Abonnementslenka vart fjerna.',
    ],
    'emails' => [
        'greeting' => 'Hei',
        'token' => 'Nykelen din: {0}',
        'unique_feed_link' => 'Den unike lenka til straumen: {0}',
        'how_to_use' => 'Korleis skal eg bruka dette?',
        'two_ways' => 'Du kan låsa opp betalte episodar på to måtar:',
        'import_into_app' => 'Kopier den unike adressa til podkaststraumen til favoritt-podkastappen din (importer adressa som ein privat straum slik at du ikkje avslører innloggingsopplysingane dine).',
        'go_to_website' => 'Gå til heimesida til {podcastWebsite} og lås opp podkasten med nykelen.',
        'welcome_subject' => 'Velkomen til {podcastTitle}',
        'welcome' => 'Du abonnerer på {podcastTitle}. Takk, og velkomen ombord!',
        'welcome_token_title' => 'Her er nykelen for å få tilgang til dei betalte episodane til podkasten:',
        'welcome_expires' => 'Abonnementet ditt hadde stoppdato {0}.',
        'welcome_never_expires' => 'Abonnementet ditt hadde ingen stoppdato.',
        'reset_subject' => 'Nykelen din er nullstilt!',
        'reset_token' => 'Tilgangen din til {podcastTitle} er nullstilt!',
        'reset_token_title' => 'Me har laga nye tilgangsopplysingar for deg for å få tilgang til dei betalte episodane til podkasten:',
        'edited_subject' => 'Abonnementet ditt er oppdatert!',
        'edited_expires' => 'Abonnementet ditt på {podcastTitle} hadde stoppdato {expiresAt}.',
        'edited_never_expires' => 'Abonnementet ditt på {podcastTitle} hadde ingen stoppdato!',
        'suspended_subject' => 'Abonnementet ditt er stoppa!',
        'suspended' => 'Abonnementet ditt på {podcastTitle} er stoppa! Du har ikkje lenger tilgang til dei betalte episodane til denne podkasten.',
        'suspended_reason' => 'Det er av desse grunnane: {0}',
        'resumed_subject' => 'Abonnementet ditt har starta att!',
        'resumed' => 'Abonnementet ditt på {podcastTitle} har starta att! Du har tilgang til dei betalte episodane til denne podkasten.',
        'deleted_subject' => 'Abonnementet ditt er sletta!',
        'deleted' => 'Abonnementet ditt på {podcastTitle} er sletta! Du har ikkje lenger tilgang til dei betalte episodane til podkasten.',
        'footer' => '{castopod} køyrer på {host}',
    ],
];
