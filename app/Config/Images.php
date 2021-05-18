<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Images\Handlers\GDHandler;
use CodeIgniter\Images\Handlers\ImageMagickHandler;

class Images extends BaseConfig
{
    /**
     * Default handler used if no other handler is specified.
     *
     */
    public string $defaultHandler = 'gd';

    /**
     * The path to the image library.
     * Required for ImageMagick, GraphicsMagick, or NetPBM.
     *
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
	| Uploaded images resizing sizes (in px)
    |--------------------------------------------------------------------------
    | The sizes listed below determine the resizing of images when uploaded.
    | All uploaded images are of 1:1 ratio (width and height are the same).
	*/

    public int $thumbnailSize = 150;
    public int $mediumSize = 320;
    public int $largeSize = 1024;

    /**
     * Size of images linked in the rss feed (should be between 1400 and 3000)
     */
    public int $feedSize = 1400;

    /**
     * Size for ID3 tag cover art (should be between 300 and 800)
     */
    public int $id3Size = 500;

    /*
	|--------------------------------------------------------------------------
	| Uploaded images naming extensions
    |--------------------------------------------------------------------------
    | The properties listed below set the name extensions for the resized images
	*/

    public string $thumbnailSuffix = '_thumbnail';

    public string $mediumSuffix = '_medium';

    public string $largeSuffix = '_large';

    public string $feedSuffix = '_feed';

    public string $id3Suffix = '_id3';
}
