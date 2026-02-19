<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Images\Handlers\GDHandler;
use CodeIgniter\Images\Handlers\ImageMagickHandler;

class Images extends BaseConfig
{
    /**
     * Default handler used if no other handler is specified.
     */
    public string $defaultHandler = 'gd';

    /**
     * The path to the image library. Required for ImageMagick, GraphicsMagick, or NetPBM.
     *
     * @deprecated 4.7.0 No longer used.
     */
    public string $libraryPath = '/usr/local/bin/convert';

    /**
     * The available handler classes.
     *
     * @var array<string, string>
     */
    public array $handlers = [
        'gd'      => GDHandler::class,
        'imagick' => ImageMagickHandler::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Uploaded images sizes (in px)
    |--------------------------------------------------------------------------
    | The sizes listed below determine the resizing of images when uploaded.
    */

    /**
     * Podcast cover image sizes
     *
     * Uploaded podcast covers are of 1:1 ratio (width and height are the same).
     *
     * Size of images linked in the rss feed (should be between 1400 and 3000). Size for ID3 tag cover art (should be
     * between 300 and 800)
     *
     * Array values are as follows: 'name' => [width, height]
     *
     * @var array<string, array<string, int|string>>
     */
    public array $podcastCoverSizes = [
        'tiny' => [
            'width'     => 40,
            'height'    => 40,
            'mimetype'  => 'image/webp',
            'extension' => 'webp',
        ],
        'thumbnail' => [
            'width'     => 150,
            'height'    => 150,
            'mimetype'  => 'image/webp',
            'extension' => 'webp',
        ],
        'medium' => [
            'width'     => 320,
            'height'    => 320,
            'mimetype'  => 'image/webp',
            'extension' => 'webp',
        ],
        'large' => [
            'width'     => 1024,
            'height'    => 1024,
            'mimetype'  => 'image/webp',
            'extension' => 'webp',
        ],
        'feed' => [
            'width'  => 1400,
            'height' => 1400,
        ],
        'id3' => [
            'width'  => 500,
            'height' => 500,
        ],
        'og' => [
            'width'  => 1200,
            'height' => 1200,
        ],
        'federation' => [
            'width'  => 400,
            'height' => 400,
        ],
        'webmanifest192' => [
            'width'     => 192,
            'height'    => 192,
            'mimetype'  => 'image/png',
            'extension' => 'png',
        ],
        'webmanifest512' => [
            'width'     => 512,
            'height'    => 512,
            'mimetype'  => 'image/png',
            'extension' => 'png',
        ],
    ];

    /**
     * Podcast header cover image
     *
     * Uploaded podcast header covers are of 3:1 ratio
     *
     * @var array<string, array<string, int|string>>
     */
    public array $podcastBannerSizes = [
        'small' => [
            'width'     => 320,
            'height'    => 128,
            'mimetype'  => 'image/webp',
            'extension' => 'webp',
        ],
        'medium' => [
            'width'     => 960,
            'height'    => 320,
            'mimetype'  => 'image/webp',
            'extension' => 'webp',
        ],
        'federation' => [
            'width'  => 1500,
            'height' => 500,
        ],
    ];

    public string $avatarDefaultPath = 'assets/images/castopod-avatar.jpg';

    public string $avatarDefaultMimeType = 'image/jpg';

    /**
     * @var array<string, array<string, string>>
     */
    public array $podcastBannerDefaultPaths = [
        'default' => [
            'path'     => 'assets/images/castopod-banner-pine.jpg',
            'mimetype' => 'image/jpeg',
        ],
        'pine' => [
            'path'     => 'assets/images/castopod-banner-pine.jpg',
            'mimetype' => 'image/jpeg',
        ],
        'crimson' => [
            'path'     => 'assets/images/castopod-banner-crimson.jpg',
            'mimetype' => 'image/jpeg',
        ],
        'amber' => [
            'path'     => 'assets/images/castopod-banner-amber.jpg',
            'mimetype' => 'image/jpeg',
        ],
        'lake' => [
            'path'     => 'assets/images/castopod-banner-lake.jpg',
            'mimetype' => 'image/jpeg',
        ],
        'jacaranda' => [
            'path'     => 'assets/images/castopod-banner-jacaranda.jpg',
            'mimetype' => 'image/jpeg',
        ],
        'onyx' => [
            'path'     => 'assets/images/castopod-banner-onyx.jpg',
            'mimetype' => 'image/jpeg',
        ],
    ];

    public string $podcastBannerDefaultMimeType = 'image/jpeg';

    /**
     * Person image
     *
     * Uploaded person images are of 1:1 ratio (width and height are the same).
     *
     * Array values are as follows: 'name' => [width, height]
     *
     * @var array<string, array<string, int|string>>
     */
    public array $personAvatarSizes = [
        'federation' => [
            'width'  => 400,
            'height' => 400,
        ],
        'tiny' => [
            'width'     => 40,
            'height'    => 40,
            'mimetype'  => 'image/webp',
            'extension' => 'webp',
        ],
        'thumbnail' => [
            'width'     => 150,
            'height'    => 150,
            'mimetype'  => 'image/webp',
            'extension' => 'webp',
        ],
        'medium' => [
            'width'     => 320,
            'height'    => 320,
            'mimetype'  => 'image/webp',
            'extension' => 'webp',
        ],
    ];
}
