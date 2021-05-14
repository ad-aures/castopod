<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Page;
use CodeIgniter\Model;

class PageModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'pages';
    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected $allowedFields = ['id', 'title', 'slug', 'content'];

    /**
     * @var string
     */
    protected $returnType = Page::class;
    /**
     * @var bool
     */
    protected $useSoftDeletes = true;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var array<string, string>
     */
    protected $validationRules = [
        'title' => 'required',
        'slug' =>
            'required|regex_match[/^[a-zA-Z0-9\-]{1,191}$/]|is_unique[pages.slug,id,{id}]',
        'content' => 'required',
    ];

    /**
     * @var string[]
     */
    protected $afterInsert = ['clearCache'];

    /**
     * Before update because slug or title might change
     *
     * @var string[]
     */
    protected $beforeUpdate = ['clearCache'];

    /**
     * @var string[]
     */
    protected $beforeDelete = ['clearCache'];

    /**
     * @param mixed[] $data
     *
     * @return array<string, array<string|int, mixed>>
     */
    protected function clearCache(array $data): array
    {
        // Clear the cache of all pages
        cache()->deleteMatching('page*');

        return $data;
    }
}
