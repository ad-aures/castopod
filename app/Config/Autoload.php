<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

/**
 * -------------------------------------------------------------------
 * AUTO-LOADER
 * -------------------------------------------------------------------
 *
 * This file defines the namespaces and class maps so the Autoloader
 * can find the files as needed.
 *
 * NOTE: If you use an identical key in $psr4 or $classmap, then
 * the values in this file will overwrite the framework's values.
 *
 * @immutable
 */
class Autoload extends AutoloadConfig
{
    /**
     * -------------------------------------------------------------------
     * Namespaces
     * -------------------------------------------------------------------
     * This maps the locations of any namespaces in your application to
     * their location on the file system. These are used by the autoloader
     * to locate files the first time they have been instantiated.
     *
     * The '/app' and '/system' directories are already mapped for you.
     * you may change the name of the 'App' namespace if you wish,
     * but this should be done prior to creating any namespaced classes,
     * else you will need to modify all of those classes for this to work.
     *
     * Prototype:
     *
     *   $psr4 = [
     *       'CodeIgniter' => SYSTEMPATH,
     *       'App'	       => APPPATH
     *   ];
     *
     * @var array<string, list<string>|string>
     */
    public $psr4 = [
        APP_NAMESPACE             => APPPATH,
        'Config'                  => APPPATH . 'Config/',
        'Modules'                 => ROOTPATH . 'modules/',
        'Modules\Admin'           => ROOTPATH . 'modules/Admin/',
        'Modules\Analytics'       => ROOTPATH . 'modules/Analytics/',
        'Modules\Api\Rest\V1'     => ROOTPATH . 'modules/Api/Rest/V1',
        'Modules\Auth'            => ROOTPATH . 'modules/Auth/',
        'Modules\Fediverse'       => ROOTPATH . 'modules/Fediverse/',
        'Modules\Install'         => ROOTPATH . 'modules/Install/',
        'Modules\Media'           => ROOTPATH . 'modules/Media/',
        'Modules\MediaClipper'    => ROOTPATH . 'modules/MediaClipper/',
        'Modules\PodcastImport'   => ROOTPATH . 'modules/PodcastImport/',
        'Modules\PremiumPodcasts' => ROOTPATH . 'modules/PremiumPodcasts/',
        'Modules\Update'          => ROOTPATH . 'modules/Update/',
        'Modules\WebSub'          => ROOTPATH . 'modules/WebSub/',
        'Themes'                  => ROOTPATH . 'themes',
        'ViewComponents'          => APPPATH . 'Libraries/ViewComponents/',
        'ViewThemes'              => APPPATH . 'Libraries/ViewThemes/',
        'Vite'                    => APPPATH . 'Libraries/Vite/',
    ];

    /**
     * -------------------------------------------------------------------
     * Class Map
     * -------------------------------------------------------------------
     * The class map provides a map of class names and their exact
     * location on the drive. Classes loaded in this manner will have
     * slightly faster performance because they will not have to be
     * searched for within one or more directories as they would if they
     * were being autoloaded through a namespace.
     *
     * Prototype:
     *
     *   $classmap = [
     *       'MyClass'   => '/path/to/class/file.php'
     *   ];
     *
     * @var array<string, string>
     */
    public $classmap = [];

    /**
     * -------------------------------------------------------------------
     * Files
     * -------------------------------------------------------------------
     * The files array provides a list of paths to __non-class__ files
     * that will be autoloaded. This can be useful for bootstrap operations
     * or for loading functions.
     *
     * Prototype:
     *
     *	  $files = [
     *	 	   '/path/to/my/file.php',
     *    ];
     *
     * @var list<string>
     */
    public $files = [APPPATH . 'Libraries/ViewComponents/Helpers/view_components_helper.php'];

    /**
     * -------------------------------------------------------------------
     * Helpers
     * -------------------------------------------------------------------
     * Prototype:
     *   $helpers = [
     *       'form',
     *   ];
     *
     * @var list<string>
     */
    public $helpers = ['auth', 'setting'];
}
