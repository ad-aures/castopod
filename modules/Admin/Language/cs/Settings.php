<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Obecné nastavení',
    'instance' => [
        'title' => 'Instalační soubor',
        'site_icon' => 'Ikona stránky',
        'site_icon_delete' => 'Odstranit ikonu stránky',
        'site_icon_hint' => 'Ikony stránky jsou to, co vidíte na kartách prohlížeče, v panelu záložek, a když přidáte webové stránky jako zkratku na mobilních zařízeních.',
        'site_icon_helper' => 'Ikona musí být čtvercová a alespoň 512px široká a vysoká.',
        'site_name' => 'Název stránky',
        'site_description' => 'Popis stránky',
        'submit' => 'Uložit',
        'editSuccess' => 'Instance byla úspěšně aktualizována!',
        'deleteIconSuccess' => 'Ikona stránek byla úspěšně odstraněna!',
    ],
    'images' => [
        'title' => 'Obrázky',
        'subtitle' => 'Zde můžete obnovit všechny obrázky na základě originálů, které byly nahrány. Použije se, pokud zjistíte, že některé obrázky chybí. Tato úloha může chvíli trvat.',
        'regenerate' => 'Obnovit obrázky',
        'regenerationSuccess' => 'Všechny obrázky byly úspěšně obnoveny!',
    ],
    'housekeeping' => [
        'title' => 'Úklid',
        'subtitle' => 'Spustí různé úklidové úkoly. Použijte tuto funkci, pokud někdy narazíte na problémy s mediálními soubory nebo integritou dat. Tyto úkoly mohou chvíli trvat.',
        'reset_counts' => 'Vynulovat počítadla',
        'reset_counts_helper' => 'Tato možnost přepočítá a resetuje všechny počty dat (počet sledovatelů, příspěvků, komentářů, …).',
        'rewrite_media' => 'Přepsat metadata médií',
        'rewrite_media_helper' => 'Tato možnost odstraní všechny nadbytečné mediální soubory a znovu je obnoví (obrázky, zvukové soubory, přepisy, kapitoly, …)',
        'rename_episodes_files' => 'Přejmenovat zvukové soubory epizody',
        'rename_episodes_files_hint' => 'Tato možnost přejmenuje všechny epizody zvukových souborů na náhodný řetězec znaků. Toto použijte pro opětovné skrytí, pokud uniklo URL jedné z vašich soukromých epizod.',
        'clear_cache' => 'Vymazat všechny mezipaměti',
        'clear_cache_helper' => 'Tato volba bude vyčistí redis mezipaměť nebo zapisovatelné soubory.',
        'run' => 'Spustit úklid',
        'runSuccess' => 'Úklid byl úspěšný!',
    ],
    'theme' => [
        'title' => 'Motiv',
        'accent_section_title' => 'Barevný tón',
        'accent_section_subtitle' => 'Vyberte barvu pro vzhled a dojem všech veřejných stránek',
        'pine' => 'Borovice',
        'crimson' => 'Purpurový',
        'amber' => 'Jantarový',
        'lake' => 'Jezero',
        'jacaranda' => 'Jacaranda',
        'onyx' => 'Onyx ',
        'submit' => 'Uložit',
        'setInstanceThemeSuccess' => 'Šablona byla úspěšně aktualizována!',
    ],
];
