<?php

declare(strict_types=1);

namespace Modules\PremiumPodcasts;

use CodeIgniter\Events\Events;
use Modules\PremiumPodcasts\Entities\Subscription;
use Modules\PremiumPodcasts\Models\SubscriptionModel;

class PremiumPodcasts
{
    protected SubscriptionModel $subscriptionModel;

    /**
     * @var array<string, Subscription|null>
     */
    protected $subscriptions = [];

    public function setSubscriptionModel(SubscriptionModel $subscriptionModel): self
    {
        $this->subscriptionModel = $subscriptionModel;

        return $this;
    }

    public function unlock(string $podcastHandle, string $token): bool
    {
        $subscription = $this->subscriptionModel->validateSubscription($podcastHandle, $token);

        if (! $subscription instanceof Subscription) {
            $this->subscriptions[$podcastHandle] = null;

            return false;
        }

        $this->subscriptions[$podcastHandle] = $subscription;

        $session = session();
        $session->set("{$podcastHandle}:subscription", $subscription);

        Events::trigger('unlock', $podcastHandle, $subscription);

        return true;
    }

    public function lock(string $podcastHandle): bool
    {
        if (! $this->isUnlocked($podcastHandle)) {
            return true;
        }

        $this->subscriptions[$podcastHandle] = null;

        unset($_SESSION["{$podcastHandle}:subscription"]);

        Events::trigger('lock', $podcastHandle);

        return true;
    }

    public function isUnlocked(string $podcastHandle): bool
    {
        if (array_key_exists(
            $podcastHandle,
            $this->subscriptions,
        ) && ($this->subscriptions[$podcastHandle] instanceof Subscription)) {
            return true;
        }

        if ($subscription = session()->get("{$podcastHandle}:subscription")) {
            $this->subscriptions[$podcastHandle] = $subscription;

            return true;
        }

        return false;
    }

    public function check(string $podcastHandle): bool
    {
        // check if locked, no need to go any further
        if (! $this->isUnlocked($podcastHandle)) {
            return false;
        }

        // Store the current subscription object
        $this->subscriptions[$podcastHandle] = $this->subscriptionModel->getSubscriptionById(
            $this->subscriptions[$podcastHandle]->id,
        );

        if (! $this->subscriptions[$podcastHandle] instanceof Subscription) {
            return false;
        }

        // lock podcast if subscription is not active
        if ($this->subscriptions[$podcastHandle]->status !== 'active') {
            $this->lock($podcastHandle);

            return false;
        }

        // All good!
        return true;
    }

    /**
     * Returns the Subscription instance for the current logged in user.
     */
    public function subscription(string $podcastHandle): ?Subscription
    {
        return $this->isUnlocked($podcastHandle) ? $this->subscriptions[$podcastHandle] : null;
    }
}
