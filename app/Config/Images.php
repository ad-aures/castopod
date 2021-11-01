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
     */
    public string $libraryPath = '/usr/local/bin/convert';

    /**
     * The available handler classes.
     *
     * @var array<string, string>
     */
    public array $handlers = [
        'gd' => GDHandler::class,
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
     * @var array<string, int[]>
     */
    public array $podcastCoverSizes = [
        'tiny' => [40, 40],
        'thumbnail' => [150, 150],
        'medium' => [320, 320],
        'large' => [1024, 1024],
        'feed' => [1400, 1400],
        'id3' => [500, 500],
    ];

    /**
     * Podcast header cover image
     *
     * Uploaded podcast header covers are of 3:1 ratio
     *
     * Array values are as follows: 'name' => [width, height]
     *
     * @var array<string, int[]>
     */
    public array $podcastBannerSizes = [
        'small' => [320, 128],
        'medium' => [960, 320],
        'large' => [1500, 500],
    ];

    public string $podcastBannerDefaultPath = 'castopod-banner-default.jpg';

    public string $podcastBannerDefaultMimeType = 'image/jpeg';

    /**
     * Person image
     *
     * Uploaded person images are of 1:1 ratio (width and height are the same).
     *
     * Array values are as follows: 'name' => [width, height]
     *
     * @var array<string, int[]>
     */
    public array $personAvatarSizes = [
        'tiny' => [40, 40],
        'thumbnail' => [150, 150],
        'medium' => [320, 320],
    ];
}
