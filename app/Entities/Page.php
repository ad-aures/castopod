<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use League\CommonMark\CommonMarkConverter;

/**
 * @property int $id
 * @property string $title
 * @property string $link
 * @property string $slug
 * @property string $content_markdown
 * @property string $content_html
 * @property Time $created_at
 * @property Time $updated_at
 * @property Time|null $delete_at
 */
class Page extends Entity
{
    protected string $link;

    protected string $content_html;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'slug' => 'string',
        'content_markdown' => 'string',
        'content_html' => 'string',
    ];

    public function getLink(): string
    {
        return url_to('page', $this->attributes['slug']);
    }

    public function setContentMarkdown(string $contentMarkdown): static
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        $this->attributes['content_markdown'] = $contentMarkdown;
        $this->attributes['content_html'] = $converter->convertToHtml($contentMarkdown);

        return $this;
    }
}
