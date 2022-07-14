<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'warning' =>
        'This procedure may take a long time. As the current version does not show any progress while it runs, you will not see anything updated until it is done. In case of timeout error, increase `max_execution_time` value.',
    'old_podcast_section_title' => 'Der zu importierende Podcast',
    'old_podcast_section_subtitle' =>
        'Stellen Sie sicher, dass Sie die Rechte für diesen Podcast besitzen, bevor Sie ihn importieren. Vervielfältigung und Ausstrahlung eines Podcasts ohne die entsprechenden Rechte sind Piraterie und strafbar.',
    'imported_feed_url' => 'Feed-URL',
    'imported_feed_url_hint' => 'Der Feed muss im xml oder RSS-Format sein.',
    'new_podcast_section_title' => 'Der neue Podcast',
    'advanced_params_section_title' => 'Erweiterte Parameter',
    'advanced_params_section_subtitle' =>
        'Behalten Sie die Standardwerte, wenn Sie keine Ahnung haben, wofür die Felder sind.',
    'slug_field' => 'Feld zum Berechnen der Episoden-URL (epiode slug)',
    'description_field' =>
        'Quellfeld für Episodenbeschreibung verwendet / Notizen anzeigen',
    'force_renumber' => 'Erzwinge Neu-Nummerierung der Folgen',
    'force_renumber_hint' =>
        'Verwende dies, wenn dein Podcast keine Episodennummern hat, aber du diese während des Imports setzen möchtest.',
    'season_number' => 'Staffelnummer',
    'season_number_hint' =>
        'Benutze dies, wenn dein Podcast keine Staffelnummer hat, aber du eine beim Import setzen möchtest. Lasse es andernfalls leer.',
    'max_episodes' => 'Maximale Anzahl der zu importierenden Episoden',
    'max_episodes_hint' => 'Leer lassen um alle Episoden zu importieren',
    'lock_import' =>
        'Dieser Feed ist geschützt. Du kannst ihn nicht importieren. Wenn du der Besitzer bist, entferne den Schutz auf der Ursprungsplattform.',
    'submit' => 'Podcast importieren',
];
