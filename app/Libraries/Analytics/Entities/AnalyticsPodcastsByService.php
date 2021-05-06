<?php

/**
 * Class AnalyticsPodcastsByService
 * Entity for AnalyticsPodcastsByService
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Entities;

use datetime;
use Opawg\UserAgentsPhp\UserAgentsRSS;
use CodeIgniter\Entity\Entity;

class AnalyticsPodcastsByService extends Entity
{
    /**
     * @var string
     */
    protected $labels;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'podcast_id' => 'integer',
        'app' => '?string',
        'device' => '?string',
        'os' => '?string',
        'is_bot' => 'boolean',
        'date' => 'datetime',
        'hits' => 'integer',
    ];

    public function getLabels()
    {
        return UserAgentsRSS::getName($this->attributes['labels']) ??
            $this->attributes['labels'];
    }
}
