<?php

declare(strict_types=1);

namespace Modules\Auth;

use CodeIgniter\Router\RouteCollection;
use CodeIgniter\Shield\Auth as ShieldAuth;

class Auth extends ShieldAuth
{
    /**
     * Will set the routes in your application to use
     * the Shield auth routes.
     *
     * Usage (in Config/Routes.php):
     *      - auth()->routes($routes);
     *      - auth()->routes($routes, ['except' => ['login', 'register']])
     */
    public function routes(RouteCollection &$routes, array $config = []): void
    {
        $authRoutes = config('AuthRoutes')
            ->routes;

        $routes->group(config('Auth')->gateway, [
            'namespace' => 'Modules\Auth\Controllers',
        ], static function (RouteCollection $routes) use ($authRoutes, $config): void {
            foreach ($authRoutes as $name => $row) {
                if (! isset($config['except']) || ! in_array($name, $config['except'], true)) {
                    foreach ($row as $params) {
                        $options = isset($params[3])
                            ? [
                                'as' => $params[3],
                            ]
                            : null;
                        $routes->{$params[0]}($params[1], $params[2], $options);
                    }
                }
            }
        });
    }
}
