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
     * @var string
     */
    public $defaultHandler = 'gd';

    /**
     * The path to the image library.
     * Required for ImageMagick, GraphicsMagick, or NetPBM.
     *
     * @var string
     */
    public $libraryPath = '/usr/local/bin/convert';

    /**
     * The available handler classes.
     *
     * @var array<string, string>
     */
    public $handlers = [
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

    /**
     * @var integer
     */
    public $thumbnailSize = 150;

    /**
     * @var integer
     */
    public $mediumSize = 320;

    /**
     * @var integer
     */
    public $largeSize = 1024;

    /**
     * Size of images linked in the rss feed (should be between 1400 and 3000)
     *
     * @var integer
     */
    public $feedSize = 1400;

    /**
     * Size for ID3 tag cover art (should be between 300 and 800)
     *
     * @var integer
     */
    public $id3Size = 500;

    /*
	|--------------------------------------------------------------------------
	| Uploaded images naming extensions
    |--------------------------------------------------------------------------
    | The properties listed below set the name extensions for the resized images
	*/

    /**
     * @var string
     */
    public $thumbnailSuffix = '_thumbnail';

    /**
     * @var string
     */
    public $mediumSuffix = '_medium';

    /**
     * @var string
     */
    public $largeSuffix = '_large';

    /**
     * @var string
     */
    public $feedSuffix = '_feed';

    /**
     * @var string
     */
    public $id3Suffix = '_id3';
}
