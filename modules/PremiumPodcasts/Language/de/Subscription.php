<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Podcast-Abonnements',
    'add' => 'Neues Abonnement',
    'view' => 'Abonnement anzeigen',
    'edit' => 'Abonnement bearbeiten',
    'regenerate_token' => 'Token neu generieren',
    'suspend' => 'Abonnement unterbrechen',
    'resume' => 'Abonnement fortsetzen',
    'delete' => 'Abonnement löschen',
    'status' => [
        'active' => 'Aktiv',
        'suspended' => 'Unterbrochen',
        'expired' => 'Abgelaufen',
    ],
    'list' => [
        'number' => 'Nummer',
        'email' => 'E-Mail',
        'expiration_date' => 'Ablaufdatum',
        'unlimited' => 'Unbegrenzt',
        'downloads' => 'Downloads',
        'status' => 'Status',
    ],
    'form' => [
        'email' => 'E-Mail',
        'expiration_date' => 'Ablaufdatum',
        'expiration_date_hint' => 'Das Datum und die Uhrzeit, zu der das Abonnement abläuft. Leer lassen für ein unbegrenztes Abonnement.',
        'submit_add' => 'Abonnement hinzufügen',
        'submit_edit' => 'Abonnement bearbeiten',
    ],
    'form_link_add' => [
        'link' => 'Subscription page link',
        'link_hint' => 'This will add a call to action in the website inviting listeners to subscribe to the podcast.',
        'submit' => 'Link speichern',
    ],
    'suspend_form' => [
        'disclaimer' => 'Suspending the subscription will restrict the subscriber from having access to the premium content. You will still be able to lift the suspension afterwards.',
        'reason' => 'Grund',
        'reason_placeholder' => 'Warum unterbrechen Sie Ihr Abonnement?',
        "submit" => 'Abonnement unterbrechen',
    ],
    'delete_form' => [
        'disclaimer' => 'Deleting {subscriber}\'s subscription will remove all analytics data associated with it.',
        'understand' => 'Ich verstehe, entferne das Abonnement dauerhaft',
        'submit' => 'Abonnement entfernen',
    ],
    'messages' => [
        'addSuccess' => 'New subscription added! A welcome email was sent to {subscriber}.',
        'addError' => 'Subscription could not be added.',
        'editSuccess' => 'Subscription expiry date was updated! An email was sent to {subscriber}.',
        'editError' => 'Abonnement konnte nicht bearbeitet werden.',
        'regenerateTokenSuccess' => 'Token regenerated! An email was sent to {subscriber} with the new token.',
        'regenerateTokenError' => 'Schlüssel konnte nicht neu generiert werden.',
        'deleteSuccess' => 'Subscription was removed! An email was sent to {subscriber}.',
        'deleteError' => 'Subscription could not be removed.',
        'suspendSuccess' => 'Subscription was suspended! An email was sent to {subscriber}.',
        'suspendError' => 'Subscription could not be suspended.',
        'resumeSuccess' => 'Subscription was resumed! An email was sent to {subscriber}.',
        'resumeError' => 'Subscription could not be resumed.',
        'linkSaveSuccess' => 'Subscription link was saved successfully! It will appear in the website as a Call To Action!',
        'linkRemoveSuccess' => 'Subscription link was removed successfully!',
    ],
    'emails' => [
        'greeting' => 'Hey,',
        'token' => 'Ihr Token: {0}',
        'unique_feed_link' => 'Ihr eindeutiger Feed-Link: {0}',
        'how_to_use' => 'Wie nutzt man es?',
        'two_ways' => 'You have two ways of unlocking the premium episodes:',
        'import_into_app' => 'Copy your unique feed url inside your favourite podcast app (import it as a private feed to prevent exposing your credentials).',
        'go_to_website' => 'Go to {podcastWebsite}\'s website and unlock the podcast with your token.',
        'welcome_subject' => 'Willkommen bei {podcastTitle}',
        'welcome' => 'You have subscribed to {podcastTitle}, thank you and welcome aboard!',
        'welcome_token_title' => 'Here are your credentials to unlock the podcast\'s premium episodes:',
        'welcome_expires' => 'Your subscription was set to expire on {0}.',
        'welcome_never_expires' => 'Your subscription was set to never expire.',
        'reset_subject' => 'Your token was reset!',
        'reset_token' => 'Your access to {podcastTitle} has been reset!',
        'reset_token_title' => 'New credentials have been generated for you to unlock the podcast\'s premium episodes:',
        'edited_subject' => 'Ihr Abonnement wurde aktualisiert!',
        'edited_expires' => 'Your subscription for {podcastTitle} was set to expire on {expiresAt}.',
        'edited_never_expires' => 'Your subscription for {podcastTitle} was set to never expire!',
        'suspended_subject' => 'Ihr Abonnement wurde pausiert!',
        'suspended' => 'Your subscription for {podcastTitle} has been suspended! You can no longer access the podcast\'s premium episodes.',
        'suspended_reason' => 'Das ist aus dem folgenden Grund: {0}',
        'resumed_subject' => 'Ihr Abonnement wurde wieder aufgenommen!',
        'resumed' => 'Your subscription for {podcastTitle} has been resumed! You may access the podcast\'s premium episodes again.',
        'deleted_subject' => 'Ihr Abonnement wurde entfernt!',
        'deleted' => 'Your subscription for {podcastTitle} has been removed! You no longer have access to the podcast\'s premium episodes.',
        'footer' => '{castopod} betrieben auf {host}',
    ],
];
