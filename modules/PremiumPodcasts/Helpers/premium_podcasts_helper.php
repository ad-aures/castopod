<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use Modules\PremiumPodcasts\Entities\Subscription;
use Modules\PremiumPodcasts\PremiumPodcasts;

if (! function_exists('is_podcast_unlocked')) {
    function is_unlocked(string $podcastHandle): bool
    {
        /** @var PremiumPodcasts $premiumPodcast */
        $premiumPodcast = service('premium_podcasts');
        return $premiumPodcast->check($podcastHandle);
    }
}

if (! function_exists('subscription')) {
    /**
     * Returns the Subscription instance for the currently active subscription.
     */
    function subscription(string $podcastHandle): ?Subscription
    {
        /** @var PremiumPodcasts $premiumPodcast */
        $premiumPodcast = service('premium_podcasts');
        $premiumPodcast->check($podcastHandle);

        return $premiumPodcast->subscription($podcastHandle);
    }
}
