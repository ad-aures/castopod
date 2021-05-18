<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Config;

use ActivityPub\Objects\ActorObject;
use ActivityPub\Objects\NoteObject;
use CodeIgniter\Config\BaseConfig;

class ActivityPub extends BaseConfig
{
    /**
     * --------------------------------------------------------------------
     * ActivityPub Objects
     * --------------------------------------------------------------------
     */
    public string $actorObject = ActorObject::class;

    public string $noteObject = NoteObject::class;

    /**
     * --------------------------------------------------------------------
     * Default avatar and cover images
     * --------------------------------------------------------------------
     */
    public string $defaultAvatarImagePath = 'assets/images/avatar-default.jpg';

    public string $defaultAvatarImageMimetype = 'image/jpeg';

    public string $defaultCoverImagePath = 'assets/images/cover-default.jpg';

    public string $defaultCoverImageMimetype = 'image/jpeg';

    /**
     * --------------------------------------------------------------------
     * Cache options
     * --------------------------------------------------------------------
     */
    public string $cachePrefix = 'ap_';
}
