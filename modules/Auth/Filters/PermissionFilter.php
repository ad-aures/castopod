<?php

declare(strict_types=1);

namespace Modules\Auth\Filters;

use App\Entities\Podcast;
use App\Models\PodcastModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use RuntimeException;

/**
 * Permission Authorization Filter.
 */
class PermissionFilter implements FilterInterface
{
    /**
     * @param string[]|null $arguments
     * @return mixed
     */
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
     * @return mixed
     */
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
            if (str_contains($permission, '#')) {
                $router = Services::router();
                $routerParams = $router->params();

                // get podcast id
                $podcastId = null;
                if (is_numeric($routerParams[0])) {
                    $podcastId = (int) $routerParams[0];
                } else {
                    $podcast = (new PodcastModel())->getPodcastByHandle($routerParams[0]);
                    if ($podcast instanceof Podcast) {
                        $podcastId = $podcast->id;
                    }
                }

                if ($podcastId !== null) {
                    $permission = str_replace('#', '#' . $podcastId, $permission);
                }
            }

            $result = $result && auth()
                ->user()
                ->can($permission);
        }

        return $result;
    }
}
