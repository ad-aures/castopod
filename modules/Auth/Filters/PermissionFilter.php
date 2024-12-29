<?php

declare(strict_types=1);

namespace Modules\Auth\Filters;

use App\Entities\Podcast;
use App\Models\PodcastModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Override;
use RuntimeException;

/**
 * Permission Authorization Filter.
 */
class PermissionFilter implements FilterInterface
{
    /**
     * @param string[]|null $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    #[Override]
    public function before(RequestInterface $request, $arguments = null)
    {
        if ($arguments === null || $arguments === []) {
            return;
        }

        if (! auth()->loggedIn()) {
            return redirect()->route('login');
        }

        if ($this->isAuthorized($arguments)) {
            return;
        }

        throw new RuntimeException(lang('Auth.notEnoughPrivilege'), 403);
    }

    /**
     * @param string[]|null $arguments
     */
    #[Override]
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {
    }

    /**
     * Ensures the user is logged in and has one or more
     * of the permissions as specified in the filter.
     *
     * @param string[] $arguments
     */
    protected function isAuthorized(array $arguments): bool
    {
        $result = true;

        foreach ($arguments as $permission) {
            // is permission specific to a podcast?
            if (str_contains($permission, '$')) {
                $router = service('router');
                $routerParams = $router->params();

                if (! preg_match('/\$(\d+)\./', $permission, $match)) {
                    throw new RuntimeException(sprintf(
                        'Could not get podcast identifier from permission %s',
                        $permission
                    ), 1);
                }

                $paramKey = ((int) $match[1]) - 1;
                if (! array_key_exists($paramKey, $routerParams)) {
                    throw new RuntimeException(sprintf('Router param does not exist at key %s', $match[1]), 1);
                }

                $podcastParam = $routerParams[$paramKey];

                // get podcast id
                $podcastId = null;
                if (is_numeric($podcastParam)) {
                    $podcastId = (int) $podcastParam;
                } else {
                    $podcast = (new PodcastModel())->getPodcastByHandle($podcastParam);
                    if ($podcast instanceof Podcast) {
                        $podcastId = $podcast->id;
                    }
                }

                if ($podcastId !== null) {
                    $permission = str_replace('$' . $match[1], '#' . $podcastId, $permission);
                }
            }

            $result = $result && auth()
                ->user()
                ->can($permission);
        }

        return $result;
    }
}
