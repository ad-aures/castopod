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

    public function getCategoryOptions()
    {
        if (!($options = cache('category_options'))) {
            $categories = $this->findAll();

            $options = array_reduce(
                $categories,
                function ($result, $category) {
                    $result[$category->id] = lang(
                        'Podcast.category_options.' . $category->code
                    );
                    return $result;
                },
                []
            );

            cache()->save('category_options', $options, DECADE);
        }

        return $options;
    }

    /**
     * Sets categories for a given podcast
     *
     * @param int $podcastId
     * @param array $categories
     *
     * @return integer|false Number of rows inserted or FALSE on failure
     */
    public function setPodcastCategories($podcastId, $categories)
    {
        cache()->delete("podcasts{$podcastId}_categories");

        // Remove already previously set categories to overwrite them
        $this->db
            ->table('podcasts_categories')
            ->delete(['podcast_id' => $podcastId]);

        if (!empty($categories)) {
            // prepare data for `podcasts_categories` table
            $data = array_reduce(
                $categories,
                function ($result, $categoryId) use ($podcastId) {
                    $result[] = [
                        'podcast_id' => $podcastId,
                        'category_id' => $categoryId,
                    ];

                    return $result;
                },
                []
            );

            // Set podcast categories
            return $this->db->table('podcasts_categories')->insertBatch($data);
        }

        // no row has been inserted after deletion
        return 0;
    }

    /**
     * Gets all the podcast categories
     *
     * @param int $podcastId
     *
     * @return \App\Entities\Category[]
     */
    public function getPodcastCategories($podcastId)
    {
        if (!($categories = cache("podcasts{$podcastId}_categories"))) {
            $categories = $this->select('categories.*')
                ->join(
                    'podcasts_categories',
                    'podcasts_categories.category_id = categories.id'
                )
                ->where('podcasts_categories.podcast_id', $podcastId)
                ->findAll();

            cache()->save(
                "podcasts{$podcastId}_categories",
                $categories,
                DECADE
            );
        }

        return $categories;
    }
}
