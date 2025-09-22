<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\PremiumPodcasts\Entities;

use App\Entities\Podcast;
use App\Models\PodcastModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use Modules\Analytics\Models\AnalyticsPodcastBySubscriptionModel;

/**
 * @property int $id
 * @property int $podcast_id
 * @property Podcast|null $podcast
 * @property string $email
 * @property string $token
 * @property string $status
 * @property string|null $status_message
 * @property Time $expires_at
 * @property int $downloads_last_3_months
 *
 * @property int $created_by
 * @property int $updated_by
 * @property Time $created_at
 * @property Time $updated_at
 */
class Subscription extends Entity
{
    protected ?Podcast $podcast = null;

    /**
     * @var list<string>
     */
    protected $dates = ['expires_at', 'created_at', 'updated_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id'             => 'integer',
        'podcast_id'     => 'integer',
        'email'          => 'string',
        'token'          => 'string',
        'status'         => 'string',
        'status_message' => '?string',
        'created_by'     => 'integer',
        'updated_by'     => 'integer',
    ];

    public function getStatus(): string
    {
        return $this->expires_at->isBefore(Time::now()) ? 'expired' : $this->attributes['status'];
    }

    /**
     * Suspend a subscription.
     *
     * @return $this
     */
    public function suspend(string $reason): static
    {
        $this->attributes['status'] = 'suspended';
        $this->attributes['status_message'] = $reason;

        return $this;
    }

    /**
     * Resumes a subscription / unSuspend.
     *
     * @return $this
     */
    public function resume(): static
    {
        $this->attributes['status'] = 'active';
        $this->attributes['status_message'] = null;

        return $this;
    }

    /**
     * Checks to see if a subscription has been suspended.
     */
    public function isSuspended(): bool
    {
        return isset($this->attributes['status']) && $this->attributes['status'] === 'suspended';
    }

    /**
     * Returns the subscription's podcast
     */
    public function getPodcast(): ?Podcast
    {
        if (! $this->podcast instanceof Podcast) {
            $this->podcast = new PodcastModel()
                ->getPodcastById($this->podcast_id);
        }

        return $this->podcast;
    }

    public function getDownloadsLast3Months(): int
    {
        return new AnalyticsPodcastBySubscriptionModel()
            ->getNumberOfDownloadsLast3Months($this->podcast_id, $this->id);
    }
}
