<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\CategoryModel;
use CodeIgniter\Entity\Entity;

/**
 * @property int $id
 * @property ?int $parent_id
 * @property Category|null $parent
 * @property string $code
 * @property string $apple_category
 * @property string $google_category
 */
class Category extends Entity
{
    protected ?Category $parent = null;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id'              => 'integer',
        'parent_id'       => '?integer',
        'code'            => 'string',
        'apple_category'  => 'string',
        'google_category' => 'string',
    ];

    public function getParent(): ?self
    {
        if ($this->parent_id === null) {
            return null;
        }

        return new CategoryModel()
            ->getCategoryById($this->parent_id);
    }
}
