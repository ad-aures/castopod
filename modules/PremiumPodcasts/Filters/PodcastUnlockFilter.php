<?php

declare(strict_types=1);

namespace Modules\PremiumPodcasts\Filters;

use App\Models\EpisodeModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Router\Router;
use Config\App;
use Modules\PremiumPodcasts\PremiumPodcasts;
use Myth\Auth\Authentication\AuthenticationBase;

class PodcastUnlockFilter implements FilterInterface
{
    /**
     * Verifies that a user is logged in, or redirects to login.
     *
     * @param array|null $params
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $params = null)
    {
        if (! function_exists('is_unlocked')) {
            helper('premium_podcasts');
        }

        $current = (string) current_url(true)
            ->setHost('')
            ->setScheme('')
            ->stripQuery('token');

        $config = config(App::class);
        if ($config->forceGlobalSecureRequests) {
            // Remove "https:/"
            $current = substr($current, 7);
        }

        /** @var Router $router */
        $router = service('router');
        $routerParams = $router->params();

        if ($routerParams === []) {
            return;
        }

        // no need to go through the unlock form if user is connected
        /** @var AuthenticationBase $auth */
        $auth = service('authentication');
        if ($auth->isLoggedIn()) {
            return;
        }

        // Make sure this isn't already a premium podcast route
        if ($current === route_to('premium-podcast-unlock', $routerParams[0])) {
            return;
        }

        // Make sure that public episodes are still accessible
        if ($routerParams >= 2 && ($episode = (new EpisodeModel())->getEpisodeBySlug(
            $routerParams[0],
            $routerParams[1]
        )) && ! $episode->is_premium) {
            return;
        }

        // Episode should be embeddable even if it is premium
        if ($current === route_to('embed', $episode->podcast->handle, $episode->slug)) {
            return;
        }

        // if podcast is locked then send to the unlock form
        /** @var PremiumPodcasts $premiumPodcasts */
        $premiumPodcasts = service('premium_podcasts');
        if (! $premiumPodcasts->check($routerParams[0])) {
            session()->set('redirect_url', current_url());

            return redirect()->route('premium-podcast-unlock', [$routerParams[0]]);
        }
    }

    /**
     * @param array|null $arguments
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {
    }
}
