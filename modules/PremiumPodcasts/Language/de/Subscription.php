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
        'submit_create' => 'Abonnement einrichten',
        'submit_edit' => 'Abonnement bearbeiten',
    ],
    'form_link_add' => [
        'link' => 'Link zur Abonnement-Seite',
        'link_hint' => 'Dies fügt einen CTA (Call to Action) zur Webseite hinzu, der Hörer dazu einlädt, den Podcast zu abonnieren.',
        'submit' => 'Link speichern',
    ],
    'suspend_form' => [
        'disclaimer' => 'Das Pausieren des Abonnements wird dem Abonnenten den Zugang zu den Premium-Inhalten einschränken. Sie können die Pausierung jederzeit wieder aufheben.',
        'reason' => 'Grund',
        'reason_placeholder' => 'Warum unterbrechen Sie Ihr Abonnement?',
        "submit" => 'Abonnement unterbrechen',
    ],
    'delete_form' => [
        'disclaimer' => 'Durch das Löschen des Abonnements von {subscriber} werden alle damit verbundenen Analysedaten entfernt.',
        'understand' => 'Ich verstehe, entferne das Abonnement dauerhaft',
        'submit' => 'Abonnement entfernen',
    ],
    'messages' => [
        'addSuccess' => 'Neues Abonnement hinzugefügt! Eine Willkommens-E-Mail wurde an {subscriber} gesendet.',
        'addError' => 'Abonnement konnte nicht hinzugefügt werden.',
        'editSuccess' => 'Das Ablaufdatum des Abonnements wurde aktualisiert! Es wurde eine E-Mail an {subscriber} gesendet.',
        'editError' => 'Abonnement konnte nicht bearbeitet werden.',
        'regenerateTokenSuccess' => 'Der Schlüssel wurde neu generiert! Eine E-Mail mit dem neuen Schlüssel wurde an {subscriber} gesendet.',
        'regenerateTokenError' => 'Schlüssel konnte nicht neu generiert werden.',
        'deleteSuccess' => 'Das Abonnement wurde entfernt! Es wurde eine E-Mail an {subscriber} gesendet.',
        'deleteError' => 'Abonnement konnte nicht entfernt werden.',
        'suspendSuccess' => 'Das Abonnement wurde pausiert! Es wurde eine E-Mail an {subscriber} gesendet.',
        'suspendError' => 'Abonnement konnte nicht pausiert werden.',
        'resumeSuccess' => 'Das Abonnement wurde fortgesetzt! Es wurde eine E-Mail an {subscriber} gesendet.',
        'resumeError' => 'Abonnement konnte nicht fortgesetzt werden.',
        'linkSaveSuccess' => 'Der Abonnement-Link wurde erfolgreich gespeichert! Dieser wird als CTA (Call to Action) auf der Webseite erscheinen!',
        'linkRemoveSuccess' => 'Der Abonnement-Link wurde erfolgreich entfernt!',
    ],
    'emails' => [
        'greeting' => 'Hey,',
        'token' => 'Ihr Token: {0}',
        'unique_feed_link' => 'Ihr eindeutiger Feed-Link: {0}',
        'how_to_use' => 'Wie nutzt man es?',
        'two_ways' => 'Sie haben zwei Möglichkeiten, die Premium-Episoden freizuschalten:',
        'import_into_app' => 'Kopieren Sie Ihre einmalige Feed-URL in Ihre Lieblings-Podcast-App (importieren sie diesen als privaten Feed, um Ihre Anmeldedaten geheim zu halten).',
        'go_to_website' => 'Gehen Sie zu der Webseite von {podcastWebsite} und entsperren Sie den Podcast mit Ihrem Schlüssel.',
        'welcome_subject' => 'Willkommen bei {podcastTitle}',
        'welcome' => 'Sie haben {podcastTitle} abonniert, vielen Dank und herzlich willkommen!',
        'welcome_token_title' => 'Hier sind Ihre Anmeldedaten, um die Premium-Episoden des Podcasts freizuschalten:',
        'welcome_expires' => 'Ihr Abonnement läuft am {0} ab.',
        'welcome_never_expires' => 'Ihr Abonnement läuft nicht ab.',
        'reset_subject' => 'Ihr Schlüssel wurde zurückgesetzt!',
        'reset_token' => 'Ihr Zugriff auf {podcastTitle} wurde zurückgesetzt!',
        'reset_token_title' => 'Es wurden neue Anmeldedaten generiert, um die Premium-Episoden des Podcasts freizuschalten:',
        'edited_subject' => 'Ihr Abonnement wurde aktualisiert!',
        'edited_expires' => 'Ihr Abonnement für {podcastTitle} läuft am {expiresAt} ab.',
        'edited_never_expires' => 'Ihr Abonnement für {podcastTitle} läuft nie ab!',
        'suspended_subject' => 'Ihr Abonnement wurde pausiert!',
        'suspended' => 'Ihr Abonnement für {podcastTitle} wurde pausiert! Sie können nun nicht mehr auf die Premium-Episoden des Podcasts zugreifen.',
        'suspended_reason' => 'Das ist aus dem folgenden Grund: {0}',
        'resumed_subject' => 'Ihr Abonnement wurde wieder aufgenommen!',
        'resumed' => 'Ihr Abonnement für {podcastTitle} wurde fortgesetzt! Sie können nun wieder auf die Premium-Episoden des Podcasts zugreifen.',
        'deleted_subject' => 'Ihr Abonnement wurde entfernt!',
        'deleted' => 'Ihr Abonnement für {podcastTitle} wurde entfernt! Sie können nun nicht mehr auf die Premium-Episoden des Podcasts zugreifen.',
        'footer' => '{castopod} betrieben auf {host}',
    ],
];
