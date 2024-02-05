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
            'queued' => 'in wachtrij',
            'queued_hint' => 'Clip is waiting to be processed.',
            'pending' => 'in behandeling',
            'pending_hint' => 'Clip will be generated shortly.',
            'running' => 'actief',
            'running_hint' => 'Clip is being generated.',
            'failed' => 'mislukt',
            'failed_hint' => 'Clip could not be generated: script failure.',
            'passed' => 'passed',
            'passed_hint' => 'Clip was generated successfully!',
        ],
        'clip' => 'Clip',
        'duration' => 'Job duration',
    ],
    'title' => 'Video clip: {videoClipLabel}',
    'download_clip' => 'Download clip',
    'create' => 'New video clip',
    'go_to_page' => 'Go to clip page',
    'retry' => 'Retry clip generation',
    'delete' => 'Delete clip',
    'logs' => 'Job logs',
    'messages' => [
        'alreadyExistingError' => 'The video clip you are trying to create already exists!',
        'addToQueueSuccess' => 'Video clip has been added to queue, awaiting to be created!',
        'deleteSuccess' => 'Video clip has been successfully removed!',
    ],
    'format' => [
        'landscape' => 'Liggend',
        'portrait' => 'Portrait',
        'squared' => 'Vierkant',
    ],
    'form' => [
        'title' => 'Nieuwe videoclip',
        'params_section_title' => 'Video clip parameters',
        'clip_title' => 'Clip title',
        'format' => [
            'label' => 'Kies een formaat',
            'landscape_hint' => 'With a 16:9 ratio, landscape videos are great for PeerTube, Youtube and Vimeo.',
            'portrait_hint' => 'With a 9:16 ratio, portrait videos are great for TikTok, Youtube shorts and Instagram stories.',
            'squared_hint' => 'With a 1:1 ratio, squared videos are great for Mastodon, Facebook, Twitter and LinkedIn.',
        ],
        'theme' => 'Selecteer een thema',
        'start_time' => 'Begintijd',
        'duration' => 'Duur',
        'trim_start' => 'Trim start',
        'trim_end' => 'Trim end',
        'submit' => 'Create video clip',
    ],
    'requirements' => [
        'title' => 'Missing requirements',
        'missing' => 'You have missing requirements. Make sure to add all the required items to be allowed creating a video for this episode!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'Freetype library for GD',
        'transcript' => 'Transcript file (.srt)',
    ],
];
