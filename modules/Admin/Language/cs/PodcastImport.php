<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'warning' =>
        'Tento postup může trvat dlouho. Vzhledem k tomu, že aktuální verze nezobrazuje žádný pokrok při spuštění, neuvidíte nic aktualizovaného, dokud nebude hotovo. V případě chyby timeoutu, zvýšte hodnotu `max_execution_time`.',
    'old_podcast_section_title' => 'Podcast k importu',
    'old_podcast_section_subtitle' =>
        'Ujistěte se, že vlastníte práva pro tento podcast před jeho importem. Kopírování a vysílání bez řádných práv je pirátství a podléhá stíhání.',
    'imported_feed_url' => 'URL kanálu',
    'imported_feed_url_hint' => 'Zdroj musí být ve formátu XML nebo RSS.',
    'new_podcast_section_title' => 'Nový podcast',
    'advanced_params_section_title' => 'Pokročilá nastavení',
    'advanced_params_section_subtitle' =>
        'Ponechte výchozí hodnoty, pokud nemáte žádnou představu o tom, k čemu jsou tato pole určena.',
    'slug_field' => 'Pole pro výpočet URL adresy epizody',
    'description_field' =>
        'Zdrojové pole použité pro popis epizody / zobrazení poznámek',
    'force_renumber' => 'Vynutit přečíslování epizod',
    'force_renumber_hint' =>
        'Toto použijte, pokud váš podcast nemá čísla epizody, ale přeje si je nastavit během importu.',
    'season_number' => 'Číslo série',
    'season_number_hint' =>
        'Toto použijte, pokud váš podcast nemá číslo série, ale chce jej nastavit během importu. V opačném případě ponechte prázdné.',
    'max_episodes' => 'Maximální počet epizod k importu',
    'max_episodes_hint' => 'Nechte prázdné pro import všech epizod',
    'lock_import' =>
        'Tento kanál je chráněn. Nemůžete jej importovat. Pokud jste vlastník, zrušte ochranu na zdrojové platformě.',
    'submit' => 'Importovat podcast',
];
