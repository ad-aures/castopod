<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int $podcast_id
 * @property int $episode_id
 * @property int $subscription_id
 * @property Time $date
 * @property int $hits
 * @property Time $created_at
 * @property Time $updated_at
 */
class AnalyticsPodcastsBySubscription extends Entity
{
    /**
     * @var string[]
     */
    protected $dates = ['date', 'created_at', 'updated_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'podcast_id'      => 'integer',
        'episode_id'      => 'integer',
        'subscription_id' => 'integer',
        'hits'            => 'integer',
    ];
}
