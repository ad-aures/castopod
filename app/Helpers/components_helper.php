<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use App\Entities\Location;
use App\Entities\Person;
use CodeIgniter\I18n\Time;
use CodeIgniter\View\Table;

if (! function_exists('button')) {
    /**
     * Button component
     *
     * Creates a stylized button or button like anchor tag if the URL is defined.
     *
     * @param array<string, string|null|bool> $customOptions button options: variant, size, iconLeft, iconRight
     * @param array<string, string> $customAttributes Additional attributes
     */
    function button(
        string $label = '',
        string $uri = '',
        array $customOptions = [],
        array $customAttributes = []
    ): string {
        $defaultOptions = [
            'variant' => 'default',
            'size' => 'base',
            'iconLeft' => null,
            'iconRight' => null,
            'isSquared' => false,
        ];
        $options = array_merge($defaultOptions, $customOptions);

        $baseClass =
            'inline-flex items-center font-semibold shadow-xs rounded-full focus:outline-none focus:ring';

        $variantClass = [
            'default' => 'text-black bg-gray-300 hover:bg-gray-400',
            'primary' => 'text-white bg-pine-700 hover:bg-pine-800',
            'secondary' => 'text-white bg-gray-700 hover:bg-gray-800',
            'accent' => 'text-white bg-rose-600 hover:bg-rose-800',
            'success' => 'text-white bg-green-600 hover:bg-green-700',
            'danger' => 'text-white bg-red-600 hover:bg-red-700',
            'warning' => 'text-black bg-yellow-500 hover:bg-yellow-600',
            'info' => 'text-white bg-blue-500 hover:bg-blue-600',
        ];

        $sizeClass = [
            'small' => 'text-xs md:text-sm',
            'base' => 'text-sm md:text-base',
            'large' => 'text-lg md:text-xl',
        ];

        $basePaddings = [
            'small' => 'px-2 md:px-3 md:py-1',
            'base' => 'px-3 py-1 md:px-4 md:py-2',
            'large' => 'px-3 py-2 md:px-5',
        ];

        $squaredPaddings = [
            'small' => 'p-1',
            'base' => 'p-2',
            'large' => 'p-3',
        ];

        $buttonClass =
            $baseClass .
            ' ' .
            ($options['isSquared']
                ? $squaredPaddings[$options['size']]
                : $basePaddings[$options['size']]) .
            ' ' .
            $sizeClass[$options['size']] .
            ' ' .
            $variantClass[$options['variant']];

        if (array_key_exists('class', $customAttributes)) {
            $buttonClass .= ' ' . $customAttributes['class'];
            unset($customAttributes['class']);
        }

        if ($options['iconLeft']) {
            $label = icon($options['iconLeft'], 'mr-2') . $label;
        }

        if ($options['iconRight']) {
            $label .= icon($options['iconRight'], 'ml-2');
        }

        if ($uri !== '') {
            return anchor($uri, $label, array_merge([
                'class' => $buttonClass,
            ], $customAttributes,));
        }

        $defaultButtonAttributes = [
            'type' => 'button',
        ];
        $attributes = stringify_attributes(array_merge($defaultButtonAttributes, $customAttributes));

        return <<<CODE_SAMPLE
            <button class="{$buttonClass}" {$attributes}>
            {$label}
            </button>
        CODE_SAMPLE;
    }
}

// ------------------------------------------------------------------------

if (! function_exists('icon_button')) {
    /**
     * Icon Button component
     *
     * Abstracts the `button()` helper to create a stylized icon button
     *
     * @param string $icon The button icon
     * @param string $title The button label
     * @param array<string, string|null|bool>  $customOptions button options: variant, size, iconLeft, iconRight
     * @param array<string, string>  $customAttributes Additional attributes
     */
    function icon_button(
        string $icon,
        string $title,
        string $uri = '',
        array $customOptions = [],
        array $customAttributes = []
    ): string {
        $defaultOptions = [
            'isSquared' => true,
        ];
        $options = array_merge($defaultOptions, $customOptions);

        $defaultAttributes = [
            'title' => $title,
            'data-toggle' => 'tooltip',
            'data-placement' => 'bottom',
        ];
        $attributes = array_merge($defaultAttributes, $customAttributes);

        return button(icon($icon), $uri, $options, $attributes);
    }
}

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
            '<span data-toggle="tooltip" data-placement="bottom" tabindex="0" title="' .
            $hintText .
            '" class="inline-block text-gray-500 align-middle outline-none focus:ring';

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
    function data_table(array $columns, array $data = [], ...$rest): string
    {
        $table = new Table();

        $template = [
            'table_open' => '<table class="w-full whitespace-no-wrap">',

            'thead_open' =>
                '<thead class="text-xs font-semibold text-left text-gray-500 uppercase border-b">',

            'heading_cell_start' => '<th class="px-4 py-2">',
            'cell_start' => '<td class="px-4 py-2">',
            'cell_alt_start' => '<td class="px-4 py-2">',

            'row_start' => '<tr class="bg-gray-100 hover:bg-pine-100">',
            'row_alt_start' => '<tr class="hover:bg-pine-100">',
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

        return '<div class="overflow-x-auto bg-white rounded-lg shadow" >' .
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
        if ($publicationDate === null) {
            return '';
        }

        $class =
            $publicationStatus === 'published'
                ? 'text-pine-500 border-pine-500'
                : 'text-red-600 border-red-600';

        $langOptions = [
            '<time pubdate datetime="' .
            $publicationDate->format(DateTime::ATOM) .
            '" title="' .
            $publicationDate .
            '">' .
            lang('Common.mediumDate', [$publicationDate]) .
            '</time>',
        ];

        $label = lang('Episode.publication_status.' . $publicationStatus, $langOptions);

        return '<span class="px-1 font-semibold border ' .
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
     * Displays the appropriate publication button depending on the publication status.
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
                $variant = 'accent';
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

        return button($label, $route, [
            'variant' => $variant,
            'iconLeft' => $iconLeft,
        ]);
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
            $args['episodeNumber'] = $episodeNumber;
        }

        if ($seasonNumber !== null) {
            $args['seasonNumber'] = $seasonNumber;
        }

        if ($episodeNumber !== null && $seasonNumber !== null) {
            $transKey = 'Episode.season_episode';
        } elseif ($episodeNumber !== null && $seasonNumber === null) {
            $transKey = 'Episode.number';
        } elseif ($episodeNumber === null && $seasonNumber !== null) {
            $transKey = 'Episode.season';
        }

        if ($isAbbr) {
            return '<abbr class="' .
                $class .
                '" title="' .
                lang($transKey, $args) .
                '">' .
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
                    'inline-flex items-baseline hover:underline' .
                    ($class === '' ? '' : " {$class}"),
                'target' => '_blank',
                'rel' => 'noreferrer noopener',
            ],
        );
    }
}

// ------------------------------------------------------------------------

if (! function_exists('person_list')) {
    /**
     * Returns list of persons images
     *
     * @param Person[] $persons
     */
    function person_list(array $persons, string $class = ''): string
    {
        if ($persons === []) {
            return '';
        }

        $personList = "<div class='flex w-full space-x-2 overflow-y-auto {$class}'>";

        foreach ($persons as $person) {
            $personList .= anchor(
                $person->information_url ?? '#',
                "<img
                    src='{$person->image->thumbnail_url}'
                    alt='{$person->full_name}'
                    class='object-cover w-12 h-12 rounded-full' />",
                [
                    'class' =>
                        'flex-shrink-0 focus:outline-none focus:ring focus:ring-inset',
                    'target' => '_blank',
                    'rel' => 'noreferrer noopener',
                    'title' =>
                        '<strong>' .
                        $person->full_name .
                        '</strong>' .
                        implode(
                            '',
                            array_map(function ($role) {
                                return '<br />' .
                                    lang(
                                        'PersonsTaxonomy.persons.' .
                                            $role->group .
                                            '.roles.' .
                                            $role->role .
                                            '.label',
                                    );
                            }, $person->roles),
                        ),
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'bottom',
                ],
            );
        }

        return $personList . '</div>';
    }
}

// ------------------------------------------------------------------------
