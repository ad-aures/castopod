<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Models;

use CodeIgniter\Database\BaseResult;
use CodeIgniter\Model;
use Modules\Fediverse\Entities\PreviewCard;

class PreviewCardModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'fediverse_preview_cards';

    /**
     * @var list<string>
     */
    protected $allowedFields = [
        'id',
        'url',
        'title',
        'description',
        'type',
        'author_name',
        'author_url',
        'provider_name',
        'provider_url',
        'image',
        'html',
    ];

    /**
     * @var class-string<PreviewCard>
     */
    protected $returnType = PreviewCard::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    public function getPreviewCardFromUrl(string $url): ?PreviewCard
    {
        $hashedPreviewCardUrl = md5($url);
        $cacheName =
            config('Fediverse')
                ->cachePrefix .
            "preview_card-{$hashedPreviewCardUrl}";
        if (! ($found = cache($cacheName))) {
            $found = $this->where('url', $url)
                ->first();
            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getPostPreviewCard(string $postId): ?PreviewCard
    {
        $cacheName =
            config('Fediverse')
                ->cachePrefix . "post#{$postId}_preview_card";
        if (! ($found = cache($cacheName))) {
            $found = $this->join(
                'fediverse_posts_preview_cards',
                'fediverse_posts_preview_cards.preview_card_id = id',
                'inner',
            )
                ->where('post_id', service('uuid') ->fromString($postId) ->getBytes())
                ->first();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function deletePreviewCard(int $id, string $url): BaseResult | bool
    {
        $hashedPreviewCardUrl = md5($url);
        cache()
            ->delete(config('Fediverse') ->cachePrefix . "preview_card-{$hashedPreviewCardUrl}");

        return $this->delete($id);
    }
}
