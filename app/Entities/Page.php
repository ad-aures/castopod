<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity;
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

    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'slug' => 'string',
        'content' => 'string',
    ];

    public function getLink()
    {
        return base_url($this->attributes['slug']);
    }

    public function getContentHtml()
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return $converter->convertToHtml($this->attributes['content']);
    }
}
