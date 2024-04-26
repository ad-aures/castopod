<?php

declare(strict_types=1);

namespace Modules\PremiumPodcasts\Filters;

use App\Entities\Episode;
use App\Models\EpisodeModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Router\Router;
use Modules\PremiumPodcasts\PremiumPodcasts;

class PodcastUnlockFilter implements FilterInterface
{
    /**
     * Verifies that a user is logged in, or redirects to login.
     *
     * @param string[]|null $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! function_exists('is_unlocked')) {
            helper('premium_podcasts');
        }

        /** @var Router $router */
        $router = service('router');
        $routerParams = $router->params();

        if ($routerParams === []) {
            return;
        }

        // no need to go through the unlock form if user is connected
        if (auth()->loggedIn()) {
            return;
        }

        // Make sure this isn't already a premium podcast route
        if (url_is((string) route_to('premium-podcast-unlock', $routerParams[0]))) {
            return;
        }

        // expect 2 parameters (podcast handle and episode slug)
        if (count($routerParams) < 2) {
            return;
        }

        $episode = (new EpisodeModel())->getEpisodeBySlug($routerParams[0], $routerParams[1]);

        if (! $episode instanceof Episode) {
            return;
        }

        // Make sure that public episodes are still accessible
        if (! $episode->is_premium) {
            return;
        }

        // Episode should be embeddable even if it is premium
        if (url_is((string) route_to('embed', $episode->podcast->handle, $episode->slug))) {
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
     * @param string[]|null $arguments
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {
    }
}
