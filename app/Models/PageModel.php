<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
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
     * @var list<string>
     */
    protected $allowedFields = ['id', 'title', 'slug', 'content_markdown', 'content_html'];

    /**
     * @var class-string<Page>
     */
    protected $returnType = Page::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var array<string, string>
     */
    protected $validationRules = [
        'title'            => 'required',
        'slug'             => 'required|regex_match[/^[a-zA-Z0-9\-]{1,128}$/]|is_unique[pages.slug,id,{id}]',
        'content_markdown' => 'required',
    ];

    /**
     * @var list<string>
     */
    protected $afterInsert = ['clearCache'];

    /**
     * Before update because slug or title might change
     *
     * @var list<string>
     */
    protected $beforeUpdate = ['clearCache'];

    /**
     * @var list<string>
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
        cache()
            ->deleteMatching('page*');

        return $data;
    }
}
