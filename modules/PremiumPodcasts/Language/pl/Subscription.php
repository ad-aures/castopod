<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Subskrypcje podcastu',
    'add' => 'Nowa subskrypcja',
    'view' => 'Wyświetl subskrypcję',
    'edit' => 'Edytuj subskrypcję',
    'regenerate_token' => 'Wygeneruj nowy token',
    'suspend' => 'Wstrzymaj subskrypcję',
    'resume' => 'Wznów subskrypcję',
    'delete' => 'Usuń subskrypcję',
    'status' => [
        'active' => 'Aktywne',
        'suspended' => 'Zawieszony',
        'expired' => 'Wygasły',
    ],
    'list' => [
        'number' => 'Numer',
        'email' => 'Email',
        'expiration_date' => 'Data ważności',
        'unlimited' => 'Nielimitowany',
        'downloads' => 'Pobrane',
        'status' => 'Status',
    ],
    'form' => [
        'email' => 'Email',
        'expiration_date' => 'Data ważności',
        'expiration_date_hint' => 'Data i godzina wygaśnięcia subskrypcji. Pozostaw puste dla nieograniczonej subskrypcji.',
        'submit_create' => 'Utwórz subskrypcję',
        'submit_edit' => 'Edytuj subskrypcję',
    ],
    'form_link_add' => [
        'link' => 'Link do strony subskrypcji',
        'link_hint' => 'Spowoduje to dodanie przycisku zapraszającego słuchaczy do subskrypcji podcastu.',
        'submit' => 'Zapisz link',
    ],
    'suspend_form' => [
        'disclaimer' => 'Zawieszenie subskrypcji ograniczy subskrybentowi dostęp do treści premium. Wciąż będziesz mógł później cofnąć zawieszenie.',
        'reason' => 'Powód',
        'reason_placeholder' => 'Dlaczego zawieszasz subskrypcję?',
        "submit" => 'Wstrzymaj subskrypcję',
    ],
    'delete_form' => [
        'disclaimer' => 'Usunięcie subskrypcji {subscriber} spowoduje usunięcie wszystkich danych analitycznych z nią związanych.',
        'understand' => 'Rozumiem, usuń subskrypcję na stałe',
        'submit' => 'Usuń subskrypcję',
    ],
    'messages' => [
        'addSuccess' => 'Dodano nową subskrypcję! Wiadomość powitalna została wysłana na adres {subscriber}.',
        'addError' => 'Subskrypcja nie mogła zostać dodana.',
        'editSuccess' => 'Data wygaśnięcia subskrypcji została zaktualizowana! Wiadomość e-mail została wysłana do {subscriber}.',
        'editError' => 'Subskrypcja nie mogła być edytowana.',
        'regenerateTokenSuccess' => 'Token został zresetowany! Wiadomość e-mail została wysłana do {subscriber} z nowym tokenem.',
        'regenerateTokenError' => 'Token nie mógł zostać zresetowany.',
        'deleteSuccess' => 'Subskrypcja została usunięta! Wiadomość e-mail została wysłana do {subscriber}.',
        'deleteError' => 'Subskrypcja nie mogła zostać usunięta.',
        'suspendSuccess' => 'Subskrypcja została zawieszona! Wiadomość e-mail została wysłana do {subscriber}.',
        'suspendError' => 'Subskrypcja nie mogła zostać zawieszona.',
        'resumeSuccess' => 'Subskrypcja została wznowiona! Wiadomość e-mail została wysłana do {subscriber}.',
        'resumeError' => 'Subskrypcja nie mogła zostać wznowiona.',
        'linkSaveSuccess' => 'Link do subskrypcji został pomyślnie zapisany! Pojawi się na stronie internetowej jako Call To Action!',
        'linkRemoveSuccess' => 'Link do subskrypcji został pomyślnie usunięty!',
    ],
    'emails' => [
        'greeting' => 'Cześć,',
        'token' => 'Twój token: {0}',
        'unique_feed_link' => 'Twój unikalny link do kanału: {0}',
        'how_to_use' => 'Jak używać?',
        'two_ways' => 'Masz dwa sposoby odblokowania odcinków premium:',
        'import_into_app' => 'Wklej swój unikalny adres URL kanału do swojej ulubionej aplikacji podcastowej (zaimportuj go jako prywatny kanał, aby zapobiec ujawnianiu Twoich tokenów).',
        'go_to_website' => 'Przejdź do strony {podcastWebsite} i odblokuj podcast za pomocą swojego tokenu.',
        'welcome_subject' => 'Witaj w {podcastTitle}',
        'welcome' => 'Zasubskrybowano {podcastTitle}, dziękuję i witam na pokładzie!',
        'welcome_token_title' => 'Oto twoje dane, aby odblokować odcinki premium podcastu:',
        'welcome_expires' => 'Twoja subskrypcja wygaśnie w dniu {0}.',
        'welcome_never_expires' => 'Twoja subskrypcja nigdy nie wygasa.',
        'reset_subject' => 'Twój token został zresetowany!',
        'reset_token' => 'Twój dostęp do {podcastTitle} został zresetowany!',
        'reset_token_title' => 'Wygenerowano nowe dane dostępowe do odblokowania odcinków premium podcastu:',
        'edited_subject' => 'Subskrypcja została zaktualizowana!',
        'edited_expires' => 'Twoja subskrypcja dla {podcastTitle} wygaśnie w dniu {expiresAt}.',
        'edited_never_expires' => 'Twoja subskrypcja dla {podcastTitle} nigdy nie wygaśnie!',
        'suspended_subject' => 'Twoja subskrypcja została zawieszona!',
        'suspended' => 'Twoja subskrypcja dla {podcastTitle} została zawieszona! Nie masz już dostępu do odcinków premium podcastu.',
        'suspended_reason' => 'Z następującego powodu: {0}',
        'resumed_subject' => 'Twoja subskrypcja została wznowiona!',
        'resumed' => 'Twoja subskrypcja dla {podcastTitle} została wznowiona! Masz ponownie dostęp do odcinków premium podcastu.',
        'deleted_subject' => 'Twoja subskrypcja została usunięta!',
        'deleted' => 'Twoja subskrypcja dla {podcastTitle} została usunięta! Nie masz już dostępu do odcinków premium podcastu.',
        'footer' => '{castopod} hostowane na {host}',
    ],
];
