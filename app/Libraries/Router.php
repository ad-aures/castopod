<?php

declare(strict_types=1);

/**
 * This file extends the Router class from the CodeIgniter 4 framework.
 *
 * It introduces the alternate-content option for a route.
 *
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use CodeIgniter\Router\Exceptions\RedirectException;
use CodeIgniter\Router\Router as CodeIgniterRouter;
use Config\Services;

class Router extends CodeIgniterRouter
{
    /**
     * Compares the uri string against the routes that the RouteCollection class defined for us, attempting to find a
     * match. This method will modify $this->controller, etal as needed.
     *
     * @param string $uri The URI path to compare against the routes
     *
     * @return boolean Whether the route was matched or not.
     * @throws RedirectException
     */
    protected function checkRoutes(string $uri): bool
    {
        /** @noRector RemoveExtraParametersRector */
        $routes = $this->collection->getRoutes($this->collection->getHTTPVerb());

        // Don't waste any time
        if ($routes === []) {
            return false;
        }

        $uri = $uri === '/' ? $uri : ltrim($uri, '/ ');

        // Loop through the route array looking for wildcards
        foreach ($routes as $key => $val) {
            // Reset localeSegment
            $localeSegment = null;

            $key = $key === '/' ? $key : ltrim($key, '/ ');

            $matchedKey = $key;

            // Are we dealing with a locale?
            if (str_contains($key, '{locale}')) {
                $localeSegment = array_search(
                    '{locale}',
                    preg_split('~[\/]*((^[a-zA-Z0-9])|\(([^()]*)\))*[\/]+~m', $key),
                    true,
                );

                // Replace it with a regex so it
                // will actually match.
                $key = str_replace('/', '\/', $key);
                $key = str_replace('{locale}', '[^\/]+', $key);
            }

            // Does the RegEx match?
            if (preg_match('#^' . $key . '$#u', $uri, $matches)) {
                $this->matchedRouteOptions = $this->collection->getRoutesOptions($matchedKey);

                // Is this route supposed to redirect to another?
                if ($this->collection->isRedirect($key)) {
                    throw new RedirectException(
                        is_array($val) ? key($val) : $val,
                        $this->collection->getRedirectCode($key),
                    );
                }
                // Store our locale so CodeIgniter object can
                // assign it to the Request.
                if (isset($localeSegment)) {
                    // The following may be inefficient, but doesn't upset NetBeans :-/
                    $temp = explode('/', $uri);
                    $this->detectedLocale = $temp[$localeSegment];
                }

                // Are we using Closures? If so, then we need
                // to collect the params into an array
                // so it can be passed to the controller method later.
                if (! is_string($val) && is_callable($val)) {
                    $this->controller = $val;

                    // Remove the original string from the matches array
                    array_shift($matches);

                    $this->params = $matches;

                    $this->matchedRoute = [$matchedKey, $val];

                    return true;
                }

                // Is there an alternate content for the matchedRoute?

                // check if the alternate-content has been requested in the accept
                // header and overwrite the $val with the matching controller method
                if (
                    array_key_exists('alternate-content', $this->matchedRouteOptions) &&
                    is_array($this->matchedRouteOptions['alternate-content'])
                ) {
                    $request = Services::request();
                    $negotiate = Services::negotiator();

                    $acceptHeader = $request->getHeader('Accept')
                        ->getValue();
                    $parsedHeader = $negotiate->parseHeader($acceptHeader);

                    $supported = array_keys($this->matchedRouteOptions['alternate-content']);

                    $expectedContentType = $parsedHeader[0];
                    foreach ($supported as $available) {
                        if (
                            $negotiate->callMatch($expectedContentType, $available, true)
                        ) {
                            if (
                                array_key_exists(
                                    'namespace',
                                    $this->matchedRouteOptions[
                                        'alternate-content'
                                    ][$available],
                                )
                            ) {
                                $this->collection->setDefaultNamespace(
                                    $this->matchedRouteOptions[
                                        'alternate-content'
                                    ][$available]['namespace'],
                                );
                            }
                            $val =
                                $this->collection->getDefaultNamespace() .
                                $this->directory .
                                $this->matchedRouteOptions['alternate-content'][
                                    $available
                                ]['controller-method'];

                            // no need to continue loop as $val has been overwritten
                            break;
                        }
                    }
                }

                // Are we using the default method for back-references?

                // Support resource route when function with subdirectory
                // ex: $routes->resource('Admin/Admins');
                if (
                    str_contains($val, '$') &&
                    str_contains($key, '(') &&
                    str_contains($key, '/')
                ) {
                    $replacekey = str_replace('/(.*)', '', $key);
                    $val = preg_replace('#^' . $key . '$#u', $val, $uri);
                    $val = str_replace($replacekey, str_replace('/', '\\', $replacekey), $val);
                } elseif (str_contains($val, '$') && str_contains($key, '(')) {
                    $val = preg_replace('#^' . $key . '$#u', $val, $uri);
                } elseif (str_contains($val, '/')) {
                    [$controller, $method] = explode('::', $val);

                    // Only replace slashes in the controller, not in the method.
                    $controller = str_replace('/', '\\', $controller);

                    $val = $controller . '::' . $method;
                }

                $this->setRequest(explode('/', $val));

                $this->matchedRoute = [$matchedKey, $val];

                return true;
            }
        }

        return false;
    }

    //--------------------------------------------------------------------
}
