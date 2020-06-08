<?php
/**
 * Class PlatformModel
 * Model for platforms table in database
 * @author     Benjamin Bellamy <ben@podlibre.org>
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */
namespace App\Models;

use CodeIgniter\Model;

class PlatformModel extends Model
{
    protected $table = 'platforms';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'home_url',
        'submit_url',
        'iosapp_url',
        'androidapp_url',
        'comment',
        'display_by_default',
        'ios_deeplink',
        'android_deeplink',
        'logo_file_name',
    ];

    protected $returnType = 'App\Entities\Platform';
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
}