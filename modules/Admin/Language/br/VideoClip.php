<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Tennadoù video',
        'status' => [
            'label' => 'Statud',
            'queued' => 'el lost',
            'queued_hint' => 'Emañ an tennad video el lost.',
            'pending' => 'o c\'hortoz',
            'pending_hint' => 'Clip will be generated shortly.',
            'running' => 'running',
            'running_hint' => 'Clip is being generated.',
            'failed' => 'c\'hwitet',
            'failed_hint' => 'Clip could not be generated: script failure.',
            'passed' => 'passed',
            'passed_hint' => 'Clip was generated successfully!',
        ],
        'clip' => 'Tennad',
        'duration' => 'Job duration',
    ],
    'title' => 'Video clip: {videoClipLabel}',
    'download_clip' => 'Pellgargañ an tennad',
    'create' => 'Tennad video nevez',
    'go_to_page' => 'Mont da pajenn an tennad',
    'retry' => 'Retry clip generation',
    'delete' => 'Dilemel an tennad',
    'logs' => 'Job logs',
    'messages' => [
        'alreadyExistingError' => 'The video clip you are trying to create already exists!',
        'addToQueueSuccess' => 'Video clip has been added to queue, awaiting to be created!',
        'deleteSuccess' => 'Video clip has been successfully removed!',
    ],
    'format' => [
        'landscape' => 'Landscape',
        'portrait' => 'Portrait',
        'squared' => 'Squared',
    ],
    'form' => [
        'title' => 'New video clip',
        'params_section_title' => 'Video clip parameters',
        'clip_title' => 'Titl an tennad',
        'format' => [
            'label' => 'Choose a format',
            'landscape_hint' => 'With a 16:9 ratio, landscape videos are great for PeerTube, Youtube and Vimeo.',
            'portrait_hint' => 'With a 9:16 ratio, portrait videos are great for TikTok, Youtube shorts and Instagram stories.',
            'squared_hint' => 'With a 1:1 ratio, squared videos are great for Mastodon, Facebook, Twitter and LinkedIn.',
        ],
        'theme' => 'Dibab un neuz',
        'start_time' => 'Start at',
        'duration' => 'Duration',
        'trim_start' => 'Trim start',
        'trim_end' => 'Trim end',
        'submit' => 'Create video clip',
    ],
    'requirements' => [
        'title' => 'Mankout a ra binvioù',
        'missing' => 'You have missing requirements. Make sure to add all the required items to be allowed creating a video for this episode!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'Levraoueg Freetype evit GD',
        'transcript' => 'Restr an treuzskrivadur (.srt)',
    ],
];
