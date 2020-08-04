<?php

/**
 * Class UnknownUserAgentsModel
 * Model for analytics_unknown_useragents table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class UnknownUserAgentsModel extends Model
{
    protected $table = 'analytics_unknown_useragents';

    protected $allowedFields = [];

    public function getUserAgents($last_known_id = 0)
    {
        return $this->where('id >', $last_known_id)->findAll();
    }
}
