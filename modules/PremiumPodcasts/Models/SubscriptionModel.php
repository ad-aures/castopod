<?php

declare(strict_types=1);

/**
 * Class SoundbiteModel Model for podcasts_soundbites table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\PremiumPodcasts\Models;

use CodeIgniter\Model;
use Modules\PremiumPodcasts\Entities\Subscription;

class SubscriptionModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'subscriptions';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var list<string>
     */
    protected $allowedFields = [
        'id',
        'podcast_id',
        'email',
        'token',
        'status',
        'status_message',
        'expires_at',
        'created_by',
        'updated_by',
    ];

    protected $returnType = Subscription::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var list<string>
     */
    protected $afterInsert = ['clearCache'];

    /**
     * @var list<string>
     */
    protected $afterUpdate = ['clearCache'];

    /**
     * @var list<string>
     */
    protected $beforeDelete = ['clearCache'];

    public function getSubscriptionById(int $subscriptionId): ?Subscription
    {
        $cacheName = "subscription#{$subscriptionId}";
        if (! ($found = cache($cacheName))) {
            $found = $this->find($subscriptionId);

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * @return Subscription[]
     */
    public function getPodcastSubscriptions(int $podcastId): array
    {
        $cacheName = "podcast#{$podcastId}_subscriptions";
        if (! ($found = cache($cacheName))) {
            $found = $this->where('podcast_id', $podcastId)
                ->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * @param string $token plain-text token to be encrypted and matched against encrypted tokens in database
     */
    public function validateSubscription(int|string $podcastIdOrHandle, string $token): ?Subscription
    {
        $subscriptionModel = $this;

        if (is_int($podcastIdOrHandle)) {
            $this->where('id', $podcastIdOrHandle);
        } else {
            $this->select('subscriptions.*')
                ->where('handle', $podcastIdOrHandle)
                ->join('podcasts', 'podcasts.id = subscriptions.podcast_id');
        }

        return $subscriptionModel
            ->where([
                'token'  => hash('sha256', $token),
                'status' => 'active',
            ])
            ->groupStart()
            ->where('expires_at')
            ->orWhere('`expires_at` > UTC_TIMESTAMP()', null, false)
            ->groupEnd()
            ->first();
    }

    /**
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    protected function clearCache(array $data): array
    {
        /** @var ?Subscription */
        $subscription = new self()
            ->find(is_array($data['id']) ? $data['id'][0] : $data['id']);

        if (! $subscription instanceof Subscription) {
            return $data;
        }

        cache()
            ->delete("subscription#{$subscription->id}");
        cache()
            ->delete("podcast#{$subscription->podcast_id}_subscriptions");

        return $data;
    }
}
