<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Config;

use CodeIgniter\Config\BaseConfig;
use Modules\Fediverse\Objects\ActorObject;
use Modules\Fediverse\Objects\NoteObject;

class Fediverse extends BaseConfig
{
    /**
     * --------------------------------------------------------------------
     * Fediverse Objects
     * --------------------------------------------------------------------
     */
    public string $actorObject = ActorObject::class;

    public string $noteObject = NoteObject::class;

    /**
     * --------------------------------------------------------------------
     * Default avatar and cover images
     * --------------------------------------------------------------------
     */
    public string $defaultAvatarImagePath = 'avatar-default.jpg';

    public string $defaultAvatarImageMimetype = 'image/jpeg';

    public string $defaultCoverImagePath = 'banner-default.jpg';

    public string $defaultCoverImageMimetype = 'image/jpeg';

    /**
     * --------------------------------------------------------------------
     * Cache options
     * --------------------------------------------------------------------
     */
    public string $cachePrefix = 'ap_';
}
