<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
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
    public string $defaultAvatarImagePath = 'media/castopod-avatar-default_thumbnail.jpg';

    public string $defaultAvatarImageMimetype = 'image/jpeg';

    public string $defaultCoverImagePath = 'media/castopod-cover-default.jpg';

    public string $defaultCoverImageMimetype = 'image/jpeg';

    public string $tablesPrefix = 'fediverse_';

    /**
     * --------------------------------------------------------------------
     * Cache options
     * --------------------------------------------------------------------
     */
    public string $cachePrefix = 'ap_';
}
