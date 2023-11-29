<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Podcast abonnementen',
    'add' => 'Nieuw abonnement',
    'view' => 'Bekijk abonnement',
    'edit' => 'Bewerk abonnement',
    'regenerate_token' => 'Sleutel opnieuw genereren',
    'suspend' => 'Abonnement opschorten',
    'resume' => 'Abonnement hervatten',
    'delete' => 'Abonnement verwijderen',
    'status' => [
        'active' => 'Actief',
        'suspended' => 'Opgeschort',
        'expired' => 'Verlopen',
    ],
    'list' => [
        'number' => 'Nummer',
        'email' => 'E-mail',
        'expiration_date' => 'Vervaldatum',
        'unlimited' => 'Onbeperkt',
        'downloads' => 'Downloads',
        'status' => 'Status',
    ],
    'form' => [
        'email' => 'E-mail',
        'expiration_date' => 'Vervaldatum',
        'expiration_date_hint' => 'De datum en tijd waarop het abonnement verloopt. Laat leeg voor een onbeperkt abonnement.',
        'submit_create' => 'Create subscription',
        'submit_edit' => 'Bewerk abonnement',
    ],
    'form_link_add' => [
        'link' => 'Abonnementspagina link',
        'link_hint' => 'Dit zal een call-to-action toevoegen op de website die luisteraars uitnodigt om zich te abonneren op de podcast.',
        'submit' => 'Link opslaan',
    ],
    'suspend_form' => [
        'disclaimer' => 'Opschorting van het abonnement zorgt ervoor dat de abonnee geen toegang meer heeft tot premium inhoud. U kunt de opschorting op ieder moment opheffen.',
        'reason' => 'Reden',
        'reason_placeholder' => 'Waarom wilt u het abonnement onderbreken?',
        "submit" => 'Abonnement opschorten',
    ],
    'delete_form' => [
        'disclaimer' => 'Het verwijderen van het abonnement van {subscriber} zal alle statistieken ervan verwijderen.',
        'understand' => 'Ik begrijp het, verwijder het abonnement permanent',
        'submit' => 'Abonnement verwijderen',
    ],
    'messages' => [
        'addSuccess' => 'Nieuw abonnement toegevoegd! Er is een welkomstmail is naar {subscriber} gestuurd.',
        'addError' => 'Abonnement kon niet worden toegevoegd.',
        'editSuccess' => 'Abonnement vervaldatum is bijgewerkt! Er is een e-mail verzonden naar {subscriber}.',
        'editError' => 'Abonnement kon niet worden bijgewerkt.',
        'regenerateTokenSuccess' => 'Token vernieuwd! Er is een e-mail verzonden naar {subscriber} met de nieuwe gegevens.',
        'regenerateTokenError' => 'Token kon niet worden vernieuwd.',
        'deleteSuccess' => 'Abonnement is verwijderd! Er is een e-mail verzonden naar {subscriber}.',
        'deleteError' => 'Abonnement kon niet worden verwijderd.',
        'suspendSuccess' => 'Abonnement is opgeschort! Er is een e-mail verzonden naar {subscriber}.',
        'suspendError' => 'Abonnement kon niet opgeschort worden.',
        'resumeSuccess' => 'Abonnement is hervat! Er is een e-mail verzonden naar {subscriber}.',
        'resumeError' => 'Abonnement kon niet worden hervat.',
        'linkSaveSuccess' => 'Abonnementlink is succesvol opgeslagen! Het zal verschijnen op de website als een call-to-action!',
        'linkRemoveSuccess' => 'Abonnementlink is succesvol verwijderd!',
    ],
    'emails' => [
        'greeting' => 'Hoi,',
        'token' => 'Uw token: {0}',
        'unique_feed_link' => 'Uw persoonlijke feed: {0}',
        'how_to_use' => 'Gebruiksaanwijzing',
        'two_ways' => 'Je hebt twee manieren om toegang te krijgen tot de premium afleveringen:',
        'import_into_app' => 'Kopieer uw persoonlijke feed in je favoriete podcast app (importeer deze als een privé feed om te voorkomen dat je inloggegevens worden gedeeld).',
        'go_to_website' => 'Ga naar de website van {podcastWebsite} en krijgt toegang tot de podcast met uw persoonlijke token.',
        'welcome_subject' => 'Welkom bij {podcastTitle}',
        'welcome' => 'Je bent geabonneerd op {podcastTitle}, bedankt en welkom bij de club!',
        'welcome_token_title' => 'Hier zijn uw inloggegevens om toegang te krijgen tot de premium afleveringen van de podcast:',
        'welcome_expires' => 'Uw abonnement verloopt op {0}.',
        'welcome_never_expires' => 'Uw abonnement stopt niet automatisch.',
        'reset_subject' => 'Je token is vernieuwd!',
        'reset_token' => 'Uw toegang tot {podcastTitle} is gereset!',
        'reset_token_title' => 'Nieuwe inloggegevens zijn gegenereerd om toegang tot de premium afleveringen van de podcast te krijgen:',
        'edited_subject' => 'Uw abonnement is bijgewerkt!',
        'edited_expires' => 'Je abonnement voor {podcastTitle} vervalt op {expiresAt}.',
        'edited_never_expires' => 'Je abonnement voor {podcastTitle} is ingesteld om niet automatisch te verlopen!',
        'suspended_subject' => 'Uw abonnement is opgeschort!',
        'suspended' => 'Uw abonnement voor {podcastTitle} is opgeschort! U heeft niet langer toegang tot de premium afleveringen van de podcast.',
        'suspended_reason' => 'Dat is gebeurd om de volgende reden: {0}',
        'resumed_subject' => 'Uw abonnement is hervat!',
        'resumed' => 'Uw abonnement op {podcastTitle} is hervat! U heeft weer toegang tot de premium afleveringen van de podcast.',
        'deleted_subject' => 'Uw abonnement is beëindigd!',
        'deleted' => 'Uw abonnement op {podcastTitle} is verwijderd! U heeft niet langer toegang tot de premium afleveringen van de podcast.',
        'footer' => '{castopod} gehost op {host}',
    ],
];
