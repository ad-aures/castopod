<?php

declare(strict_types=1);

/**
 * This file extends the Router class from the CodeIgniter 4 framework.
 *
 * It introduces the alternate-content option for a route.
 *
 * @copyright  2023 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use CodeIgniter\Router\RouteCollection as CodeIgniterRouteCollection;

class RouteCollection extends CodeIgniterRouteCollection
{
    /**
     * Does the heavy lifting of creating an actual route. You must specify
     * the request method(s) that this route will work for. They can be separated
     * by a pipe character "|" if there is more than one.
     *
     * @param array|Closure|string $to
     */
    protected function create(string $verb, string $from, $to, ?array $options = null)
    {
        $overwrite = false;
        $prefix = $this->group === null ? '' : $this->group . '/';

        $from = esc(strip_tags($prefix . $from));

        // While we want to add a route within a group of '/',
        // it doesn't work with matching, so remove them...
        if ($from !== '/') {
            $from = trim($from, '/');
        }

        // When redirecting to named route, $to is an array like `['zombies' => '\Zombies::index']`.
        if (is_array($to) && count($to) === 2) {
            $to = $this->processArrayCallableSyntax($from, $to);
        }

        $options = array_merge($this->currentOptions ?? [], $options ?? []);

        // Route priority detect
        if (isset($options['priority'])) {
            $options['priority'] = abs((int) $options['priority']);

            if ($options['priority'] > 0) {
                $this->prioritizeDetected = true;
            }
        }

        // Hostname limiting?
        if (! empty($options['hostname'])) {
            // @todo determine if there's a way to whitelist hosts?
            if (! $this->checkHostname($options['hostname'])) {
                return;
            }

            $overwrite = true;
        }
        // Limiting to subdomains?
        elseif (! empty($options['subdomain'])) {
            // If we don't match the current subdomain, then
            // we don't need to add the route.
            if (! $this->checkSubdomains($options['subdomain'])) {
                return;
            }

            $overwrite = true;
        }

        // Are we offsetting the binds?
        // If so, take care of them here in one
        // fell swoop.
        if (isset($options['offset']) && is_string($to)) {
            // Get a constant string to work with.
            $to = preg_replace('/(\$\d+)/', '$X', $to);

            for ($i = (int) $options['offset'] + 1; $i < (int) $options['offset'] + 7; $i++) {
                $to = preg_replace_callback('/\$X/', static fn ($m) => '$' . $i, $to, 1);
            }
        }

        // Replace our regex pattern placeholders with the actual thing
        // so that the Router doesn't need to know about any of this.
        foreach ($this->placeholders as $tag => $pattern) {
            $from = str_ireplace(':' . $tag, $pattern, $from);
        }

        // If is redirect, No processing
        if (! isset($options['redirect']) && is_string($to)) {
            // If no namespace found, add the default namespace
            if (strpos($to, '\\') === false || strpos($to, '\\') > 0) {
                $namespace = $options['namespace'] ?? $this->defaultNamespace;
                $to = trim($namespace, '\\') . '\\' . $to;
            }
            // Always ensure that we escape our namespace so we're not pointing to
            // \CodeIgniter\Routes\Controller::method.
            $to = '\\' . ltrim($to, '\\');
        }

        $name = $options['as'] ?? $from;

        helper('array');

        // Don't overwrite any existing 'froms' so that auto-discovered routes
        // do not overwrite any app/Config/Routes settings. The app
        // routes should always be the "source of truth".
        // this works only because discovered routes are added just prior
        // to attempting to route the request.

        // TODO: see how to overwrite routes differently
        // restored change that broke Castopod routing with fediverse
        // in CI4 v4.2.8 https://github.com/codeigniter4/CodeIgniter4/pull/6644
        if (isset($this->routes[$verb][$name]) && ! $overwrite) {
            return;
        }

        $this->routes[$verb][$name] = [
            'route' => [
                $from => $to,
            ],
        ];

        $this->routesOptions[$verb][$from] = $options;

        // Is this a redirect?
        if (isset($options['redirect']) && is_numeric($options['redirect'])) {
            $this->routes['*'][$name]['redirect'] = $options['redirect'];
        }
    }
}
