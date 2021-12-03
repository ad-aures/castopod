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
                'y' => 660,
                'lines' => 3,
                'lineWidth' => 28,
                'leading' => 20,
            ],
            'podcastTitle' => [
                'fontsize' => 20,
                'x' => 150,
                'y' => 620,
            ],
            'episodeNumbering' => [
                'fontsize' => 18,
                'paddingX' => 10,
                'paddingY' => 5,
                'x' => 180,
                'y' => 540,
            ],
            'timestamp' => [
                'fontsize' => 32,
                'padding' => 10,
                'x' => 1680,
                'y' => 985,
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
                'mask' => APPPATH . 'Libraries/MediaClipper/soundwaves-mask-landscape.png',
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
            'cover' => [
                'width' => 280,
                'height' => 280,
                'radius' => 16,
                'x' => 50,
                'y' => 50,
            ],
            'quotes' => [
                'width' => 256,
                'height' => 256,
                'x' => 75,
                'y' => 520,
            ],
            'episodeTitle' => [
                'fontsize' => 42,
                'x' => 360,
                'y' => 110,
                'lines' => 3,
                'lineWidth' => 32,
                'leading' => 20,
            ],
            'podcastTitle' => [
                'fontsize' => 32,
                'x' => 360,
                'y' => 55,
            ],
            'episodeNumbering' => [
                'fontsize' => 28,
                'paddingX' => 0,
                'paddingY' => 10,
                'x' => 50,
                'y' => 330,
            ],
            'timestamp' => [
                'fontsize' => 48,
                'padding' => 10,
                'x' => 735,
                'y' => 1800,
            ],
            'progressbar' => [
                'height' => 10,
            ],
            'soundwaves' => [
                'width' => 54,
                'height' => 96,
                'rescaleWidth' => 1080,
                'rescaleHeight' => 1920,
                'x' => 0,
                'y' => 960,
                'mask' => APPPATH . 'Libraries/MediaClipper/soundwaves-mask-portrait.png',
            ],
            'subtitles' => [
                'fontsize' => 18,
                'marginL' => 60,
                'marginR' => 20,
                'marginV' => 97,
            ],
        ],
        'squared' => [
            'width' => 1200,
            'height' => 1200,
            'cover' => [
                'width' => 200,
                'height' => 200,
                'radius' => 16,
                'x' => 40,
                'y' => 40,
            ],
            'quotes' => [
                'width' => 200,
                'height' => 200,
                'x' => 85,
                'y' => 320,
            ],
            'episodeTitle' => [
                'fontsize' => 36,
                'x' => 260,
                'y' => 90,
                'lines' => 2,
                'lineWidth' => 38,
                'leading' => 20,
            ],
            'podcastTitle' => [
                'fontsize' => 28,
                'x' => 260,
                'y' => 50,
            ],
            'episodeNumbering' => [
                'fontsize' => 20,
                'paddingX' => 0,
                'paddingY' => 10,
                'x' => 40,
                'y' => 240,
            ],
            'timestamp' => [
                'fontsize' => 48,
                'padding' => 10,
                'x' => 855,
                'y' => 1070,
            ],
            'progressbar' => [
                'height' => 10,
            ],
            'soundwaves' => [
                'width' => 60,
                'height' => 60,
                'rescaleWidth' => 1200,
                'rescaleHeight' => 1200,
                'x' => 0,
                'y' => 600,
                'mask' => APPPATH . 'Libraries/MediaClipper/soundwaves-mask-squared.png',
            ],
            'subtitles' => [
                'fontsize' => 20,
                'marginL' => 60,
                'marginR' => 20,
                'marginV' => 98,
            ],
        ],
    ];
}
