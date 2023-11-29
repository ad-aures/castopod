<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Podcast prenumerationer',
    'add' => 'Ny prenumeration',
    'view' => 'Visa prenumeration',
    'edit' => 'Ändra prenumeration',
    'regenerate_token' => 'Generera om token',
    'suspend' => 'Avaktivera prenumeration',
    'resume' => 'Återuppta prenumeration',
    'delete' => 'Radera prenumeration',
    'status' => [
        'active' => 'Aktiv',
        'suspended' => 'Suspenderad',
        'expired' => 'Utgått',
    ],
    'list' => [
        'number' => 'Nummer',
        'email' => 'Epost',
        'expiration_date' => 'Utgångsdatum',
        'unlimited' => 'Obegränsat',
        'downloads' => 'Nerladdningar',
        'status' => 'Status',
    ],
    'form' => [
        'email' => 'Epost',
        'expiration_date' => 'Utgångsdatum',
        'expiration_date_hint' => 'Datum och tid då prenumerationen går ut. Lämna tomt för ett obegränsat abonnemang.',
        'submit_create' => 'Create subscription',
        'submit_edit' => 'Ändra prenumeration',
    ],
    'form_link_add' => [
        'link' => 'Länk för prenumerationssida',
        'link_hint' => 'Detta kommer att lägga till en uppmaning till åtgärder på webbplatsen som bjuder in lyssnare att prenumerera på podcasten.',
        'submit' => 'Spara länk',
    ],
    'suspend_form' => [
        'disclaimer' => 'Avstängning av abonnemanget kommer att begränsa abonnenten från att ha tillgång till premiuminnehållet. Du kommer fortfarande att kunna lyfta suspensionen efteråt.',
        'reason' => 'Orsak',
        'reason_placeholder' => 'Varför stänger du av prenumerationen?',
        "submit" => 'Avaktivera prenumeration',
    ],
    'delete_form' => [
        'disclaimer' => 'Borttagning av {subscriber}s prenumeration kommer att ta bort all analysdata som är kopplad till den.',
        'understand' => 'Jag förstår, ta bort prenumerationen permanent',
        'submit' => 'Ta bort prenumeration',
    ],
    'messages' => [
        'addSuccess' => 'Ny prenumeration tillagd! Ett välkomstmeddelande skickades till {subscriber}.',
        'addError' => 'Prenumerationen kunde inte läggas till.',
        'editSuccess' => 'Prenumeration utgångsdatum uppdaterades! Ett e-postmeddelande skickades till {subscriber}.',
        'editError' => 'Prenumerationen kunde inte redigeras.',
        'regenerateTokenSuccess' => 'Token regenererad! Ett e-postmeddelande skickades till {subscriber} med den nya token.',
        'regenerateTokenError' => 'Token kunde inte regenereras.',
        'deleteSuccess' => 'Prenumerationen har tagits bort! Ett e-postmeddelande har skickats till {subscriber}.',
        'deleteError' => 'Prenumerationen kunde inte tas bort.',
        'suspendSuccess' => 'Prenumerationen suspenderades! Ett e-postmeddelande skickades till {subscriber}.',
        'suspendError' => 'Prenumerationen kunde inte stängas av.',
        'resumeSuccess' => 'Prenumerationen återupptades! Ett e-postmeddelande skickades till {subscriber}.',
        'resumeError' => 'Prenumerationen kunde inte återupptas.',
        'linkSaveSuccess' => 'Prenumerationslänken har sparats! Den kommer att visas på webbplatsen som en Call To Action!',
        'linkRemoveSuccess' => 'Prenumerationslänken har tagits bort!',
    ],
    'emails' => [
        'greeting' => 'Hej,',
        'token' => 'Din token: {0}',
        'unique_feed_link' => 'Din unika flödeslänk: {0}',
        'how_to_use' => 'Hur gör man?',
        'two_ways' => 'Du har två sätt att låsa upp premiumavsnitt:',
        'import_into_app' => 'Kopiera din unika feed url inuti din favorit podcast-app (importera den som ett privat flöde för att förhindra att du exponerar dina referenser).',
        'go_to_website' => 'Gå till {podcastWebsite}s webbplats och lås upp podcasten med din token.',
        'welcome_subject' => 'Välkommen till {podcastTitle}',
        'welcome' => 'Du har prenumererat på {podcastTitle}, tack och välkommen ombord!',
        'welcome_token_title' => 'Här är dina referenser för att låsa upp podcastens premiumavsnitt:',
        'welcome_expires' => 'Ditt abonnemang var inställt på att löpa ut {0}.',
        'welcome_never_expires' => 'Din prenumeration var inställd på att aldrig upphöra.',
        'reset_subject' => 'Din token återställdes!',
        'reset_token' => 'Din åtkomst till {podcastTitle} har återställts!',
        'reset_token_title' => 'Nya autentiseringsuppgifter har skapats för att du ska kunna låsa upp podcastens premiumavsnitt:',
        'edited_subject' => 'Din prenumeration har uppdaterats!',
        'edited_expires' => 'Ditt abonnemang för {podcastTitle} sattes att löpa ut den {expiresAt}.',
        'edited_never_expires' => 'Din prenumeration på {podcastTitle} har ställts in på att aldrig upphör!',
        'suspended_subject' => 'Din prenumeration har stängts av!',
        'suspended' => 'Din prenumeration på {podcastTitle} har stängts av! Du kan inte längre komma åt podcastens premiumavsnitt.',
        'suspended_reason' => 'Det är av följande skäl: {0}',
        'resumed_subject' => 'Din prenumeration har återupptagits!',
        'resumed' => 'Din prenumeration på {podcastTitle} har återupptagits! Du kan komma åt podcastens premiumavsnitt igen.',
        'deleted_subject' => 'Din prenumeration har tagits bort!',
        'deleted' => 'Din prenumeration på {podcastTitle} har tagits bort! Du har inte längre tillgång till podcastens premiumavsnitt.',
        'footer' => '{castopod} hostas på {host}',
    ],
];
