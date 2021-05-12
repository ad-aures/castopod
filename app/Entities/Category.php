<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\CategoryModel;
use CodeIgniter\Entity\Entity;

/**
 * @property int $id
 * @property int $parent_id
 * @property Category|null $parent
 * @property string $code
 * @property string $apple_category
 * @property string $google_category
 */
class Category extends Entity
{
    /**
     * @var Category|null
     */
    protected $parent;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => '?integer',
        'code' => 'string',
        'apple_category' => 'string',
        'google_category' => 'string',
    ];

    public function getParent(): ?Category
    {
        if (empty($this->parent_id)) {
            return null;
        }

        return (new CategoryModel())->getCategoryById($this->parent_id);
    }
}
