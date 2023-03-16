<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Videoclips',
        'status' => [
            'label' => 'Status',
            'queued' => 'wartend',
            'queued_hint' => 'Der Clip wartet auf die Verarbeitung.',
            'pending' => 'ausstehend',
            'pending_hint' => 'Clip wird in Kürze generiert.',
            'running' => 'läuft',
            'running_hint' => 'Clip wird generiert.',
            'failed' => 'fehlgeschlagen',
            'failed_hint' => 'Clip konnte nicht generiert werden: Skriptfehler.',
            'passed' => 'bestanden',
            'passed_hint' => 'Clip wurde erfolgreich erstellt!',
        ],
        'clip' => 'Clip',
        'duration' => 'Laufzeit',
    ],
    'title' => 'Video-Clip: {videoClipLabel}',
    'download_clip' => 'Clip herunterladen',
    'create' => 'Neuer Videoclip',
    'go_to_page' => 'Zur Clip-Seite gehen',
    'retry' => 'Clip-Generierung wiederholen',
    'delete' => 'Clip löschen',
    'logs' => 'Jobprotokoll',
    'messages' => [
        'alreadyExistingError' => 'Der Videoclip, den Sie zu erstellen versuchen, existiert bereits!',
        'addToQueueSuccess' => 'Videoclip wurde zur Warteschlange hinzugefügt und wartet darauf, erstellt zu werden!',
        'deleteSuccess' => 'Verlauf wurde erfolgreich gelöscht!',
    ],
    'format' => [
        'landscape' => 'Querformat',
        'portrait' => 'Hochkant',
        'squared' => 'Quadratisch',
    ],
    'form' => [
        'title' => 'Neuer Videoclip',
        'params_section_title' => 'Videoclip-Parameter',
        'clip_title' => 'Clip-Titel',
        'format' => [
            'label' => 'Wähle ein Format',
            'landscape_hint' => 'Mit einem 16:9 Verhältnis sind Querformat Videos ideal für PeerTube, Youtube und Vimeo.',
            'portrait_hint' => 'Mit einem 9:16 Verhältnis sind Porträt-Videos ideal für TikTok, Youtube-Shorts und Instagram-Stories.',
            'squared_hint' => 'Mit einem 1:1-Verhältnis sind quadratische Videos ideal für Mastodon, Facebook, Twitter und LinkedIn.',
        ],
        'theme' => 'Wähle ein Design',
        'start_time' => 'Beginne bei',
        'duration' => 'Laufzeit',
        'trim_start' => 'Startpunkt',
        'trim_end' => 'Ende trimmen',
        'submit' => 'Neuen Clip erstellen',
    ],
    'requirements' => [
        'title' => 'Fehlende Anforderungen',
        'missing' => 'Du hast fehlende Anforderungen. Achte darauf, alle erforderlichen Elemente hinzuzufügen, um ein Video für diese Episode erstellen zu können!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'Freetype-Bibliothek für GD',
        'transcript' => 'Transkript-Datei (.srt)',
    ],
];
