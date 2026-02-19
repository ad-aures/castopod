<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use App\Entities\Category;
use App\Entities\Episode;
use App\Entities\Location;
use CodeIgniter\I18n\Time;
use CodeIgniter\View\Table;

// ------------------------------------------------------------------------

if (! function_exists('data_table')) {
    /**
     * Data table component
     *
     * Creates a stylized table.
     *
     * @param array<array<string, mixed>> $columns array of associate arrays with `header` and `cell` keys where `cell` is a function with a row of $data as parameter
     * @param mixed[] $data data to loop through and display in rows
     * @param mixed ...$rest Any other argument to pass to the `cell` function
     */
    function data_table(array $columns, array $data = [], string $class = '', mixed ...$rest): string
    {
        $table = new Table();

        $template = [
            'table_open' => '<table class="w-full whitespace-nowrap">',

            'thead_open' => '<thead class="text-xs font-semibold text-left uppercase text-skin-muted">',

            'heading_cell_start' => '<th class="px-4 py-2">',
            'cell_start'         => '<td class="px-4 py-2">',
            'cell_alt_start'     => '<td class="px-4 py-2">',

            'row_start'     => '<tr class="border-t border-subtle hover:bg-base">',
            'row_alt_start' => '<tr class="border-t border-subtle hover:bg-base">',
        ];

        $table->setTemplate($template);

        $tableHeaders = [];
        foreach ($columns as $column) {
            $tableHeaders[] = $column['header'];
        }

        $table->setHeading($tableHeaders);

        if (($dataCount = count($data)) !== 0) {
            for ($i = 0; $i < $dataCount; ++$i) {
                $row = $data[$i];
                $rowData = [];
                foreach ($columns as $column) {
                    $rowData[] = $column['cell']($row, ...$rest);
                }

                $table->addRow($rowData);
            }
        } else {
            $table->addRow([
                [
                    'colspan' => count($tableHeaders),
                    'class'   => 'px-4 py-2 italic font-semibold text-center',
                    'data'    => lang('Common.no_data'),
                ],
            ]);
        }

        return '<div class="overflow-x-auto rounded-lg bg-elevated border-3 border-subtle ' . $class . '" >' .
            $table->generate() .
            '</div>';
    }
}

// ------------------------------------------------------------------------

if (! function_exists('publication_pill')) {
    /**
     * Publication pill component
     *
     * Shows the stylized publication datetime in regards to current datetime.
     */
    function publication_pill(?Time $publicationDate, string $publicationStatus, string $customClass = ''): string
    {
        $variant = match ($publicationStatus) {
            'published'     => 'success',
            'scheduled'     => 'warning',
            'with_podcast'  => 'info',
            'not_published' => 'default',
            default         => 'default',
        };

        $title = match ($publicationStatus) {
            'published', 'scheduled' => (string) $publicationDate,
            'with_podcast'  => lang('Episode.with_podcast_hint'),
            'not_published' => '',
            default         => '',
        };

        $label = lang('Episode.publication_status.' . $publicationStatus);

        // @icon("error-warning-fill")
        return '<x-Pill ' . ($title === '' ? '' : 'title="' . $title . '"') . ' variant="' . $variant . '" class="' . $customClass .
            '">' . $label . ($publicationStatus === 'with_podcast' ? icon('error-warning-fill', [
                'class' => 'flex-shrink-0 ml-1 text-lg',
            ]) : '') .
            '</x-Pill>';
    }
}

// ------------------------------------------------------------------------

if (! function_exists('publication_button')) {
    /**
     * Publication button component for episodes
     *
     * Displays the appropriate publication button depending on the publication post.
     */
    function publication_button(int $podcastId, int $episodeId, string $publicationStatus): string
    {
        switch ($publicationStatus) {
            case 'not_published':
                $label = lang('Episode.publish');
                $route = route_to('episode-publish', $podcastId, $episodeId);
                $variant = 'primary';
                $iconLeft = 'upload-cloud-fill'; // @icon("upload-cloud-fill")
                break;
            case 'with_podcast':
            case 'scheduled':
                $label = lang('Episode.publish_edit');
                $route = route_to('episode-publish_edit', $podcastId, $episodeId);
                $variant = 'warning';
                $iconLeft = 'upload-cloud-fill'; // @icon("upload-cloud-fill")
                break;
            case 'published':
                $label = lang('Episode.unpublish');
                $route = route_to('episode-unpublish', $podcastId, $episodeId);
                $variant = 'danger';
                $iconLeft = 'cloud-off-fill'; // @icon("cloud-off-fill")
                break;
            default:
                $label = '';
                $route = '';
                $variant = '';
                $iconLeft = '';
                break;
        }

        return <<<HTML
            <x-Button variant="{$variant}" uri="{$route}" iconLeft="{$iconLeft}" >{$label}</x-Button>
        HTML;
    }
}

// ------------------------------------------------------------------------

if (! function_exists('publication_status_banner')) {
    /**
     * Publication status banner component for podcasts
     *
     * Displays the appropriate banner depending on the podcast's publication status.
     */
    function publication_status_banner(?Time $publicationDate, int $podcastId, string $publicationStatus): string
    {
        switch ($publicationStatus) {
            case 'not_published':
                $bannerDisclaimer = lang('Podcast.publication_status_banner.draft_mode');
                $bannerText = lang('Podcast.publication_status_banner.not_published');
                $linkRoute = route_to('podcast-publish', $podcastId);
                $linkLabel = lang('Podcast.publish');
                break;
            case 'scheduled':
                $bannerDisclaimer = lang('Podcast.publication_status_banner.draft_mode');
                $bannerText = lang('Podcast.publication_status_banner.scheduled', [
                    'publication_date' => local_datetime($publicationDate),
                ]);
                $linkRoute = route_to('podcast-publish_edit', $podcastId);
                $linkLabel = lang('Podcast.publish_edit');
                break;
            default:
                $bannerDisclaimer = '';
                $bannerText = '';
                $linkRoute = '';
                $linkLabel = '';
                break;
        }

        return <<<HTML
        <div class="flex flex-wrap items-baseline px-4 py-2 border-b md:px-12 bg-stripes-default border-subtle" role="alert">
            <p class="flex items-baseline text-gray-900">
                <span class="text-xs font-semibold tracking-wide uppercase">{$bannerDisclaimer}</span>
                <span class="ml-3 text-sm">{$bannerText}</span>
            </p>
            <a href="{$linkRoute}" class="ml-1 text-sm font-semibold underline shadow-xs text-accent-base hover:text-accent-hover hover:no-underline">{$linkLabel}</a>
        </div>
        HTML;
    }
}

// ------------------------------------------------------------------------

if (! function_exists('episode_publication_status_banner')) {
    /**
     * Publication status banner component for podcasts
     *
     * Displays the appropriate banner depending on the podcast's publication status.
     */
    function episode_publication_status_banner(Episode $episode, string $class = ''): string
    {
        switch ($episode->publication_status) {
            case 'not_published':
                $linkRoute = route_to('episode-publish', $episode->podcast_id, $episode->id);
                $publishLinkLabel = lang('Episode.publish');
                break;
            case 'scheduled':
            case 'with_podcast':
                $linkRoute = route_to('episode-publish_edit', $episode->podcast_id, $episode->id);
                $publishLinkLabel = lang('Episode.publish_edit');
                break;
            default:
                $bannerDisclaimer = '';
                $linkRoute = '';
                $publishLinkLabel = '';
                break;
        }

        $bannerDisclaimer = lang('Episode.publication_status_banner.draft_mode');
        $bannerText = lang('Episode.publication_status_banner.text', [
            'publication_status' => $episode->publication_status,
            'publication_date'   => $episode->published_at instanceof Time ? local_datetime(
                $episode->published_at,
            ) : null,
        ]);
        $previewLinkLabel = lang('Episode.publication_status_banner.preview');

        return <<<HTML
        <div class="flex flex-wrap gap-4 items-baseline px-4 md:px-12 py-2 bg-stripes-default border-subtle {$class}" role="alert">
            <p class="flex items-baseline text-gray-900">
                <span class="text-xs font-semibold tracking-wide uppercase">{$bannerDisclaimer}</span>
                <span class="ml-3 text-sm">{$bannerText}</span>
            </p>
            <div class="flex items-baseline">    
                <a href="{$episode->preview_link}" class="ml-1 text-sm font-semibold underline shadow-xs text-accent-base hover:text-accent-hover hover:no-underline">{$previewLinkLabel}</a>
                <span class="mx-1">•</span>
                <a href="{$linkRoute}" class="ml-1 text-sm font-semibold underline shadow-xs text-accent-base hover:text-accent-hover hover:no-underline">{$publishLinkLabel}</a>
            </div>
        </div>
        HTML;
    }
}

// ------------------------------------------------------------------------

if (! function_exists('episode_numbering')) {
    /**
     * Returns relevant translated episode numbering.
     *
     * @param bool $isAbbr component will show abbreviated numbering if true
     */
    function episode_numbering(
        ?int $episodeNumber = null,
        ?int $seasonNumber = null,
        string $class = '',
        bool $isAbbr = false,
    ): string {
        if (! $episodeNumber && ! $seasonNumber) {
            return '';
        }

        $transKey = '';
        $args = [];
        if ($episodeNumber !== null) {
            $args['episodeNumber'] = sprintf('%02d', $episodeNumber);
        }

        if ($seasonNumber !== null) {
            $args['seasonNumber'] = sprintf('%02d', $seasonNumber);
        }

        if ($episodeNumber !== null && $seasonNumber !== null) {
            $transKey = 'Episode.season_episode';
        } elseif ($episodeNumber !== null && $seasonNumber === null) {
            $transKey = 'Episode.number';
        } elseif ($episodeNumber === null && $seasonNumber !== null) {
            $transKey = 'Episode.season';
        }

        if ($isAbbr) {
            return '<abbr class="tracking-wider ' .
                $class .
                '" title="' .
                lang($transKey, $args) .
                '" data-tooltip="bottom">' .
                lang($transKey . '_abbr', $args) .
                '</abbr>';
        }

        return '<span class="' .
            $class .
            '">' .
            lang($transKey, $args) .
            '</span>';
    }
}

// ------------------------------------------------------------------------

if (! function_exists('location_link')) {
    /**
     * Returns link to display from location info
     */
    function location_link(?Location $location, string $class = ''): string
    {
        if (! $location instanceof Location) {
            return '';
        }

        return anchor(
            $location->url,
            icon('map-pin-2-fill', [
                'class' => 'mr-2 flex-shrink-0',
            ]) . '<span class="truncate">' . esc($location->name) . '</span>',
            [
                'class' => 'w-full overflow-hidden inline-flex items-baseline hover:underline' .
                    ($class === '' ? '' : " {$class}"),
                'target' => '_blank',
                'rel'    => 'noreferrer noopener',
            ],
        );
    }
}

// ------------------------------------------------------------------------

if (! function_exists('audio_player')) {
    /**
     * Returns audio player
     */
    function audio_player(string $source, string $mediaType, string $class = ''): string
    {
        $language = service('request')
            ->getLocale();

        return <<<HTML
            <vm-player
                id="castopod-vm-player"
                theme="light"
                language="{$language}"
                class="{$class} relative z-0"
                icons="castopod-vm-player-icons"
                style="--vm-player-box-shadow:0; --vm-player-theme: hsl(var(--color-accent-base)); --vm-control-focus-color: hsl(var(--color-accent-contrast)); --vm-control-spacing: 4px; --vm-menu-item-focus-bg: hsl(var(--color-background-highlight));"
            >
                <vm-audio preload="none">
                    <source src="{$source}" type="{$mediaType}" />
                </vm-audio>
                <vm-ui>
                    <vm-icon-library name="castopod-vm-player-icons"></vm-icon-library>
                    <vm-controls full-width>
                        <vm-playback-control></vm-playback-control>
                        <vm-volume-control></vm-volume-control>
                        <vm-current-time></vm-current-time>
                        <vm-scrubber-control></vm-scrubber-control>
                        <vm-end-time></vm-end-time>
                        <vm-settings-control></vm-settings-control>
                        <vm-default-settings></vm-default-settings>
                    </vm-controls>
                </vm-ui>
            </vm-player>
        HTML;
    }
}

// ------------------------------------------------------------------------

if (! function_exists('relative_time')) {
    function relative_time(Time $time, string $class = ''): string
    {
        $formatter = new IntlDateFormatter(service(
            'request',
        )->getLocale(), IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE);
        $translatedDate = $time->toLocalizedString($formatter->getPattern());
        $datetime = $time->format(DateTime::ATOM);

        return <<<HTML
            <relative-time tense="auto" class="{$class}" datetime="{$datetime}">
                <time
                    datetime="{$datetime}"
                    title="{$time}">{$translatedDate}</time>
            </relative-time>
        HTML;
    }
}

// ------------------------------------------------------------------------

if (! function_exists('local_datetime')) {
    function local_datetime(Time $time): string
    {
        $formatter = new IntlDateFormatter(service(
            'request',
        )->getLocale(), IntlDateFormatter::MEDIUM, IntlDateFormatter::LONG);
        $translatedDate = $time->toLocalizedString($formatter->getPattern());
        $datetime = $time->format(DateTime::ATOM);

        return <<<HTML
            <relative-time datetime="{$datetime}"
                prefix=""
                threshold="PT0S"
                weekday="long"
                day="numeric"
                month="long"
                year="numeric"
                hour="numeric"
                minute="numeric">
                <time
                    datetime="{$datetime}"
                    title="{$time}">{$translatedDate}</time>
            </relative-time>
        HTML;
    }
}

// ------------------------------------------------------------------------

if (! function_exists('local_date')) {
    function local_date(Time $time): string
    {
        $formatter = new IntlDateFormatter(service(
            'request',
        )->getLocale(), IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE);
        $translatedDate = $time->toLocalizedString($formatter->getPattern());

        return <<<HTML
            <time title="{$time}">{$translatedDate}</time>
        HTML;
    }
}

// ------------------------------------------------------------------------

if (! function_exists('explicit_badge')) {
    function explicit_badge(bool $isExplicit, string $class = ''): string
    {
        if (! $isExplicit) {
            return '';
        }

        $explicitLabel = lang('Common.explicit');
        return <<<HTML
            <span class="px-1 text-xs font-semibold leading-tight tracking-wider uppercase border md:border-white/50 {$class}">{$explicitLabel}</span>
        HTML;
    }
}

// ------------------------------------------------------------------------

if (! function_exists('category_label')) {
    function category_label(Category $category): string
    {
        $categoryLabel = '';
        if ($category->parent_id !== null) {
            $categoryLabel .= lang('Podcast.category_options.' . $category->parent->code) . ' › ';
        }

        return $categoryLabel . lang('Podcast.category_options.' . $category->code);
    }
}

// ------------------------------------------------------------------------

if (! function_exists('downloads_abbr')) {
    function downloads_abbr(int $downloads): string
    {
        if ($downloads < 1000) {
            return (string) $downloads;
        }

        $option = match (true) {
            $downloads < 1_000_000 => [
                'divider' => 1_000,
                'suffix'  => 'K',
            ],
            $downloads < 1_000_000_000 => [
                'divider' => 1_000_000,
                'suffix'  => 'M',
            ],
            default => [
                'divider' => 1_000_000_000,
                'suffix'  => 'B',
            ],
        };
        $formatter = new NumberFormatter(service('request')->getLocale(), NumberFormatter::DECIMAL);

        $formatter->setPattern('#,##0.##');

        $abbr = $formatter->format($downloads / $option['divider']) . $option['suffix'];

        return <<<HTML
            <abbr title="{$downloads}">{$abbr}</abbr>
        HTML;
    }
}
