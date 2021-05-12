<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use RuntimeException;
use App\Models\PodcastModel;
use Myth\Auth\Entities\User as MythAuthUser;

/**
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property bool $active
 * @property bool $force_pass_reset
 * @property int|null $podcast_id
 * @property string|null $podcast_role
 *
 * @property Podcast[] $podcasts All podcasts the user is contributing to
 */
class User extends MythAuthUser
{
    /**
     * @var Podcast[]
     */
    protected $podcasts = [];

    /**
     * Array of field names and the type of value to cast them as
     * when they are accessed.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'active' => 'boolean',
        'force_pass_reset' => 'boolean',
        'podcast_id' => '?integer',
        'podcast_role' => '?string',
    ];

    /**
     * Returns the podcasts the user is contributing to
     *
     * @return Podcast[]
     */
    public function getPodcasts(): array
    {
        if ($this->id === null) {
            throw new RuntimeException(
                'Users must be created before getting podcasts.',
            );
        }

        if ($this->podcasts === null) {
            $this->podcasts = (new PodcastModel())->getUserPodcasts($this->id);
        }

        return $this->podcasts;
    }
}
