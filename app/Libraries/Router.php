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

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Exceptions\RedirectException;
use CodeIgniter\Router\Exceptions\RouterException;
use CodeIgniter\Router\Router as CodeIgniterRouter;
use Config\Routing;
use Override;

class Router extends CodeIgniterRouter
{
    /**
     * Compares the uri string against the routes that the RouteCollection class defined for us, attempting to find a
     * match. This method will modify $this->controller, etal as needed.
     *
     * @param string $uri The URI path to compare against the routes
     *
     * @return boolean Whether the route was matched or not.
     */
    #[Override]
    protected function checkRoutes(string $uri): bool
    {
        $routes = $this->collection->getRoutes($this->collection->getHTTPVerb());

        // Don't waste any time
        if ($routes === []) {
            return false;
        }

        $uri = $uri === '/' ? $uri : trim($uri, '/ ');

        // Loop through the route array looking for wildcards
        foreach ($routes as $routeKey => $handler) {
            $routeKey = $routeKey === '/' ? $routeKey : ltrim((string) $routeKey, '/ ');

            $matchedKey = $routeKey;

            // Are we dealing with a locale?
            if (str_contains($routeKey, '{locale}')) {
                $routeKey = str_replace('{locale}', '[^/]+', $routeKey);
            }

            // Does the RegEx match?
            if (preg_match('#^' . $routeKey . '$#u', $uri, $matches)) {
                $this->matchedRouteOptions = $this->collection->getRoutesOptions($matchedKey);

                // Is this route supposed to redirect to another?
                if ($this->collection->isRedirect($routeKey)) {
                    // replacing matched route groups with references: post/([0-9]+) -> post/$1
                    $redirectTo = preg_replace_callback('/(\([^\(]+\))/', static function (): string {
                        static $i = 1;

                        return '$' . $i++;
                    }, (string) (is_array($handler) ? key($handler) : $handler));

                    throw new RedirectException(
                        preg_replace('#^' . $routeKey . '$#u', (string) $redirectTo, $uri),
                        $this->collection->getRedirectCode($routeKey),
                    );
                }

                // Store our locale so CodeIgniter object can
                // assign it to the Request.
                if (str_contains($matchedKey, '{locale}')) {
                    preg_match(
                        '#^' . str_replace('{locale}', '(?<locale>[^/]+)', $matchedKey) . '$#u',
                        $uri,
                        $matched,
                    );

                    if ($this->collection->shouldUseSupportedLocalesOnly()
                        && ! in_array($matched['locale'], config('App')->supportedLocales, true)) {
                        // Throw exception to prevent the autorouter, if enabled,
                        // from trying to find a route
                        throw PageNotFoundException::forLocaleNotSupported($matched['locale']);
                    }

                    $this->detectedLocale = $matched['locale'];
                    unset($matched);
                }

                // Are we using Closures? If so, then we need
                // to collect the params into an array
                // so it can be passed to the controller method later.
                if (! is_string($handler) && is_callable($handler)) {
                    $this->controller = $handler;

                    // Remove the original string from the matches array
                    array_shift($matches);

                    $this->params = $matches;

                    $this->setMatchedRoute($matchedKey, $handler);

                    return true;
                }

                // Is there an alternate content for the matchedRoute?

                // check if the alternate-content has been requested in the accept
                // header and overwrite the $val with the matching controller method
                if (
                    array_key_exists('alternate-content', $this->matchedRouteOptions) &&
                    is_array($this->matchedRouteOptions['alternate-content'])
                ) {
                    $request = service('request');
                    $negotiate = service('negotiator');

                    // Accept header is mandatory
                    if ($request->header('Accept') === null) {
                        break;
                    }

                    $acceptHeader = $request->header('Accept')
                        ->getValue();
                    $parsedHeader = $negotiate->parseHeader($acceptHeader);

                    $supported = array_keys($this->matchedRouteOptions['alternate-content']);

                    $expectedContentType = $parsedHeader[0];
                    foreach ($supported as $available) {
                        if (
                            ! $negotiate->callMatch($expectedContentType, $available, true)
                        ) {
                            continue;
                        }

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

                        $handler =
                            $this->collection->getDefaultNamespace() .
                            $this->directory .
                            $this->matchedRouteOptions['alternate-content'][
                                $available
                            ]['controller-method'];

                        // no need to continue loop as $handle has been overwritten
                        break;
                    }
                }

                // Are we using Closures? If so, then we need
                // to collect the params into an array
                // so it can be passed to the controller method later.
                if (! is_string($handler) && is_callable($handler)) {
                    $this->controller = $handler;

                    // Remove the original string from the matches array
                    array_shift($matches);

                    $this->params = $matches;

                    $this->setMatchedRoute($matchedKey, $handler);

                    return true;
                }

                if (str_contains((string) $handler, '::')) {
                    [$controller, $methodAndParams] = explode('::', (string) $handler);
                } else {
                    $controller = $handler;
                    $methodAndParams = '';
                }

                // Checks `/` in controller name
                if (str_contains((string) $controller, '/')) {
                    throw RouterException::forInvalidControllerName($handler);
                }

                if (str_contains((string) $handler, '$') && str_contains($routeKey, '(')) {
                    // Checks dynamic controller
                    if (str_contains((string) $controller, '$')) {
                        throw RouterException::forDynamicController($handler);
                    }

                    if (config(Routing::class)->multipleSegmentsOneParam === false) {
                        // Using back-references
                        $segments = explode(
                            '/',
                            (string) preg_replace('#\A' . $routeKey . '\z#u', (string) $handler, $uri),
                        );
                    } else {
                        if (str_contains($methodAndParams, '/')) {
                            [$method, $handlerParams] = explode('/', $methodAndParams, 2);
                            $params = explode('/', $handlerParams);
                            $handlerSegments = array_merge([$controller . '::' . $method], $params);
                        } else {
                            $handlerSegments = [$handler];
                        }

                        $segments = [];

                        foreach ($handlerSegments as $segment) {
                            $segments[] = $this->replaceBackReferences($segment, $matches);
                        }
                    }
                } else {
                    $segments = explode('/', (string) $handler);
                }

                $this->setRequest($segments);

                $this->setMatchedRoute($matchedKey, $handler);

                return true;
            }
        }

        return false;
    }

    //--------------------------------------------------------------------
}
