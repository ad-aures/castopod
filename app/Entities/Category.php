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
    /**
     * @var \App\Entity\Category|null
     */
    protected $parent;

    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'code' => 'string',
        'apple_category' => 'string',
        'google_category' => 'string',
    ];

    public function getParent()
    {
        $parentId = $this->attributes['parent_id'];

        return $parentId != 0
            ? (new CategoryModel())->findParent($parentId)
            : null;
    }
}
