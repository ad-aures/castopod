<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class LanguageModel extends Model
{
    protected $table = 'languages';
    protected $primaryKey = 'id';

    protected $allowedFields = ['code', 'native_name'];

    protected $returnType = 'App\Entities\Language';
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
}
