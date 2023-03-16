<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Säsong {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Avsnitt {episodeNumber}',
    'number_abbr' => 'Av. {episodeNumber}',
    'season_episode' => 'Säsong {seasonNumber} avsnitt {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}A{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# kommentar}
        other {# kommentarer}
    }',
    'all_podcast_episodes' => 'Alla podcast avsnitt',
    'back_to_podcast' => 'Gå tillbaka till podcasten',
    'edit' => 'Redigera',
    'publish' => 'Publicera',
    'publish_edit' => 'Redigera publikation',
    'publish_date_edit' => 'Redigera publiceringsdatum',
    'unpublish' => 'Avpublicera',
    'publish_error' => 'Avsnittet är redan publicerat.',
    'publish_edit_error' => 'Avsnittet är redan publicerat.',
    'publish_cancel_error' => 'Avsnittet är redan publicerat.',
    'publish_date_edit_error' => 'Avsnittet har inte publicerats ännu, du kan inte redigera dess publiceringsdatum.',
    'publish_date_edit_future_error' => 'Avsnittets publiceringsdatum kan bara ställas in till ett tidigare datum! Om du vill boka om det, avpublicera det först.',
    'publish_date_edit_success' => 'Avsnittets publiceringsdatum har uppdaterats!',
    'unpublish_error' => 'Avsnittet är inte publicerat.',
    'delete' => 'Radera',
    'go_to_page' => 'Gå till sida',
    'create' => 'Lägg till ett avsnitt',
    'publication_status' => [
        'published' => 'Publicerad',
        'with_podcast' => 'Publicerad',
        'scheduled' => 'Schemalagd',
        'not_published' => 'Ej publicerat',
    ],
    'with_podcast_hint' => 'Publiceras samtidigt som podcasten',
    'list' => [
        'search' => [
            'placeholder' => 'Sök efter ett avsnitt',
            'clear' => 'Rensa sökning',
            'submit' => 'Sök',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# avsnitt}
            other {# avsnitt}
        }',
        'episode' => 'Avsnitt',
        'visibility' => 'Synlighet',
        'comments' => 'Kommentarer',
        'actions' => 'Åtgärder',
    ],
    'messages' => [
        'createSuccess' => 'Avsnittet har skapats!',
        'editSuccess' => 'Avsnittet har uppdaterats!',
        'publishSuccess' => '{publication_status, select,
            published {Avsnittet har publicerats!}
            scheduled {Avsnittspubliceringen har planerats!}
            with_podcast {Detta avsnitt kommer att publiceras samtidigt som podcasten.}
            other {Detta avsnitt är inte publicerad.}
        }',
        'publishCancelSuccess' => 'Avsnitt publicering har avbrutits!',
        'unpublishBeforeDeleteTip' => 'Du måste avpublicera avsnittet innan du tar bort det.',
        'scheduleDateError' => 'Schemaläggningsdatum måste anges!',
        'deletePublishedEpisodeError' => 'Avpublicera avsnittet innan du tar bort det.',
        'deleteSuccess' => 'Avsnittet har tagits bort!',
        'deleteError' => 'Misslyckades att ta bort avsnitt {type, select,
            transcript {transcript}
            chapters {kapitel}
            image {omslag}
            audio {ljud}
            other {media}
        }.',
        'deleteFileError' => 'Det gick inte att ta bort {type, select,
            transcript {transcript}
            chapters {kapitel}
            image {omslag}
            audio {ljud}
            other {media}
        } fil {file_key}. Du kan manuellt ta bort den från disken.',
        'sameSlugError' => 'Ett avsnitt med den valda slug finns redan.',
    ],
    'form' => [
        'file_size_error' =>
            'Din filstorlek är för stor! Max storlek är {0}. Öka värdena `memory_limit`, `upload_max_filesize` och `post_max_size` i din php-konfigurationsfil och starta sedan om din webbserver för att ladda upp filen.',
        'audio_file' => 'Ljudfil',
        'audio_file_hint' => 'Välj en. mp3 eller . m4a ljudfil.',
        'info_section_title' => 'Avsnitt information',
        'cover' => 'Avsnitt omslag',
        'cover_hint' =>
            'Om du inte sätter ett omslag kommer podcast-omslaget att användas istället.',
        'cover_size_hint' => 'Omslaget måste vara fyrkantigt och minst 1400px brett och högt.',
        'title' => 'Rubrik',
        'title_hint' =>
            'Bör innehålla ett tydligt och koncist avsnittsnamn. Ange inte avsnitt eller säsongsnummer här.',
        'permalink' => 'Permalänk',
        'season_number' => 'Säsong',
        'episode_number' => 'Avsnitt',
        'type' => [
            'label' => 'Typ',
            'full' => 'Full',
            'full_hint' => 'Komplett innehåll (avsnittet)',
            'trailer' => 'Trailer',
            'trailer_hint' => 'Kort, PR-del av innehåll som representerar en förhandsvisning av den aktuella serien',
            'bonus' => 'Bonus',
            'bonus_hint' => 'Extra innehåll för showen (till exempel bakom scenens info eller intervjuer med cast) eller korspremiellt innehåll för en annan show',
        ],
        'premium_title' => 'Premium',
        'premium' => 'Avsnitt måste endast vara tillgängligt för premiumprenumeranter',
        'parental_advisory' => [
            'label' => 'Föräldrarådgivande',
            'hint' => 'Innehåller avsnittet olämpligt innehåll?',
            'undefined' => 'odefinierad',
            'clean' => 'Ren',
            'explicit' => 'Uteslutande',
        ],
        'show_notes_section_title' => 'Visa anteckningar',
        'show_notes_section_subtitle' =>
            'Upp till 4000 tecken, var tydlig och koncis. Visa anteckningar hjälper potentiella lyssnare att hitta avsnittet.',
        'description' => 'Beskrivning',
        'description_footer' => 'Beskrivning sidfot',
        'description_footer_hint' =>
            'Denna text läggs till i slutet av varje avsnitt beskrivning, det är ett bra ställe att skriva in dina sociala länkar till exempel.',
        'additional_files_section_title' => 'Ytterligare filer',
        'additional_files_section_subtitle' =>
            'Dessa filer kan användas av andra plattformar för att ge bättre upplevelse till din publik. Se {podcastNamespaceLink} för mer information.',
        'location_section_title' => 'Plats',
        'location_section_subtitle' => 'Vilken plats handlar detta avsnitt om?',
        'location_name' => 'Platsnamn eller adress',
        'location_name_hint' => 'Detta kan vara en verklig eller fiktiv plats',
        'transcript' => 'Avskrift (undertexter / undertexter)',
        'transcript_hint' => 'Endast .srt är tillåtna.',
        'transcript_download' => 'Ladda ner avskrift',
        'transcript_file' => 'Avskrift av fil (.srt)',
        'transcript_remote_url' => 'Fjärr-URL för avskrift',
        'transcript_file_delete' => 'Ta bort avskrift',
        'chapters' => 'Kapitel',
        'chapters_hint' => 'Filen måste vara i JSON Kapitelformat.',
        'chapters_download' => 'Ladda ner kapitel',
        'chapters_file' => 'Kapitel fil',
        'chapters_remote_url' => 'Fjärr-URL för kapitelfil',
        'chapters_file_delete' => 'Ta bort kapitelfil',
        'advanced_section_title' => 'Avancerade parametrar',
        'advanced_section_subtitle' =>
            'Om du behöver RSS-taggar som Castopod inte hanterar, ställ in dem här.',
        'custom_rss' => 'Anpassade RSS-taggar för avsnittet',
        'custom_rss_hint' => 'Detta kommer att injiceras inom <unk> item<unk> taggen.',
        'block' => 'Avsnitt bör döljas från offentliga kataloger',
        'block_hint' =>
            'Avsnitten visa eller dölja status: växla detta hindrar avsnitten från att visas i Apple Podcasts, Google Podcasts, och alla tredjepartsappar som drar program från dessa kataloger. (Inte garanterat)',
        'submit_create' => 'Skapa avsnitt',
        'submit_edit' => 'Spara avsnitt',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Tillbaka till avsnittets instrumentpanel',
        'post' => 'Ditt meddelande inlägg',
        'post_hint' =>
            "Skriv ett meddelande för att meddela publiceringen av ditt avsnitt. Meddelandet kommer att sändas till alla dina följare i fediverse och presenteras på din podcasts hemsida.",
        'message_placeholder' => 'Skriv ditt meddelande…',
        'publication_date' => 'Publiceringsdatum',
        'publication_method' => [
            'now' => 'Nu',
            'schedule' => 'Schemalägg',
            'with_podcast' => 'Publicera tillsammans med podcast',
        ],
        'scheduled_publication_date' => 'Planerat publiceringsdatum',
        'scheduled_publication_date_clear' => 'Rensa publiceringsdatum',
        'scheduled_publication_date_hint' =>
            'Du kan schemalägga avsnittet genom att ställa in ett framtida publiceringsdatum. Detta fält måste formateras som ÅÅÅ-MM-DD HH:mm',
        'submit' => 'Publicera',
        'submit_edit' => 'Redigera publikation',
        'cancel_publication' => 'Avbryt publicering',
        'message_warning' => 'Du skrev inte ett meddelande för ditt tillkännagivande!',
        'message_warning_hint' => 'Att ha ett meddelande ökar socialt engagemang, vilket resulterar i en bättre synlighet för ditt avsnitt.',
        'message_warning_submit' => 'Publicera ändå',
    ],
    'publish_date_edit_form' => [
        'new_publication_date' => 'Nytt publiceringsdatum',
        'new_publication_date_hint' => 'Måste vara inställd till ett tidigare datum.',
        'submit' => 'Redigera publiceringsdatum',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Avpublicera avsnittet kommer att ta bort alla kommentarer och inlägg som är associerade med det och ta bort det från podcastens RSS-flöde.",
        'understand' => 'Jag förstår, jag vill avpublicera avsnittet',
        'submit' => 'Avpublicera',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Borttagning av avsnittet kommer att ta bort alla mediefiler, kommentarer, videoklipp och ljudfiler som är associerade med det.",
        'understand' => 'Jag förstår, Jag vill ta bort avsnittet',
        'submit' => 'Radera',
    ],
    'embed' => [
        'title' => 'Inbäddad spelare',
        'label' =>
            'Välj ett tema färg, kopiera den inbäddade spelaren till urklipp, sedan klistra in den på din webbplats.',
        'clipboard_iframe' => 'Kopiera inbäddbar spelare till urklipp',
        'clipboard_url' => 'Kopiera adress till urklipp',
        'dark' => 'Mörk',
        'dark-transparent' => 'Mörk transparent',
        'light' => 'Ljust',
        'light-transparent' => 'Ljus transparent',
    ],
];
