<?php

declare(strict_types=1);

namespace MediaClipper\Config;

use CodeIgniter\Config\BaseConfig;

class MediaClipper extends BaseConfig
{
    public string $fontsFolder = APPPATH . 'Libraries/MediaClipper/fonts/';

    public string $quotesImage = APPPATH . 'Libraries/MediaClipper/quotes.png';

    public string $wavesMask = APPPATH . 'Libraries/MediaClipper/waves-mask.png';

    /**
     * @var array<string, array<string, int|array<string, int|string>>>
     */
    public array $formats = [
        'landscape' => [
            'width' => 1920,
            'height' => 1080,
            'cover' => [
                'width' => 480,
                'height' => 480,
                'radius' => 24,
                'x' => 150,
                'y' => 120,
            ],
            'quotes' => [
                'width' => 192,
                'height' => 192,
                'x' => 810,
                'y' => 210,
            ],
            'episodeTitle' => [
                'fontsize' => 32,
                'x' => 150,
                'y' => 690,
                'lines' => 3,
                'lineWidth' => 28,
                'leading' => 20,
            ],
            'podcastTitle' => [
                'fontsize' => 20,
                'x' => 150,
                'y' => 640,
            ],
            'episodeNumbering' => [
                'fontsize' => 18,
                'paddingX' => 10,
                'paddingY' => 5,
                'x' => 180 + 10,
                'y' => 540,
            ],
            'timestamp' => [
                'fontsize' => 32,
                'padding' => 10,
                'x' => 1678,
                'y' => 986,
            ],
            'progressbar' => [
                'height' => 10,
            ],
            'soundwaves' => [
                'width' => 192,
                'height' => 108,
                'rescaleWidth' => 1920,
                'rescaleHeight' => 540,
                'x' => 0,
                'y' => 810,
                'mask' => APPPATH . 'Libraries/MediaClipper/waves-mask.png',
            ],
            'subtitles' => [
                'fontsize' => 18,
                'marginL' => 180,
                'marginR' => 20,
                'marginV' => 85,
            ],
        ],
        'portrait' => [
            'width' => 1080,
            'height' => 1920,
        ],
        'squared' => [
            'width' => 1200,
            'height' => 1200,
        ],
    ];
}
