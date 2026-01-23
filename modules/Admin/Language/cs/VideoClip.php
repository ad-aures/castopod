<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Videoklipy',
        'status' => [
            'label' => 'Stav',
            'queued' => 've frontě',
            'queued_hint' => 'Klip čeká na zpracování.',
            'pending' => 'čeká',
            'pending_hint' => 'Klip bude brzy vygenerován.',
            'running' => 'běží',
            'running_hint' => 'Vytváří se klip.',
            'failed' => 'selhalo',
            'failed_hint' => 'Klip nelze vygenerovat: skript selhal.',
            'passed' => 'prošel',
            'passed_hint' => 'Klip byl úspěšně vygenerován!',
        ],
        'clip' => 'Klip',
        'duration' => 'Trvání úlohy',
    ],
    'title' => 'Videoklip: {videoClipLabel}',
    'download_clip' => 'Stáhnout klip',
    'create' => 'Nový videoklip',
    'go_to_page' => 'Přejít na stránku klipu',
    'retry' => 'Opakovat generování klipu',
    'delete' => 'Odstranit klip',
    'logs' => 'Záznamy úloh',
    'messages' => [
        'alreadyExistingError' => 'Videoklip, který se pokoušíte vytvořit, již existuje!',
        'addToQueueSuccess' => 'Videoklip byl přidán do fronty, čeká na vytvoření!',
        'deleteSuccess' => 'Videoklip byl úspěšně odstraněn!',
    ],
    'format' => [
        'landscape' => 'Na šířku',
        'portrait' => 'Na výšku',
        'squared' => 'Čtverec',
    ],
    'form' => [
        'title' => 'Nový videoklip',
        'params_section_title' => 'Parametry videoklipu',
        'clip_title' => 'Název klipu',
        'format' => [
            'label' => 'Vyberte formát',
            'landscape_hint' => 'S poměrem 16:9 jsou videa na šířku skvělá pro PeerTube, YouTube a Vimeo.',
            'portrait_hint' => 'S poměrem 9:16 jsou videa na výšku skvělá pro TikTok, YouTube shorts a Instagram příběhy.',
            'squared_hint' => 'S poměrem 1:1 jsou čtvercová videa skvělá pro Mastodon, Facebook, Twitter a LinkedIn.',
        ],
        'theme' => 'Vyberte šablonu',
        'start_time' => 'Začátek v',
        'duration' => 'Doba trvání',
        'trim_start' => 'Oříznout začátek',
        'trim_end' => 'Oříznout konec',
        'submit' => 'Vytvořit videoklip',
    ],
    'requirements' => [
        'title' => 'Chybějící požadavky',
        'missing' => 'Máte chybějící požadavky. Ujistěte se, že přidáte všechny požadované položky, aby bylo možné pro tuto epizodu vytvořit video!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'Freetype library pro GD',
        'transcript' => 'Soubor přepisu (.srt)',
    ],
];
