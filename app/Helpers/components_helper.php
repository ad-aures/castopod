<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

if (!function_exists('button')) {
    /**
     * Button component
     *
     * Creates a stylized button or button like anchor tag if the URL is defined.
     *
     * @param string           $label The button label
     * @param mixed|null       $uri URI string or array of URI segments
     * @param array            $customOptions button options: variant, size, iconLeft, iconRight
     * @param array            $customAttributes Additional attributes
     *
     * @return string
     */
    function button(
        string $label = '',
        $uri = null,
        $customOptions = [],
        $customAttributes = []
    ): string {
        $defaultOptions = [
            'variant' => 'default',
            'size' => 'base',
            'iconLeft' => null,
            'iconRight' => null,
            'isRoundedFull' => false,
            'isSquared' => false,
        ];
        $options = array_merge($defaultOptions, $customOptions);

        $baseClass =
            'inline-flex items-center shadow-xs outline-none focus:shadow-outline';

        $variantClass = [
            'default' => 'bg-gray-300 hover:bg-gray-400',
            'primary' => 'text-white bg-green-500 hover:bg-green-600',
            'secondary' => 'text-white bg-gray-700 hover:bg-gray-800',
            'success' => 'text-white bg-green-600 hover:bg-green-700',
            'danger' => 'text-white bg-red-600 hover:bg-red-700',
            'warning' => 'text-black bg-yellow-500 hover:bg-yellow-600',
            'info' => 'text-white bg-teal-500 hover:bg-teal-600',
        ];

        $sizeClass = [
            'small' => 'text-xs md:text-sm ',
            'base' => 'text-sm md:text-base',
            'large' => 'text-lg md:text-xl',
        ];

        $basePaddings = [
            'small' => 'px-1 md:px-2 md:py-1',
            'base' => 'px-2 py-1 md:px-3 md:py-2',
            'large' => 'px-3 py-2 md:px-4 md:py-2',
        ];

        $squaredPaddings = [
            'small' => 'p-1',
            'base' => 'p-2',
            'large' => 'p-3',
        ];

        $roundedClass = [
            'full' => 'rounded-full',
            'small' => 'rounded-sm md:rounded',
            'base' => 'rounded md:rounded-md',
            'large' => 'rounded-md md:rounded-lg',
        ];

        $buttonClass =
            $baseClass .
            ' ' .
            ($options['isRoundedFull']
                ? $roundedClass['full']
                : $roundedClass[$options['size']]) .
            ' ' .
            ($options['isSquared']
                ? $squaredPaddings[$options['size']]
                : $basePaddings[$options['size']]) .
            ' ' .
            $sizeClass[$options['size']] .
            ' ' .
            $variantClass[$options['variant']];

        if (!empty($customAttributes['class'])) {
            $buttonClass .= ' ' . $customAttributes['class'];
            unset($customAttributes['class']);
        }

        if ($options['iconLeft']) {
            $label = icon($options['iconLeft'], 'mr-2') . $label;
        }

        if ($options['iconRight']) {
            $label .= icon($options['iconRight'], 'ml-2');
        }

        if ($uri) {
            return anchor(
                $uri,
                $label,
                array_merge(
                    [
                        'class' => $buttonClass,
                    ],
                    $customAttributes
                )
            );
        }

        $defaultButtonAttributes = [
            'type' => 'button',
        ];
        $attributes = array_merge($defaultButtonAttributes, $customAttributes);

        return '<button class="' .
            $buttonClass .
            '"' .
            stringify_attributes($attributes) .
            '>' .
            $label .
            '</button>';
    }
}

// ------------------------------------------------------------------------

if (!function_exists('icon_button')) {
    /**
     * Icon Button component
     *
     * Abstracts the `button()` helper to create a stylized icon button
     *
     * @param string           $label The button label
     * @param mixed|null       $uri URI string or array of URI segments
     * @param array            $customOptions button options: variant, size, iconLeft, iconRight
     * @param array            $customAttributes Additional attributes
     *
     * @return string
     */
    function icon_button(
        string $icon,
        string $title,
        $uri = null,
        $customOptions = [],
        $customAttributes = []
    ): string {
        $defaultOptions = [
            'isRoundedFull' => true,
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

if (!function_exists('hint_tooltip')) {
    /**
     * Hint component
     *
     * Used to produce tooltip with a question mark icon for hint texts
     *
     * @param string $hintText The hint text
     *
     * @return string
     */
    function hint_tooltip(string $hintText = '', string $class = ''): string
    {
        $tooltip =
            '<span data-toggle="tooltip" data-placement="bottom" tabindex="0" title="' .
            $hintText .
            '" class="inline-block align-middle outline-none focus:shadow-outline';

        if ($class !== '') {
            $tooltip .= ' ' . $class;
        }

        return $tooltip . '">' . icon('question') . '</span>';
    }
}

// ------------------------------------------------------------------------

if (!function_exists('data_table')) {
    /**
     * Data table component
     *
     * Creates a stylized table.
     *
     * @param array     $columns array of associate arrays with `header` and `cell` keys where `cell` is a function with a row of $data as parameter
     * @param array     $data data to loop through and display in rows
     * @param array     ...$rest Any other argument to pass to the `cell` function
     *
     * @return string
     */
    function data_table($columns, $data = [], ...$rest): string
    {
        $table = new \CodeIgniter\View\Table();

        $template = [
            'table_open' => '<table class="w-full whitespace-no-wrap">',

            'thead_open' =>
                '<thead class="text-xs font-semibold text-left text-gray-500 uppercase border-b">',

            'heading_cell_start' => '<th class="px-4 py-2">',
            'cell_start' => '<td class="px-4 py-2">',
            'cell_alt_start' => '<td class="px-4 py-2">',

            'row_start' => '<tr class="bg-gray-100 hover:bg-green-100">',
            'row_alt_start' => '<tr class="hover:bg-green-100">',
        ];

        $table->setTemplate($template);

        $tableHeaders = [];
        foreach ($columns as $column) {
            array_push($tableHeaders, $column['header']);
        }

        $table->setHeading($tableHeaders);

        if ($dataCount = count($data)) {
            for ($i = 0; $i < $dataCount; $i++) {
                $row = $data[$i];
                $rowData = [];
                foreach ($columns as $column) {
                    array_push($rowData, $column['cell']($row, ...$rest));
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
