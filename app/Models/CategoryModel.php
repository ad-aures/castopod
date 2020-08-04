<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'parent_id',
        'code',
        'apple_category',
        'google_category',
    ];

    protected $returnType = \App\Entities\Category::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    public function findParent($parentId)
    {
        return $this->find($parentId);
    }
}
