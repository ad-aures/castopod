<?php

declare(strict_types=1);

namespace App\Filters;

use App\Models\PodcastModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Myth\Auth\Exceptions\PermissionException;

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
        helper('auth');

        if ($params === null) {
            return;
        }

        $authenticate = Services::authentication();

        // if no user is logged in then send to the login form
        if (! $authenticate->check()) {
            session()->set('redirect_url', current_url());
            return redirect('login');
        }

        helper('misc');
        $authorize = Services::authorization();
        $router = Services::router();
        $routerParams = $router->params();
        $result = false;

        // Check if user has at least one of the permissions
        foreach ($params as $permission) {
            // check if permission is for a specific podcast
            if (
                (str_starts_with($permission, 'podcast-') ||
                    str_starts_with($permission, 'podcast_episodes-')) &&
                $routerParams !== []
            ) {
                if (
                    ($groupId = (new PodcastModel())->getContributorGroupId(
                        $authenticate->id(),
                        $routerParams[0],
                    )) &&
                    $authorize->groupHasPermission($permission, $groupId)
                ) {
                    $result = true;
                    break;
                }
            } elseif (
                $authorize->hasPermission($permission, $authenticate->id())
            ) {
                $result = true;
                break;
            }
        }

        if (! $result) {
            if ($authenticate->silent()) {
                $redirectURL = session('redirect_url') ?? '/';
                unset($_SESSION['redirect_url']);
                return redirect()
                    ->to($redirectURL)
                    ->with('error', lang('Auth.notEnoughPrivilege'));
            }
            throw new PermissionException(lang('Auth.notEnoughPrivilege'));
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
