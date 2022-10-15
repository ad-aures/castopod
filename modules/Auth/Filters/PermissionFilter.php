<?php

declare(strict_types=1);

namespace Modules\Auth\Filters;

use App\Models\PodcastModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Exceptions\RuntimeException;
use Config\Services;

class PermissionFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do. By default it should not return anything during normal execution.
     * However, when an abnormal state is found, it should return an instance of CodeIgniter\HTTP\Response. If it does,
     * script execution will end and that Response will be sent back to the client, allowing for error pages, redirects,
     * etc.
     *
     * @param string[]|null                         $params
     * @return void|mixed
     */
    public function before(RequestInterface $request, $params = null)
    {
        if (empty($params)) {
            return;
        }

        if (! function_exists('auth')) {
            helper('auth');
        }

        if (! auth()->loggedIn()) {
            return redirect()->to('login');
        }

        $result = true;

        foreach ($params as $permission) {
            // does permission is specific to a podcast?
            if (str_contains($permission, '#')) {
                $router = Services::router();
                $routerParams = $router->params();

                // get podcast id
                $podcastId = null;
                if (is_numeric($routerParams[0])) {
                    $podcastId = (int) $routerParams[0];
                } else {
                    $podcast = (new PodcastModel())->getPodcastByHandle($routerParams[0]);
                    if ($podcast !== null) {
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

        if (! $result) {
            throw new RuntimeException(lang('Auth.notEnoughPrivilege'), 403);
        }
    }

    //--------------------------------------------------------------------

    /**
     * Allows After filters to inspect and modify the response object as needed. This method does not allow any way to
     * stop execution of other after filters, short of throwing an Exception or Error.
     *
     * @param string[]|null                          $arguments
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {
    }

    //--------------------------------------------------------------------
}
