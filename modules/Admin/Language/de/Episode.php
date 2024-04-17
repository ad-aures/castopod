<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Staffel {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Folge {episodeNumber}',
    'number_abbr' => 'F. {episodeNumber}',
    'season_episode' => 'Staffel {seasonNumber} Folge {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}F{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# Kommentar}
        other {# Kommentare}
    }',
    'all_podcast_episodes' => 'Alle Podcast-Episoden',
    'back_to_podcast' => 'Zurück zum Podcast',
    'edit' => 'Bearbeiten',
    'preview' => 'Vorschau',
    'publish' => 'Veröffentllichen',
    'publish_edit' => 'Veröffentlichung bearbeiten',
    'publish_date_edit' => 'Veröffentlichungsdatum bearbeiten',
    'unpublish' => 'Veröffentlichung zurücknehmen',
    'publish_error' => 'Folge ist bereits veröffentlicht.',
    'publish_edit_error' => 'Folge ist bereits veröffentlicht.',
    'publish_cancel_error' => 'Folge ist bereits veröffentlicht.',
    'publish_date_edit_error' => 'Die Folge wurde noch nicht veröffentlicht, Sie können das Veröffentlichungsdatum nicht bearbeiten.',
    'publish_date_edit_future_error' => 'Das Veröffentlichungsdatum der Folge kann nur auf ein vergangenes Datum gesetzt werden! Wenn Sie es neu planen möchten, heben Sie die Veröffentlichung zuerst auf.',
    'publish_date_edit_success' => 'Das Veröffentlichungsdatum der Folge wurde erfolgreich aktualisiert!',
    'unpublish_error' => 'Folge ist nicht veröffentlicht.',
    'delete' => 'Löschen',
    'go_to_page' => 'Gehe zu Seite',
    'create' => 'Folge hinzufügen',
    'publication_status' => [
        'published' => 'Veröffentlicht',
        'with_podcast' => 'Veröffentlicht',
        'scheduled' => 'Geplant',
        'not_published' => 'Nicht veröffentlicht',
    ],
    'with_podcast_hint' => 'Wird zeitgleich mit dem Podcast veröffentlicht',
    'list' => [
        'search' => [
            'placeholder' => 'Suche nach einer Episode',
            'clear' => 'Suche zurücksetzen',
            'submit' => 'Suche',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# Folge}
            other {# Folgen}
        }',
        'episode' => 'Folge',
        'visibility' => 'Sichtbarkeit',
        'downloads' => 'Downloads',
        'comments' => 'Kommentar',
        'actions' => 'Aktionen',
    ],
    'messages' => [
        'createSuccess' => 'Folge wurde erfolgreich erstellt!',
        'editSuccess' => 'Folge wurde erfolgreich aktualisiert!',
        'publishSuccess' => '{publication_status, select,
            published {Folge erfolgreich veröffentlicht!}
            scheduled {Veröffentlichung der Folge erfolgreich geplant!}
            with_podcast {Diese Folge wird zeitgleich mit dem Podcast veröffentlicht.}
            other {Diese Folge ist nicht veröffentlicht.}
        }',
        'publishCancelSuccess' => 'Veröffentlichung der Episode abgebrochen!',
        'unpublishBeforeDeleteTip' => 'Du musst die Episode zurückziehen, bevor du sie löschst.',
        'scheduleDateError' => 'Veröffentlichungsdatum muss gesetzt sein!',
        'deletePublishedEpisodeError' => 'Bitte ziehe die Episode zurück, bevor du sie löschst.',
        'deleteSuccess' => 'Folge erfolgreich gelöscht!',
        'deleteError' => 'Fehler beim Löschen der {type, select,
            transcript {Abschrift}
            chapters {Kapitel}
            image {Cover}
            audio {Audio}
            other {Medien}
        }-Datei dieser Episode.',
        'deleteFileError' => 'Fehler beim Löschen der {type, select,
            transcript {Abschrift}
            chapters {Kapitel}
            image {Cover}
            audio {Audio}
            other {Medien}
        }-Datei {file_key}. Sie können es manuell von der Festplatte entfernen.',
        'sameSlugError' => 'Eine Folge mit dem ausgewählten Slug existiert bereits.',
    ],
    'form' => [
        'file_size_error' =>
            'Die Dateigröße ist zu groß! Maximale Größe ist {0}. Erhöhe `memory_limit`, `upload_max_filesize` und `post_max_size` Werte in Deiner PHP-Konfigurationsdatei und starte dann den Webserver neu, um Deine Datei hochzuladen.',
        'audio_file' => 'Audiodatei',
        'audio_file_hint' => 'Wähle eine .mp3- oder .m4a-Audiodatei.',
        'info_section_title' => 'Episodeninfo',
        'cover' => 'Episoden-Cover',
        'cover_hint' =>
            'Wenn Du kein Cover festlegst, wird stattdessen das Podcast-Cover verwendet.',
        'cover_size_hint' => 'Das Cover muss quadratisch und mindestens 1400px breit und hoch sein.',
        'title' => 'Titel',
        'title_hint' =>
            'Nutze einen klaren und einprägsamen Episodennamen. Gib hier nicht die Episoden- oder Staffelnummern an.',
        'permalink' => 'Permalink',
        'season_number' => 'Staffel',
        'episode_number' => 'Folge',
        'type' => [
            'label' => 'Typ',
            'full' => 'Komplett',
            'full_hint' => 'Vollständiger Inhalt (die Episode)',
            'trailer' => 'Trailer',
            'trailer_hint' => 'Kurze bewerbende Inhalte, die eine Vorschau der aktuellen Sendung darstellen',
            'bonus' => 'Bonus',
            'bonus_hint' => 'Zusätzliche Inhalte für die Sendung (zum Beispiel hinter den Kulissen, Informationen oder Interviews mit dem Team) oder übergreifende Promotionsinhalte für eine andere Show',
        ],
        'premium_title' => 'Premium',
        'premium' => 'Diese Episode darf nur für Premium-Abonnenten zugänglich sein',
        'parental_advisory' => [
            'label' => 'Hinweis für Erziehungsberechtigte',
            'hint' => 'Enthält die Folge anstößige Inhalte?',
            'undefined' => 'undefiniert',
            'clean' => 'Sauber',
            'explicit' => 'Anstößig',
        ],
        'show_notes_section_title' => 'Notizen anzeigen',
        'show_notes_section_subtitle' =>
            'Bis zu 4000 Zeichen, sei klar und präzise. Die Shownotes helfen potentiellen Zuhörern beim Finden der Episode.',
        'description' => 'Beschreibung',
        'description_footer' => 'Beschreibungsfußzeile',
        'description_footer_hint' =>
            'Dieser Text wird am Ende jeder Episodenbeschreibung hinzugefügt, es ist ein guter Ort, um zum Beispiel Ihre sozialen Links einzufügen.',
        'additional_files_section_title' => 'Zusätzliche Dateien',
        'additional_files_section_subtitle' =>
            'Diese Dateien könnten von anderen Plattformen genutzt werden, um eine bessere Nutzererfahrung zu bieten. Weitere Informationen finden Sie unter {podcastNamespaceLink}.',
        'location_section_title' => 'Standort',
        'location_section_subtitle' => 'Über welchen Ort handelt diese Folge?',
        'location_name' => 'Standortname oder Adresse',
        'location_name_hint' => 'Dies kann ein realer oder fiktiver Ort sein',
        'transcript' => 'Transkript (Untertitel)',
        'transcript_hint' => 'Nur .srt oder .vtt sind erlaubt.',
        'transcript_download' => 'Transkript herunterladen',
        'transcript_file' => 'Transkriptdatei (.srt oder .vtt)',
        'transcript_remote_url' => 'Remote-URL für Transkript',
        'transcript_file_delete' => 'Transkriptionsdatei löschen',
        'chapters' => 'Kapitel',
        'chapters_hint' => 'Die Datei muss im JSON Chapters Format sein.',
        'chapters_download' => 'Kapitel herunterladen',
        'chapters_file' => 'Kapiteldatei',
        'chapters_remote_url' => 'Externe URL für Kapiteldatei',
        'chapters_file_delete' => 'Lösche Kapiteldatei',
        'advanced_section_title' => 'Erweiterte Einstellungen',
        'advanced_section_subtitle' =>
            'Wenn du RSS-Tags benötigst, die Castopod nicht behandelt, setze diese hier.',
        'custom_rss' => 'Eigene RSS-Tags für die Episode',
        'custom_rss_hint' => 'Dies wird innerhalb des ❬item❭ Tags eingefügt.',
        'block' => 'Episode soll vor öffentlichen Katalogen versteckt werden',
        'block_hint' =>
            'Die Episode zeigt oder versteckt den Status: Beim Einschalten dieser Option wird verhindert, dass die Episode in Apple Podcasts, Google Podcasts und alle Apps von Drittanbietern, die Inhalte aus diesen Verzeichnissen ziehen, erscheint. (Nicht garantiert)',
        'submit_create' => 'Folge erstellen',
        'submit_edit' => 'Folge speichern',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Zurück zum Folgen-Dashboard',
        'post' => 'Ankündigungsbeitrag',
        'post_hint' =>
            "Nachricht schreiben, um die Veröffentlichung der Folge anzukündigen. Die Nachricht wird an alle Follower im Fediversum übertragen und auf der Homepage des Podcasts vorgestellt.",
        'message_placeholder' => 'Nachricht schreiben...',
        'publication_date' => 'Veröffentlichungsdatum',
        'publication_method' => [
            'now' => 'Jetzt',
            'schedule' => 'Zeitplan',
            'with_podcast' => 'Zusammen mit dem Podcast veröffentlichen',
        ],
        'scheduled_publication_date' => 'Geplantes Veröffentlichungsdatum',
        'scheduled_publication_date_clear' => 'Veröffentlichungsdatum löschen',
        'scheduled_publication_date_hint' =>
            'Du kannst die Veröffentlichung der Episode planen, indem du ein zukünftiges Veröffentlichungsdatum festlegst. Dieses Feld muss als YYYY-MM-TT HH:mm formatiert werden',
        'submit' => 'Veröffentllichen',
        'submit_edit' => 'Veröffentlichung bearbeiten',
        'cancel_publication' => 'Veröffentlichung abbrechen',
        'message_warning' => 'Du hast keine Nachricht für deinen Ankündigungsbeitrag geschrieben!',
        'message_warning_hint' => 'Eine Nachricht zu haben erhöht das soziale Engagement, was zu einer besseren Sichtbarkeit für Ihre Episode führt.',
        'message_warning_submit' => 'Trotzdem veröffentlichen',
    ],
    'publish_date_edit_form' => [
        'new_publication_date' => 'Neues Veröffentlichungsdatum',
        'new_publication_date_hint' => 'Muss auf ein vergangenes Datum gesetzt werden.',
        'submit' => 'Veröffentlichungsdatum bearbeiten',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Das Zurückziehen dieser Episode löscht alle damit verbundenen Kommentare und Beiträge und entferne sie aus dem RSS-Feed des Podcasts.",
        'understand' => 'Ich verstehe, ich möchte die Episode zurückziehen',
        'submit' => 'Zurückziehen',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Das Löschen der Episode wird auch alle verknüpften Mediendateien, Kommentare, Videoclips und Soundbites löschen.",
        'understand' => 'Ich verstehe, ich möchte die Folge löschen',
        'submit' => 'Löschen',
    ],
    'embed' => [
        'title' => 'Einbettbarer Spieler',
        'label' =>
            'Wähle eine Erscheinungsbild-Farbe, kopiere den einbettbaren Spieler in die Zwischenablage und füge ihn dann in die Webseite ein.',
        'clipboard_iframe' => 'Kopiere einbettbaren Spieler in die Zwischenablage',
        'clipboard_url' => 'Adresse in Zwischenablage kopieren',
        'dark' => 'Dunkel',
        'dark-transparent' => 'Dunkel (transparent)',
        'light' => 'Hell',
        'light-transparent' => 'Hell (transparent)',
    ],
    'publication_status_banner' => [
        'draft_mode' => 'Entwurfsmodus',
        'text' => '{publication_status, select,
            published {Diese Episode ist noch nicht veröffentlicht.}
            scheduled {Diese Episode ist für die Veröffentlichung geplant am {publication_date}.}
            with_podcast {Diese Episode wird zur gleichen Zeit wie der Podcast veröffentlicht.}
            other {Diese Episode ist noch nicht veröffentlicht.}
        }',
        'preview' => 'Vorschau',
    ],
];
