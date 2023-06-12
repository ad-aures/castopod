<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\MarkdownConverter;

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
        'id'               => 'integer',
        'title'            => 'string',
        'slug'             => 'string',
        'content_markdown' => 'string',
        'content_html'     => 'string',
    ];

    public function getLink(): string
    {
        return url_to('page', $this->attributes['slug']);
    }

    public function setContentMarkdown(string $contentMarkdown): static
    {
        $config = [
            'allow_unsafe_links' => false,
        ];

        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new AutolinkExtension());
        $environment->addExtension(new SmartPunctExtension());
        $environment->addExtension(new DisallowedRawHtmlExtension());

        $converter = new MarkdownConverter($environment);

        $this->attributes['content_markdown'] = $contentMarkdown;
        $this->attributes['content_html'] = $converter->convert($contentMarkdown);

        return $this;
    }
}
