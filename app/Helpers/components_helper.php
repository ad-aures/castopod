<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */
use App\Entities\Location;
use CodeIgniter\I18n\Time;
use CodeIgniter\View\Table;

// ------------------------------------------------------------------------

if (! function_exists('hint_tooltip')) {
    /**
     * Hint component
     *
     * Used to produce tooltip with a question mark icon for hint texts
     *
     * @param string $hintText The hint text
     */
    function hint_tooltip(string $hintText = '', string $class = ''): string
    {
        $tooltip =
            '<span data-tooltip="bottom" tabindex="0" title="' .
            $hintText .
            '" class="inline-block align-middle opacity-75 focus:ring-accent';

        if ($class !== '') {
            $tooltip .= ' ' . $class;
        }

        return $tooltip . '">' . icon('question') . '</span>';
    }
}

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
    function data_table(array $columns, array $data = [], string $class = '', ...$rest): string
    {
        $table = new Table();

        $template = [
            'table_open' => '<table class="w-full whitespace-no-wrap">',

            'thead_open' =>
                '<thead class="text-xs font-semibold text-left uppercase text-skin-muted">',

            'heading_cell_start' => '<th class="px-4 py-2">',
            'cell_start' => '<td class="px-4 py-2">',
            'cell_alt_start' => '<td class="px-4 py-2">',

            'row_start' => '<tr class="border-t border-subtle hover:bg-base">',
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
            return lang('Common.no_data');
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
        $class = match ($publicationStatus) {
            'published' => 'text-pine-500 border-pine-500 bg-pine-50',
            'scheduled' => 'text-red-600 border-red-600 bg-red-50',
            'not_published' => 'text-gray-600 border-gray-600 bg-gray-50',
            default => 'text-gray-600 border-gray-600 bg-gray-50',
        };

        $label = lang('Episode.publication_status.' . $publicationStatus);

        return '<span ' . ($publicationDate === null ? '' : 'title="' . $publicationDate . '"') . ' class="px-1 font-semibold border rounded ' .
            $class .
            ' ' .
            $customClass .
            '">' .
            $label .
            '</span>';
    }
}

// ------------------------------------------------------------------------

if (! function_exists('publication_button')) {
    /**
     * Publication button component
     *
     * Displays the appropriate publication button depending on the publication post.
     */
    function publication_button(int $podcastId, int $episodeId, string $publicationStatus): string
    {
        /** @phpstan-ignore-next-line */
        switch ($publicationStatus) {
            case 'not_published':
                $label = lang('Episode.publish');
                $route = route_to('episode-publish', $podcastId, $episodeId);
                $variant = 'primary';
                $iconLeft = 'upload-cloud';
                break;
            case 'scheduled':
                $label = lang('Episode.publish_edit');
                $route = route_to('episode-publish_edit', $podcastId, $episodeId);
                $variant = 'warning';
                $iconLeft = 'upload-cloud';
                break;
            case 'published':
                $label = lang('Episode.unpublish');
                $route = route_to('episode-unpublish', $podcastId, $episodeId);
                $variant = 'danger';
                $iconLeft = 'cloud-off';
                break;
            default:
                $label = '';
                $route = '';
                $variant = '';
                $iconLeft = '';
                break;
        }

        return <<<CODE_SAMPLE
            <Button variant="{$variant}" uri="{$route}" iconLeft="{$iconLeft}" >{$label}</Button>
        CODE_SAMPLE;
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
        bool $isAbbr = false
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
        if ($location === null) {
            return '';
        }

        return anchor(
            $location->url,
            icon('map-pin', 'mr-2') . $location->name,
            [
                'class' =>
                    'inline-flex items-baseline hover:underline focus:ring-accent' .
                    ($class === '' ? '' : " {$class}"),
                'target' => '_blank',
                'rel' => 'noreferrer noopener',
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

        return <<<CODE_SAMPLE
            <vm-player
                id="castopod-vm-player"
                theme="light"
                language="{$language}"
                icons="castopod-icons"
                class="{$class} relative z-0"
                style="--vm-player-box-shadow:0; --vm-player-theme: hsl(var(--color-accent-base)); --vm-control-focus-color: hsl(var(--color-accent-contrast)); --vm-control-spacing: 4px; --vm-menu-item-focus-bg: hsl(var(--color-background-highlight));"
            >
                <vm-audio preload="none">
                    <source src="{$source}" type="{$mediaType}" />
                </vm-audio>
                <vm-ui>
                    <vm-icon-library name="castopod-icons"></vm-icon-library>
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
        CODE_SAMPLE;
    }
}

// ------------------------------------------------------------------------

if (! function_exists('relative_time')) {
    function relative_time(Time $time, string $class = ''): string
    {
        $formatter = new IntlDateFormatter(service(
            'request'
        )->getLocale(), IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE);
        $translatedDate = $time->toLocalizedString($formatter->getPattern());
        $datetime = $time->format(DateTime::ISO8601);

        return <<<CODE_SAMPLE
            <time-ago class="{$class}" datetime="{$datetime}">
                <time
                    itemprop="published"
                    datetime="{$datetime}"
                    title="{$time}">{$translatedDate}</time>
            </time-ago>
        CODE_SAMPLE;
    }
}

// ------------------------------------------------------------------------
