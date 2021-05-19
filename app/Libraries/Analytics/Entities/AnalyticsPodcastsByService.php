<?php

/**
 * Class AnalyticsPodcastsByService Entity for AnalyticsPodcastsByService
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Entities;

use CodeIgniter\Entity\Entity;
use Opawg\UserAgentsPhp\UserAgentsRSS;

/**
 * @property int $podcast_id
 * @property string $app
 * @property string|null $device
 * @property string|null $os
 * @property bool $is_bot
 * @property Time $date
 * @property int $hits
 * @property string $labels
 * @property Time $created_at
 * @property Time $updated_at
 */
class AnalyticsPodcastsByService extends Entity
{
    /**
     * @var string[]
     */
    protected $dates = ['date', 'created_at', 'updated_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'podcast_id' => 'integer',
        'app' => '?string',
        'device' => '?string',
        'os' => '?string',
        'is_bot' => 'boolean',
        'hits' => 'integer',
    ];

    public function getLabels(): string
    {
        return UserAgentsRSS::getName($this->attributes['labels']) ??
            $this->attributes['labels'];
    }
}
