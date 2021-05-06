<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use League\CommonMark\CommonMarkConverter;

class Page extends Entity
{
    /**
     * @var string
     */
    protected $link;

    /**
     * @var string
     */
    protected $content_html;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'slug' => 'string',
        'content' => 'string',
    ];

    public function getLink()
    {
        return url_to('page', $this->attributes['slug']);
    }

    public function getContentHtml(): string
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return $converter->convertToHtml($this->attributes['content']);
    }
}
