<?php

declare(strict_types=1);

/**
 * Class AnalyticsPodcastsByPlayer Entity for AnalyticsPodcastsByPlayer
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int $podcast_id
 * @property string|null $app
 * @property string|null $device
 * @property string|null $os
 * @property bool $is_bot
 * @property Time $date
 * @property int $hits
 * @property Time $created_at
 * @property Time $updated_at
 */
class AnalyticsPodcastsByPlayer extends Entity
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
}
