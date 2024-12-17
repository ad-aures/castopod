<?php

declare(strict_types=1);

namespace App\Libraries;

use App\Controllers\WebmanifestController;
use Override;
use Stringable;

/**
 * Inspired by https://github.com/melbahja/seo
 */
class HtmlHead implements Stringable
{
    protected ?string $title = null;

    /**
     * @var array{name:string,value:string|null,attributes:array<string,string|null>}[]
     */
    protected array $tags = [];

    protected string $rawContent = '';

    #[Override]
    public function __toString(): string
    {
        helper('misc');
        $this
            ->tag('meta', null, [
                'charset' => 'UTF-8',
            ])
            ->meta('viewport', 'width=device-width, initial-scale=1.0')
            ->tag('link', null, [
                'rel'  => 'icon',
                'type' => 'image/x-icon',
                'href' => get_site_icon_url('ico'),
            ])
            ->tag('link', null, [
                'rel'  => 'apple-touch-icon',
                'href' => get_site_icon_url('180'),
            ])
            ->tag('link', null, [
                'rel' => 'manifest',
                // @phpstan-ignore-next-line
                'href' => isset($podcast) ? route_to('podcast-webmanifest', esc($podcast->handle)) : route_to(
                    'webmanifest'
                ),
            ])
            ->meta(
                'theme-color',
                WebmanifestController::THEME_COLORS[service('settings')->get('App.theme')]['theme']
            )
            ->tag('link', null, [
                'rel'  => 'stylesheet',
                'type' => 'text/css',
                'href' => route_to('themes-colors-css'),
            ])
            ->appendRawContent(<<<HTML
                <script>
                // Check that service workers are supported
                if ('serviceWorker' in navigator) {
                    // Use the window load event to keep the page load performant
                    window.addEventListener('load', () => {
                        navigator.serviceWorker.register('/sw.js');
                    });
                }
                </script>
            HTML);

        if ($this->title) {
            $this->tag('title', esc($this->title));
        }

        if (url_is(route_to('admin') . '*') || url_is(base_url(config('Auth')->gateway) . '*')) {
            // restricted admin and auth areas, do not index
            $this->meta('robots', 'noindex');
        } else {
            // public website, set siteHead hook only there
            service('plugins')
                ->siteHead($this);
        }

        $head = '<head>';
        foreach ($this->tags as $tag) {
            if ($tag['value'] === null) {
                $head .= <<<HTML
                    <{$tag['name']}{$this->stringify_attributes($tag['attributes'])}/>
                HTML;
            } else {
                $head .= <<<HTML
                    <{$tag['name']} {$this->stringify_attributes($tag['attributes'])}>{$tag['value']}</{$tag['name']}>
                HTML;
            }
        }

        $head .= $this->rawContent . '</head>';

        // reset head for next render
        $this->title = null;
        $this->tags = [];
        $this->rawContent = '';

        return $head;
    }

    public function title(string $title): self
    {
        $this->title = $title;
        return $this->meta('title', $title)
            ->og('title', $title)
            ->twitter('title', $title);
    }

    public function description(string $desc): self
    {
        return $this->meta('description', $desc)
            ->og('description', $desc)
            ->twitter('description', $desc);
    }

    public function image(string $url, string $card = 'summary_large_image'): self
    {
        return $this->og('image', $url)
            ->twitter('card', $card)
            ->twitter('image', $url);
    }

    public function canonical(string $url): self
    {
        return $this->tag('link', null, [
            'rel'  => 'canonical',
            'href' => $url,
        ]);
    }

    public function twitter(string $name, string $value): self
    {
        $this->meta("twitter:{$name}", $value);
        return $this;
    }

    /**
     * @param array<string,string|null> $attributes
     */
    public function tag(string $name, ?string $value = null, array $attributes = []): self
    {
        $this->tags[] = [
            'name'       => $name,
            'value'      => $value,
            'attributes' => $attributes,
        ];

        return $this;
    }

    public function meta(string $name, string $content): self
    {
        $this->tag('meta', null, [
            'name'    => $name,
            'content' => $content,
        ]);

        return $this;
    }

    public function og(string $name, string $content): self
    {
        $this->meta('og:' . $name, $content);

        return $this;
    }

    public function appendRawContent(string $content): self
    {
        $this->rawContent .= $content;

        return $this;
    }

    /**
     * @param array<string, string|null> $attributes
     */
    private function stringify_attributes(array $attributes): string
    {
        return stringify_attributes($attributes);
    }
}
