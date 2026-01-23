<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Odběry podcastu',
    'add' => 'Nový odběr',
    'view' => 'Zobrazit odběry',
    'edit' => 'Upravit odebírání',
    'regenerate_token' => 'Znovu vygenerovat token',
    'suspend' => 'Pozastavit odběr',
    'resume' => 'Pokračovat v odběru',
    'delete' => 'Smazat odběr',
    'status' => [
        'active' => 'Aktivní',
        'suspended' => 'Pozastaveno',
        'expired' => 'Vypršeno',
    ],
    'list' => [
        'number' => 'Číslo',
        'email' => 'E-mail',
        'expiration_date' => 'Datum vypršení',
        'unlimited' => 'Neomezené',
        'downloads' => 'Stažení',
        'status' => 'Stav',
    ],
    'form' => [
        'email' => 'E-mail',
        'expiration_date' => 'Datum vypršení',
        'expiration_date_hint' => 'Datum a čas, kdy vyprší odběr. Ponechte prázdné pro neomezený odběr.',
        'submit_create' => 'Vytvořit odběr',
        'submit_edit' => 'Upravit odebírání',
    ],
    'form_link_add' => [
        'link' => 'Odkaz na stránku odběru',
        'link_hint' => 'Tímto přidáte výzvu k akci na webových stránkách, které vyzývají posluchače k odběru podcastu.',
        'submit' => 'Uložit odkaz',
    ],
    'suspend_form' => [
        'disclaimer' => 'Pozastavení odběru omezí přístup k prémiovému obsahu. Později budete moci pozastavení zrušit.',
        'reason' => 'Důvod',
        'reason_placeholder' => 'Proč pozastavujete odběr?',
        "submit" => 'Pozastavit odběr',
    ],
    'delete_form' => [
        'disclaimer' => 'Smazáním odběru {subscriber} odstraníte všechna analytická data, která jsou s ním spojena.',
        'understand' => 'Chápu, trvale odebrat odběr',
        'submit' => 'Odebrat odběr',
    ],
    'messages' => [
        'addSuccess' => 'Nový odběr přidán! Uvítací e-mail byl odeslán {subscriber}.',
        'addError' => 'Odběr nelze přidat.',
        'editSuccess' => 'Datum vypršení platnosti odběru bylo aktualizováno! E-mail byl odeslán {subscriber}.',
        'editError' => 'Odběr se nepodařilo smazat.',
        'regenerateTokenSuccess' => 'Token vygenerován! {subscriber} byl odeslán e-mail s novým tokenem.',
        'regenerateTokenError' => 'Token nelze obnovit.',
        'deleteSuccess' => 'Odběr byl odstraněn! {subscriber} byl odeslán e-mail .',
        'deleteError' => 'Odběr nelze odstranit.',
        'suspendSuccess' => 'Odběr byl pozastaven! E-mail byl odeslán {subscriber}.',
        'suspendError' => 'Odběr nemohl být pozastaven.',
        'resumeSuccess' => 'Odběr byl obnoven! E-mail byl odeslán {subscriber}.',
        'resumeError' => 'Odběr nelze obnovit.',
        'linkSaveSuccess' => 'Odkaz na odběr byl úspěšně uložen! Zobrazí se na webové stránce jako výzva k akci!',
        'linkRemoveSuccess' => 'Odkaz na odběr byl úspěšně odstraněn!',
    ],
    'emails' => [
        'greeting' => 'Ahoj,',
        'token' => 'Váš token: {0}',
        'unique_feed_link' => 'Váš unikátní odkaz na kanál: {0}',
        'how_to_use' => 'Návod k použití',
        'two_ways' => 'Máte dva způsoby, jak odemknout prémiové epizody:',
        'import_into_app' => 'Zkopírujte jedinečnou URL kanálu do vaší oblíbené podcast aplikace (importujte jej jako soukromý kanál, abyste zabránili odhalení vašich údajů).',
        'go_to_website' => 'Přejděte na web {podcastWebsite} a odemkněte podcast pomocí Vašeho tokenu.',
        'welcome_subject' => 'Vítejte v {podcastTitle}',
        'welcome' => 'Přihlásili jste k odběru {podcastTitle}, děkujeme a vítejte na palubě!',
        'welcome_token_title' => 'Zde jsou vaše přihlašovací údaje pro odemknutí prémiových epizod:',
        'welcome_expires' => 'Váš odběr byl nastaven na platnost do {0}.',
        'welcome_never_expires' => 'Váš odběr byl nastaven tak, že nikdy nevyprší.',
        'reset_subject' => 'Váš token byl obnoven!',
        'reset_token' => 'Váš přístup k {podcastTitle} byl obnoven!',
        'reset_token_title' => 'Nové přihlašovací údaje byly vygenerovány pro odemknutí prémiových epizod podcastu:',
        'edited_subject' => 'Váš odběr byl aktualizován!',
        'edited_expires' => 'Váš odběr {podcastTitle} byl nastaven na platnost {expiresAt}.',
        'edited_never_expires' => 'Váš odběr {podcastTitle} byl nastaven tak, aby nikdy neskončil!',
        'suspended_subject' => 'Váš odběr byl pozastaven!',
        'suspended' => 'Váš odběr {podcastTitle} byl pozastaven! Již nemůžete přistupovat k prémiovým epizodám podcastu.',
        'suspended_reason' => 'To je z následujícího důvodu: {0}',
        'resumed_subject' => 'Váš odběr byl obnoven!',
        'resumed' => 'Váš odběr {podcastTitle} byl obnoven! Můžete znovu přistupovat k prémiovým epizodám podcastu.',
        'deleted_subject' => 'Váš odběr byl odstraněn!',
        'deleted' => 'Váš odběr {podcastTitle} byl odebrán! Již nemáte přístup k prémiovým epizodám podcastu.',
        'footer' => '{castopod} je hostován na {host}',
    ],
];
