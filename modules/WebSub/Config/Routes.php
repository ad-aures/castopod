<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

$routes = service('routes');

/**
 * WebSub routes file
 */

$routes->group('', [
    'namespace' => 'Modules\WebSub\Controllers',
], static function ($routes): void {
    $routes->cli('scheduled-websub-publish', 'WebSubController::publish');
});
