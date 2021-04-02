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
        return $this->where('url', $url)->first();
    }

    public function getNotePreviewCard($noteId)
    {
        return $this->join(
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
    }
}
