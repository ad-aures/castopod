<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Abonamente Podcast',
    'add' => 'Abonament nou',
    'view' => 'Vizualizare abonament',
    'edit' => 'Editare abonament',
    'regenerate_token' => 'Regenerează token de autentificare',
    'suspend' => 'Suspendare abonament',
    'resume' => 'Reluare abonament',
    'delete' => 'Şterge abonamentul',
    'status' => [
        'active' => 'Activ',
        'suspended' => 'Suspendat',
        'expired' => 'Expirat',
    ],
    'list' => [
        'number' => 'Număr',
        'email' => 'E-mail',
        'expiration_date' => 'Data expirării',
        'unlimited' => 'Nelimitat',
        'downloads' => 'Descărcări',
        'status' => 'Status',
    ],
    'form' => [
        'email' => 'E-mail',
        'expiration_date' => 'Data expirării',
        'expiration_date_hint' => 'Data și ora la care expiră abonamentul. Lăsați gol pentru un abonament nelimitat.',
        'submit_create' => 'Create subscription',
        'submit_edit' => 'Editare abonament',
    ],
    'form_link_add' => [
        'link' => 'Link-ul paginii de abonare',
        'link_hint' => 'This will add a call to action in the website inviting listeners to subscribe to the podcast.',
        'submit' => 'Save link',
    ],
    'suspend_form' => [
        'disclaimer' => 'Suspending the subscription will restrict the subscriber from having access to the premium content. You will still be able to lift the suspension afterwards.',
        'reason' => 'Reason',
        'reason_placeholder' => 'Why are you suspending the subscription?',
        "submit" => 'Suspend subscription',
    ],
    'delete_form' => [
        'disclaimer' => 'Deleting {subscriber}\'s subscription will remove all analytics data associated with it.',
        'understand' => 'I understand, remove the subscription permanently',
        'submit' => 'Remove subscription',
    ],
    'messages' => [
        'addSuccess' => 'New subscription added! A welcome email was sent to {subscriber}.',
        'addError' => 'Subscription could not be added.',
        'editSuccess' => 'Subscription expiry date was updated! An email was sent to {subscriber}.',
        'editError' => 'Subscription could not be edited.',
        'regenerateTokenSuccess' => 'Token regenerated! An email was sent to {subscriber} with the new token.',
        'regenerateTokenError' => 'Token could not be regenerated.',
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
        'token' => 'Your token: {0}',
        'unique_feed_link' => 'Your unique feed link: {0}',
        'how_to_use' => 'How to use?',
        'two_ways' => 'You have two ways of unlocking the premium episodes:',
        'import_into_app' => 'Copy your unique feed url inside your favourite podcast app (import it as a private feed to prevent exposing your credentials).',
        'go_to_website' => 'Go to {podcastWebsite}\'s website and unlock the podcast with your token.',
        'welcome_subject' => 'Welcome to {podcastTitle}',
        'welcome' => 'You have subscribed to {podcastTitle}, thank you and welcome aboard!',
        'welcome_token_title' => 'Here are your credentials to unlock the podcast\'s premium episodes:',
        'welcome_expires' => 'Your subscription was set to expire on {0}.',
        'welcome_never_expires' => 'Your subscription was set to never expire.',
        'reset_subject' => 'Your token was reset!',
        'reset_token' => 'Your access to {podcastTitle} has been reset!',
        'reset_token_title' => 'New credentials have been generated for you to unlock the podcast\'s premium episodes:',
        'edited_subject' => 'Your subscription has been updated!',
        'edited_expires' => 'Your subscription for {podcastTitle} was set to expire on {expiresAt}.',
        'edited_never_expires' => 'Your subscription for {podcastTitle} was set to never expire!',
        'suspended_subject' => 'Your subscription has been suspended!',
        'suspended' => 'Your subscription for {podcastTitle} has been suspended! You can no longer access the podcast\'s premium episodes.',
        'suspended_reason' => 'That is for the following reason: {0}',
        'resumed_subject' => 'Your subscription has been resumed!',
        'resumed' => 'Your subscription for {podcastTitle} has been resumed! You may access the podcast\'s premium episodes again.',
        'deleted_subject' => 'Your subscription has been removed!',
        'deleted' => 'Your subscription for {podcastTitle} has been removed! You no longer have access to the podcast\'s premium episodes.',
        'footer' => '{castopod} hosted on {host}',
    ],
];
