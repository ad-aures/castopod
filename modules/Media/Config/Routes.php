<?php

declare(strict_types=1);

/**
 * @copyright  2023 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

$routes = service('routes');

$routes->get('static/(:any)', 'MediaController::serve/$1', [
    'as' => 'media-serve',
    'namespace' => 'Modules\Media\Controllers',
]);
