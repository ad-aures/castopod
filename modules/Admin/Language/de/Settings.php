<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Allgemeine Einstellungen',
    'instance' => [
        'title' => 'Instanz',
        'site_icon' => 'Webseiten-Icon',
        'site_icon_delete' => 'Lösche Webseiten-Icon',
        'site_icon_hint' => 'Webseiten-Icons sind das, was Sie in Ihren Browser-Tabs, der Lesezeichenleiste und als Verknüpfung auf mobilen Geräten sehen.',
        'site_icon_helper' => 'Das Icon muss quadratisch und mindestens 512px breit und hoch sein.',
        'site_name' => 'Seitenname',
        'site_description' => 'Seitenbeschreibung',
        'submit' => 'Speichern',
        'editSuccess' => 'Die Instanz wurde erfolgreich aktualisiert!',
        'deleteIconSuccess' => 'Das Seiten-Icon wurde erfolgreich entfernt!',
    ],
    'images' => [
        'title' => 'Bilder',
        'subtitle' => 'Hier können Sie alle Bilder auf Basis der hochgeladenen Originale neu erzeugen, wenn Sie feststellen, dass einige Bilder fehlen. Diese Aufgabe kann eine Weile dauern.',
        'regenerate' => 'Bilder neu erzeugen',
        'regenerationSuccess' => 'Alle Bilder wurden erfolgreich neu erzeugt!',
    ],
    'housekeeping' => [
        'title' => 'Systempflege',
        'subtitle' => 'Führt verschiedene Aufgaben zur Systempflege aus. Benutzen Sie diese Funktion, falls Sie jemals Probleme mit Mediendateien oder Datenintegrität haben. Diese Aufgaben können eine Weile dauern.',
        'reset_counts' => 'Zähler zurücksetzen',
        'reset_counts_helper' => 'Diese Option wird alle Datenzähler neu berechnen und zurücksetzen (Anzahl der Follower, Beiträge, Kommentare, …).',
        'rewrite_media' => 'Medien-Metadaten neu schreiben',
        'rewrite_media_helper' => 'Diese Option wird alle überflüssigen Mediendateien löschen und neu erstellen (Bilder, Audiodateien, Transkripte, Kapitel …)',
        'rename_episodes_files' => 'Audiodateien der Episode umbenennen',
        'rename_episodes_files_hint' => 'Diese Option wird alle Audiodateien der Episode mit einer zufälligen Zeichenkette umbenennen. Benutzen Sie diese Option, wenn einer Ihrer privaten Episoden-Links durchsickert, da diese dadurch versteckt werden.',
        'clear_cache' => 'Alle Caches löschen',
        'clear_cache_helper' => 'Diese Option leert den redis-Cache oder beschreibbare/Cache-Dateien.',
        'run' => 'Systempflege starten',
        'runSuccess' => 'Die Systempflege wurde erfolgreich durchgeführt!',
    ],
    'theme' => [
        'title' => 'Theme',
        'accent_section_title' => 'Akzentfarbe',
        'accent_section_subtitle' => 'Wähle eine Farbe, um das Erscheinungsbild aller öffentlichen Seiten festzulegen.',
        'pine' => 'Kiefer',
        'crimson' => 'Purpur',
        'amber' => 'Bernstein',
        'lake' => 'Karmesinrot',
        'jacaranda' => 'Palisander',
        'onyx' => 'Onyx',
        'submit' => 'Speichern',
        'setInstanceThemeSuccess' => 'Design wurde erfolgreich aktualisiert!',
    ],
];
