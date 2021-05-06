<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Credit;
use CodeIgniter\Model;

class CreditModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'credits';

    /**
     * @var string
     */
    protected $returnType = Credit::class;
}
