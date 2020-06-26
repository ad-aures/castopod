<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\CategoryModel;
use CodeIgniter\Entity;

class Category extends Entity
{
    protected $parent;

    protected $casts = [
        'parent_id' => 'integer',
        'code' => 'string',
        'apple_category' => 'string',
        'google_category' => 'string',
    ];

    public function getParent()
    {
        $category_model = new CategoryModel();
        $parent_id = $this->attributes['parent_id'];

        return $parent_id != 0
            ? $category_model->find($this->attributes['parent_id'])
            : null;
    }
}
