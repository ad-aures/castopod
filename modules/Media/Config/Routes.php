<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

/**
 * @copyright  2023 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

/** @var RouteCollection $routes */

$routes->get('static/(:any)', 'MediaController::serve/$1', [
    'as'        => 'media-serve',
    'namespace' => 'Modules\Media\Controllers',
    'filter'    => 'allow-cors',
]);
