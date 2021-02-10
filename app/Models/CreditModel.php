<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class CreditModel extends Model
{
    protected $table = 'credits';

    protected $allowedFields = [];

    protected $returnType = \App\Entities\Credit::class;
}
