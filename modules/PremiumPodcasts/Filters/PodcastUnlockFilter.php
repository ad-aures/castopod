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
use Override;

class PodcastUnlockFilter implements FilterInterface
{
    /**
     * Verifies that a user is logged in, or redirects to login.
     *
     * @param string[]|null $arguments
     *
     * @return RequestInterface|ResponseInterface|string|null
     */
    #[Override]
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! function_exists('is_unlocked')) {
            helper('premium_podcasts');
        }

        /** @var Router $router */
        $router = service('router');
        $routerParams = $router->params();

        if ($routerParams === []) {
            return null;
        }

        // no need to go through the unlock form if user is connected
        if (auth()->loggedIn()) {
            return null;
        }

        // Make sure this isn't already a premium podcast route
        if (url_is((string) route_to('premium-podcast-unlock', $routerParams[0]))) {
            return null;
        }

        // expect 2 parameters (podcast handle and episode slug)
        if (count($routerParams) < 2) {
            return null;
        }

        $episode = (new EpisodeModel())->getEpisodeBySlug($routerParams[0], $routerParams[1]);

        if (! $episode instanceof Episode) {
            return null;
        }

        // Make sure that public episodes are still accessible
        if (! $episode->is_premium) {
            return null;
        }

        // Episode should be embeddable even if it is premium
        if (url_is((string) route_to('embed', $episode->podcast->handle, $episode->slug))) {
            return null;
        }

        /** @var PremiumPodcasts $premiumPodcasts */
        $premiumPodcasts = service('premium_podcasts');
        if ($premiumPodcasts->check($routerParams[0])) {
            return null;
        }

        // podcast is locked, send to the unlock form
        session()
            ->set('redirect_url', current_url());

        return redirect()->route('premium-podcast-unlock', [$routerParams[0]]);
    }

    /**
     * @param list<string>|null $arguments
     *
     * @return ResponseInterface|null
     */
    #[Override]
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
