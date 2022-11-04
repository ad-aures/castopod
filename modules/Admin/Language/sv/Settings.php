<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Allmänna inställningar',
    'instance' => [
        'title' => 'Instans',
        'site_icon' => 'Ikon för webbplats',
        'site_icon_delete' => 'Ta bort webbplatsikonen',
        'site_icon_hint' => 'Webbplatsikoner är vad du ser på dina webbläsarflikar, bokmärkesfältet och när du lägger till en webbplats som en genväg på mobila enheter.',
        'site_icon_helper' => 'Ikonen måste vara kvadratisk och minst 512px bred och hög.',
        'site_name' => 'Webbplatsens namn',
        'site_description' => 'Webbplatsbeskrivning',
        'submit' => 'Spara',
        'editSuccess' => 'Instansen har uppdaterats!',
        'deleteIconSuccess' => 'Webbplatsikonen har tagits bort!',
    ],
    'images' => [
        'title' => 'Bilder',
        'subtitle' => 'Här kan du regenerera alla bilder baserat på originalen som laddats upp. Att användas om du upptäcker att vissa bilder saknas. Denna uppgift kan ta ett tag.',
        'regenerate' => 'Regenerera bilder',
        'regenerationSuccess' => 'Alla bilder har återskapats framgångsrikt!',
    ],
    'housekeeping' => [
        'title' => 'Städning',
        'subtitle' => 'Kör olika städuppgifter. Använd denna funktion om du någonsin stöter på problem med mediefiler eller dataintegritet. Dessa uppgifter kan ta ett tag.',
        'reset_counts' => 'Återställ räknare',
        'reset_counts_helper' => 'Detta alternativ kommer att räkna om och återställa alla data räknas (antal följare, inlägg, kommentarer, …).',
        'rewrite_media' => 'Skriv om media metadata',
        'rewrite_media_helper' => 'Detta alternativ kommer att ta bort alla överflödiga mediefiler och återskapa dem (bilder, ljudfiler, avskrifter, kapitel, …)',
        'rename_episodes_files' => 'Döp om avsnittets ljudfiler',
        'rename_episodes_files_hint' => 'Detta alternativ kommer att byta namn på alla avsnitt ljudfiler till en slumpmässig sträng av tecken. Använd detta om en av dina privata episoder länk läckte eftersom detta effektivt kommer att dölja det.',
        'clear_cache' => 'Rensa all cache',
        'clear_cache_helper' => 'Det här alternativet kommer att radera redis cache eller skrivbara/cache-filer.',
        'run' => 'Kör städning',
        'runSuccess' => 'Städning har körts framgångsrikt!',
    ],
    'theme' => [
        'title' => 'Tema',
        'accent_section_title' => 'Accentfärg',
        'accent_section_subtitle' => 'Välj färg för att bestämma utseendet och känslan på alla offentliga sidor.',
        'pine' => 'Tall',
        'crimson' => 'Karmosinröd',
        'amber' => 'Bärnsten',
        'lake' => 'Sjö',
        'jacaranda' => 'Jacaranda',
        'onyx' => 'Onyx',
        'submit' => 'Spara',
        'setInstanceThemeSuccess' => 'Temat har uppdaterats!',
    ],
];
