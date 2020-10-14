<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $table = 'pages';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'title', 'slug', 'content'];

    protected $returnType = \App\Entities\Page::class;
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $validationRules = [
        'title' => 'required',
        'slug' =>
            'required|regex_match[/^[a-zA-Z0-9\-]{1,191}$/]|is_unique[pages.slug,id,{id}]|not_in_protected_slugs',
        'content' => 'required',
    ];
    protected $validationMessages = [];

    // Before update because slug might change
    protected $beforeUpdate = ['clearCache'];
    protected $beforeDelete = ['clearCache'];

    protected function clearCache(array $data)
    {
        $page = (new PageModel())->find(
            is_array($data['id']) ? $data['id'][0] : $data['id']
        );

        // delete page cache
        cache()->delete(md5($page->link));

        // Clear the cache of all podcast and episode pages
        // TODO: change the logic of page caching to prevent clearing all cache every time
        // cache()->clean();

        return $data;
    }
}
