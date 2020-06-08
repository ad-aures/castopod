<?php
/**
 * Class PlatformLinkModel
 * Model for platform links table in database
 * @author     Benjamin Bellamy <ben@podlibre.org>
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */
namespace App\Models;

use CodeIgniter\Model;

class PlatformLinkModel extends Model
{
    protected $table = 'platform_links';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'podcast_id',
        'platform_id',
        'link_url',
        'comment',
        'visible',
    ];

    protected $returnType = 'App\Entities\PlatformLink';
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
}