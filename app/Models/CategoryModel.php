<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Category;
use CodeIgniter\Model;

class CategoryModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var list<string>
     */
    protected $allowedFields = ['parent_id', 'code', 'apple_category', 'google_category'];

    /**
     * @var class-string<Category>
     */
    protected $returnType = Category::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    public function getCategoryById(int $id): ?Category
    {
        return $this->find($id);
    }

    /**
     * @return array<int, string>
     */
    public function getCategoryOptions(): array
    {
        $locale = service('request')
            ->getLocale();
        $cacheName = "category_options_{$locale}";

        if (! ($options = cache($cacheName))) {
            $categories = $this->findAll();

            $options = array_reduce(
                $categories,
                static function (array $result, Category $category): array {
                    $label = '';
                    if ($category->parent instanceof Category) {
                        $label = lang('Podcast.category_options.' . $category->parent->code) . ' › ';
                    }

                    $label .= lang('Podcast.category_options.' . $category->code);

                    $result[] = [
                        'value' => $category->id,
                        'label' => $label,
                    ];
                    return $result;
                },
                [],
            );

            cache()
                ->save($cacheName, $options, DECADE);
        }

        return $options;
    }

    /**
     * Sets categories for a given podcast
     *
     * @param int[] $categoriesIds
     *
     * @return int|false Number of rows inserted or FALSE on failure
     */
    public function setPodcastCategories(int $podcastId, array $categoriesIds = []): int | false
    {
        cache()->delete("podcast#{$podcastId}_categories");

        // Remove already previously set categories to overwrite them
        $this->db
            ->table('podcasts_categories')
            ->delete([
                'podcast_id' => $podcastId,
            ]);

        if ($categoriesIds === []) {
            // no row has been inserted after deletion
            return 0;
        }

        // prepare data for `podcasts_categories` table
        $data = array_reduce(
            $categoriesIds,
            static function (array $result, int $categoryId) use ($podcastId): array {
                $result[] = [
                    'podcast_id'  => $podcastId,
                    'category_id' => $categoryId,
                ];
                return $result;
            },
            [],
        );

        // Set podcast categories
        return $this->db->table('podcasts_categories')
            ->insertBatch($data);
    }

    /**
     * Gets all the podcast categories
     *
     * @return Category[]
     */
    public function getPodcastCategories(int $podcastId): array
    {
        $cacheName = "podcast#{$podcastId}_categories";
        if (! ($categories = cache($cacheName))) {
            $categories = $this->select('categories.*')
                ->join('podcasts_categories', 'podcasts_categories.category_id = categories.id')
                ->where('podcasts_categories.podcast_id', $podcastId)
                ->findAll();

            cache()
                ->save($cacheName, $categories, DECADE);
        }

        return $categories;
    }
}
