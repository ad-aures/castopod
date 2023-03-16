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
        'submit_add' => 'Dodaj subskrypcję',
        'submit_edit' => 'Edytuj subskrypcję',
    ],
    'form_link_add' => [
        'link' => 'Link do strony subskrypcji',
        'link_hint' => 'Spowoduje to dodanie przycisku w witrynie zapraszając słuchaczy do subskrypcji podcastu.',
        'submit' => 'Zapisz link',
    ],
    'suspend_form' => [
        'disclaimer' => 'Zawieszenie subskrypcji ograniczy abonentowi dostęp do treści premium. Wciąż będziesz mógł później usunąć zawieszenie.',
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
        'addError' => 'Subskrypcja nie może zostać dodana.',
        'editSuccess' => 'Data wygaśnięcia subskrypcji została zaktualizowana! Wiadomość e-mail została wysłana do {subscriber}.',
        'editError' => 'Subskrypcja nie może być edytowana.',
        'regenerateTokenSuccess' => 'Token został odnowiony! Wiadomość e-mail została wysłana do {subscriber} z nowym tokenem.',
        'regenerateTokenError' => 'Token nie mógł zostać odnowiony.',
        'deleteSuccess' => 'Subskrypcja została usunięta! Wiadomość e-mail została wysłana do {subscriber}.',
        'deleteError' => 'Twoja subskrypcja nie mogła zostać anulowana.',
        'suspendSuccess' => 'Subskrypcja została zawieszona! Wiadomość e-mail została wysłana do {subscriber}.',
        'suspendError' => 'Twoja subskrypcja nie mogła zostać anulowana.',
        'resumeSuccess' => 'Subskrypcja została usunięta! Wiadomość e-mail została wysłana do {subscriber}.',
        'resumeError' => 'Subskrypcja nie może być wznowiona.',
        'linkSaveSuccess' => 'Link do subskrypcji został pomyślnie zapisany! Pojawi się na stronie internetowej jako wywołanie Akcji!',
        'linkRemoveSuccess' => 'Link do subskrypcji został pomyślnie usunięty!',
    ],
    'emails' => [
        'greeting' => 'Cześć,',
        'token' => 'Twój token: {0}',
        'unique_feed_link' => 'Twój unikalny link do kanału: {0}',
        'how_to_use' => 'Jak używać?',
        'two_ways' => 'Masz dwa sposoby odblokowania odcinków premium:',
        'import_into_app' => 'Skopiuj swój unikalny adres Url kanału w swojej ulubionej aplikacji podcastowej (zaimportuj go jako prywatny kanał, aby zapobiec ujawnianiu Twoich poświadczeń).',
        'go_to_website' => 'Przejdź do strony {podcastWebsite} i odblokuj podcast za pomocą swojego tokenu.',
        'welcome_subject' => 'Witaj w {podcastTitle}',
        'welcome' => 'Zasubskrybowałeś {podcastTitle}, dziękuję i witam serdecznie!',
        'welcome_token_title' => 'Oto twoje dane, aby odblokować odcinki premium podcastu:',
        'welcome_expires' => 'Twoja subskrypcja wygaśnie w dniu {0}.',
        'welcome_never_expires' => 'Twoja subskrypcja nigdy nie wygasa.',
        'reset_subject' => 'Twój token został zresetowany!',
        'reset_token' => 'Twój dostęp do {podcastTitle} został zresetowany!',
        'reset_token_title' => 'Nowe dane logowania zostały wygenerowane, aby odblokować odcinki premium podcastu:',
        'edited_subject' => 'Subskrypcja została aktywowana!',
        'edited_expires' => 'Twoja subskrypcja dla {podcastTitle} wygasa w dniu {expiresAt}.',
        'edited_never_expires' => 'Twoja subskrypcja dla {podcastTitle} nigdy nie wygasa!',
        'suspended_subject' => 'Twoja subskrypcja została zawieszona!',
        'suspended' => 'Twoja subskrypcja dla {podcastTitle} została zawieszona! Nie możesz już uzyskać dostępu do odcinków premium podcastu.',
        'suspended_reason' => 'Z następującego powodu: {0}',
        'resumed_subject' => 'Twoja subskrypcja została przywrócona!',
        'resumed' => 'Twoja subskrypcja dla {podcastTitle} została wznowiona! Masz ponownie dostęp do odcinków premium podcastu.',
        'deleted_subject' => 'Subskrypcja została usunięta!',
        'deleted' => 'Twoja subskrypcja dla {podcastTitle} została usunięta! Nie masz już dostępu do odcinków premium podcastu.',
        'footer' => '{castopod} hostowany na {host}',
    ],
];
