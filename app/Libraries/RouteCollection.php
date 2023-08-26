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

use Closure;
use CodeIgniter\Router\RouteCollection as CodeIgniterRouteCollection;

class RouteCollection extends CodeIgniterRouteCollection
{
    /**
     * The current hostname from $_SERVER['HTTP_HOST']
     */
    private ?string $httpHost = null;

    /**
     * Does the heavy lifting of creating an actual route. You must specify
     * the request method(s) that this route will work for. They can be separated
     * by a pipe character "|" if there is more than one.
     *
     * @param array<int, mixed>|Closure|string $to
     * @param array<string, mixed> $options
     */
    protected function create(string $verb, string $from, $to, ?array $options = null): void
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

            for ($i = (int) $options['offset'] + 1; $i < (int) $options['offset'] + 7; ++$i) {
                $to = preg_replace_callback('/\$X/', static fn ($m): string => '$' . $i, $to, 1);
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
                $to = trim((string) $namespace, '\\') . '\\' . $to;
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

    /**
     * Compares the hostname passed in against the current hostname
     * on this page request.
     *
     * @param string $hostname Hostname in route options
     */
    private function checkHostname($hostname): bool
    {
        // CLI calls can't be on hostname.
        if ($this->httpHost === null) {
            return false;
        }

        return strtolower($this->httpHost) === strtolower($hostname);
    }

    /**
     * @param array<int, mixed> $to
     *
     * @return string|array<int, mixed>
     */
    private function processArrayCallableSyntax(string $from, array $to): string | array
    {
        // [classname, method]
        // eg, [Home::class, 'index']
        if (is_callable($to, true, $callableName)) {
            // If the route has placeholders, add params automatically.
            $params = $this->getMethodParams($from);

            return '\\' . $callableName . $params;
        }

        // [[classname, method], params]
        // eg, [[Home::class, 'index'], '$1/$2']
        if (
            isset($to[0], $to[1])
            && is_callable($to[0], true, $callableName)
            && is_string($to[1])
        ) {
            return '\\' . $callableName . '/' . $to[1];
        }

        return $to;
    }

    /**
     * Compares the subdomain(s) passed in against the current subdomain
     * on this page request.
     *
     * @param string|string[] $subdomains
     */
    private function checkSubdomains($subdomains): bool
    {
        // CLI calls can't be on subdomain.
        if ($this->httpHost === null) {
            return false;
        }

        if ($this->currentSubdomain === null) {
            $this->currentSubdomain = $this->determineCurrentSubdomain();
        }

        if (! is_array($subdomains)) {
            $subdomains = [$subdomains];
        }

        // Routes can be limited to any sub-domain. In that case, though,
        // it does require a sub-domain to be present.
        if (! empty($this->currentSubdomain) && in_array('*', $subdomains, true)) {
            return true;
        }

        return in_array($this->currentSubdomain, $subdomains, true);
    }

    /**
     * Returns the method param string like `/$1/$2` for placeholders
     */
    private function getMethodParams(string $from): string
    {
        preg_match_all('/\(.+?\)/', $from, $matches);
        $count = is_countable($matches[0]) ? count($matches[0]) : 0;

        $params = '';

        for ($i = 1; $i <= $count; ++$i) {
            $params .= '/$' . $i;
        }

        return $params;
    }

    /**
     * Examines the HTTP_HOST to get the best match for the subdomain. It
     * won't be perfect, but should work for our needs.
     *
     * It's especially not perfect since it's possible to register a domain
     * with a period (.) as part of the domain name.
     *
     * @return false|string the subdomain
     */
    private function determineCurrentSubdomain()
    {
        // We have to ensure that a scheme exists
        // on the URL else parse_url will mis-interpret
        // 'host' as the 'path'.
        $url = $this->httpHost;
        if (strpos($url, 'http') !== 0) {
            $url = 'http://' . $url;
        }

        $parsedUrl = parse_url($url);

        $host = explode('.', $parsedUrl['host']);

        if ($host[0] === 'www') {
            unset($host[0]);
        }

        // Get rid of any domains, which will be the last
        unset($host[count($host) - 1]);

        // Account for .co.uk, .co.nz, etc. domains
        if (end($host) === 'co') {
            $host = array_slice($host, 0, -1);
        }

        // If we only have 1 part left, then we don't have a sub-domain.
        if (count($host) === 1) {
            // Set it to false so we don't make it back here again.
            return false;
        }

        return array_shift($host);
    }
}
