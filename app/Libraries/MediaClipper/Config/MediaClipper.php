<?php

declare(strict_types=1);

namespace MediaClipper\Config;

use CodeIgniter\Config\BaseConfig;

class MediaClipper extends BaseConfig
{
    public string $fontsFolder = APPPATH . 'Libraries/MediaClipper/fonts/';

    public string $quotesImage = APPPATH . 'Libraries/MediaClipper/quotes.png';

    public string $wavesMask = APPPATH . 'Libraries/MediaClipper/waves-mask.png';

    public string $watermark = APPPATH . 'Libraries/MediaClipper/castopod-logo.png';

    /**
     * @var array<string, array<string, int|array<string, float|int|string>>>
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
            'podcastTitle' => [
                'fontsize' => 20,
                'x' => 150,
                'y' => 620,
                'lineWidth' => 510,
            ],
            'episodeTitle' => [
                'fontsize' => 32,
                'x' => 150,
                'y' => 660,
                'lines' => 3,
                'lineWidth' => 510,
                'lineHeight' => 1.5,
            ],
            'episodeNumbering' => [
                'fontsize' => 18,
                'paddingX' => 10,
                'paddingY' => 5,
                'marginRight' => 10,
            ],
            'timestamp' => [
                'fontsize' => 32,
                'padding' => 10,
                'x' => 1620,
                'y' => 985,
            ],
            'watermark' => [
                'width' => 90,
                'height' => 72,
                'x' => 140,
                'y' => 960,
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
            'podcastTitle' => [
                'fontsize' => 32,
                'x' => 360,
                'y' => 55,
                'lineWidth' => 670,
            ],
            'episodeTitle' => [
                'fontsize' => 42,
                'x' => 360,
                'y' => 110,
                'lines' => 3,
                'lineWidth' => 670,
                'lineHeight' => 1.5,
            ],
            'episodeNumbering' => [
                'fontsize' => 28,
                'paddingX' => 10,
                'paddingY' => 10,
                'marginRight' => 10,
            ],
            'timestamp' => [
                'fontsize' => 48,
                'padding' => 14,
                'x' => 734,
                'y' => 1800,
            ],
            'watermark' => [
                'width' => 120,
                'height' => 96,
                'x' => 130,
                'y' => 1770,
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
            'podcastTitle' => [
                'fontsize' => 28,
                'x' => 260,
                'y' => 50,
                'lines' => 1,
                'lineWidth' => 700,
            ],
            'episodeTitle' => [
                'fontsize' => 36,
                'x' => 260,
                'y' => 90,
                'lines' => 2,
                'lineWidth' => 700,
                'lineHeight' => 1.5,
            ],
            'episodeNumbering' => [
                'fontsize' => 24,
                'paddingX' => 10,
                'paddingY' => 5,
                'marginRight' => 10,
            ],
            'timestamp' => [
                'fontsize' => 48,
                'padding' => 10,
                'x' => 855,
                'y' => 1070,
            ],
            'watermark' => [
                'width' => 120,
                'height' => 96,
                'x' => 130,
                'y' => 1040,
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
                'mask' => APPPATH . 'Libraries/MediaClipper/soundwaves-mask-square.png',
            ],
            'subtitles' => [
                'fontsize' => 20,
                'marginL' => 60,
                'marginR' => 20,
                'marginV' => 98,
            ],
        ],
    ];

    /**
     * @var array<string, array<string, string|int[]>>
     */
    public array $themes = [
        'pine' => [
            // Preview must be a HSL colorscheme string
            'preview' => '174 100% 29%',
            'background' => [0, 86, 74],
            'text' => [255, 255, 255],
            // subtitle hex color is BGR (Blue, Green, Red),
            'subtitles' => 'FFFFFF',
            // quotes image MUST BE black
            'quotes' => [0, 148, 134],
            'episodeNumberingBg' => [0, 61, 11],
            'episodeNumberingText' => [255, 255, 255],
            'progressbar' => '009486',
            'timestampBg' => '00564A',
            'timestampText' => 'FFFFFF',
            'watermarkBg' => '00564A',
            'soundwaves' => [231, 249, 228],
        ],
        'crimson' => [
            // Preview must be a HSL colorscheme string
            'preview' => '350 87% 61%',
            'background' => [179, 31, 57],
            'text' => [255, 255, 255],
            // subtitle hex color is BGR (Blue, Green, Red),
            'subtitles' => 'FFFFFF',
            // quotes image MUST BE black
            'quotes' => [242, 70, 100],
            'episodeNumberingBg' => [152, 16, 43],
            'episodeNumberingText' => [255, 255, 255],
            'progressbar' => 'F24664',
            'timestampBg' => 'B31F39',
            'timestampText' => 'FFFFFF',
            'watermarkBg' => 'B31F39',
            'soundwaves' => [253, 206, 215],
        ],
        'lake' => [
            // Preview must be a HSL colorscheme string
            'preview' => '194 100% 44%',
            'background' => [0, 86, 113],
            'text' => [255, 255, 255],
            // subtitle hex color is BGR (Blue, Green, Red),
            'subtitles' => 'FFFFFF',
            // quotes image MUST BE black
            'quotes' => [0, 171, 225],
            'episodeNumberingBg' => [0, 43, 57],
            'episodeNumberingText' => [255, 255, 255],
            'progressbar' => '00ABE1',
            'timestampBg' => '005671',
            'timestampText' => 'FFFFFF',
            'watermarkBg' => '005671',
            'soundwaves' => [214, 245, 255],
        ],
        'amber' => [
            // Preview must be a HSL colorscheme string
            'preview' => '17 100% 57%',
            'background' => [177, 50, 0],
            'text' => [255, 255, 255],
            // subtitle hex color is BGR (Blue, Green, Red),
            'subtitles' => 'FFFFFF',
            // quotes image MUST BE black
            'quotes' => [255, 96, 34],
            'episodeNumberingBg' => [121, 34, 0],
            'episodeNumberingText' => [255, 255, 255],
            'progressbar' => 'FF6022',
            'timestampBg' => 'B13200',
            'timestampText' => 'FFFFFF',
            'watermarkBg' => 'B13200',
            'soundwaves' => [255, 213, 197],
        ],
        'jacaranda' => [
            // Preview must be a HSL colorscheme string
            'preview' => '254 72% 52%',
            'background' => [47, 21, 132],
            'text' => [255, 255, 255],
            // subtitle hex color is BGR (Blue, Green, Red),
            'subtitles' => 'FFFFFF',
            // quotes image MUST BE black
            'quotes' => [86, 45, 221],
            'episodeNumberingBg' => [30, 14, 84],
            'episodeNumberingText' => [255, 255, 255],
            'progressbar' => '562DDD',
            'timestampBg' => '2F1584',
            'timestampText' => 'FFFFFF',
            'watermarkBg' => '2F1584',
            'soundwaves' => [199, 185, 244],
        ],
        'onyx' => [
            // Preview must be a HSL colorscheme string
            'preview' => '240 17% 2%',
            'background' => [5, 5, 7],
            'text' => [255, 255, 255],
            // subtitle hex color is BGR (Blue, Green, Red),
            'subtitles' => 'FFFFFF',
            // quotes image MUST BE black
            'quotes' => [38, 38, 49],
            'episodeNumberingBg' => [0, 0, 0],
            'episodeNumberingText' => [255, 255, 255],
            'progressbar' => 'D5D5E1',
            'timestampBg' => '050507',
            'timestampText' => 'FFFFFF',
            'watermarkBg' => '050507',
            'soundwaves' => [213, 213, 225],
        ],
    ];
}
