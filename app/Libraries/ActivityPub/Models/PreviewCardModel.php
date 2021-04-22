<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

use CodeIgniter\Model;

class PreviewCardModel extends Model
{
    protected $table = 'activitypub_preview_cards';

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

    protected $returnType = \ActivityPub\Entities\PreviewCard::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;

    public function getPreviewCardFromUrl($url)
    {
        $hashedPreviewCardUrl = md5($url);
        $cacheName =
            config('ActivityPub')->cachePrefix .
            "preview_card@{$hashedPreviewCardUrl}";
        if (!($found = cache($cacheName))) {
            $found = $this->where('url', $url)->first();
            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getNotePreviewCard($noteId)
    {
        $cacheName =
            config('ActivityPub')->cachePrefix . "note#{$noteId}_preview_card";
        if (!($found = cache($cacheName))) {
            $found = $this->join(
                'activitypub_notes_preview_cards',
                'activitypub_notes_preview_cards.preview_card_id = id',
                'inner',
            )
                ->where(
                    'note_id',
                    service('uuid')
                        ->fromString($noteId)
                        ->getBytes(),
                )
                ->first();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function deletePreviewCard($id, $url)
    {
        $hashedPreviewCardUrl = md5($url);
        cache()->delete(
            config('ActivityPub')->cachePrefix .
                "preview_card@{$hashedPreviewCardUrl}",
        );

        return $this->delete($id);
    }
}
