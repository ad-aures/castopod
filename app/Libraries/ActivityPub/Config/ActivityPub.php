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
     * @var string
     */
    public $actorObject = ActorObject::class;

    /**
     * @var string
     */
    public $noteObject = NoteObject::class;

    /**
     * --------------------------------------------------------------------
     * Default avatar and cover images
     * --------------------------------------------------------------------
     * @var string
     */
    public $defaultAvatarImagePath = 'assets/images/avatar-default.jpg';

    /**
     * @var string
     */
    public $defaultAvatarImageMimetype = 'image/jpeg';

    /**
     * @var string
     */
    public $defaultCoverImagePath = 'assets/images/cover-default.jpg';

    /**
     * @var string
     */
    public $defaultCoverImageMimetype = 'image/jpeg';

    /**
     * --------------------------------------------------------------------
     * Cache options
     * --------------------------------------------------------------------
     * @var string
     */
    public $cachePrefix = 'ap_';
}
