<?php

declare(strict_types=1);

namespace Modules\PremiumPodcasts\Config;

use Config\Services as BaseService;
use Modules\PremiumPodcasts\Models\SubscriptionModel;
use Modules\PremiumPodcasts\PremiumPodcasts;

class Services extends BaseService
{
    public static function premium_podcasts(?SubscriptionModel $subscriptionModel = null, bool $getShared = true)
    {
        if ($getShared) {
            return self::getSharedInstance('premium_podcasts', $subscriptionModel);
        }

        $premiumPodcasts = new PremiumPodcasts();

        $subscriptionModel ??= model(SubscriptionModel::class);

        return $premiumPodcasts
            ->setSubscriptionModel($subscriptionModel);
    }
}
