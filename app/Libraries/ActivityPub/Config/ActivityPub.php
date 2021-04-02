<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Config;

use CodeIgniter\Config\BaseConfig;

class ActivityPub extends BaseConfig
{
    /**
     * --------------------------------------------------------------------
     * ActivityPub Objects
     * --------------------------------------------------------------------
     */
    public $actorObject = 'ActivityPub\Objects\ActorObject';
    public $noteObject = 'ActivityPub\Objects\NoteObject';
}
