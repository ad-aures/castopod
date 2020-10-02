<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

if (!function_exists('form_section')) {
    /**
     * Form section
     *
     * Used to produce a responsive form section with a title and subtitle. To close section,
     * use form_section_close()
     *
     * @param string $title The section title
     * @param string $subtitle The section subtitle
     * @param array  $attributes  Additional attributes
     *
     * @return string
     */
    function form_section(
        string $title = '',
        string $subtitle = '',
        array $attributes = []
    ): string {
        $section =
            '<div class="flex flex-wrap w-full gap-6 mb-8"' .
            stringify_attributes($attributes) .
            ">\n";

        $info =
            '<div class="w-full max-w-xs"><h2 class="text-lg font-semibold">' .
            $title .
            '</h2><p class="text-sm text-gray-600">' .
            $subtitle .
            '</p></div>';

        return $section . $info . '<div class="flex flex-col w-full max-w-lg">';
    }
}

//--------------------------------------------------------------------

if (!function_exists('form_section_close')) {
    /**
     * Form Section close Tag
     *
     * @param string $extra
     *
     * @return string
     */
    function form_section_close(string $extra = ''): string
    {
        return '</div></div>' . $extra;
    }
}

//--------------------------------------------------------------------

if (!function_exists('form_switch')) {
    /**
     * Form Checkbox Switch
     *
     * Abstracts form_label to stylize it as a switch toggle
     *
     * @param array   $data
     * @param string  $value
     * @param boolean $checked
     * @param mixed   $extra
     *
     * @return string
     */
    function form_switch(
        $label = '',
        $data = '',
        string $value = '',
        bool $checked = false,
        $class = '',
        $extra = ''
    ): string {
        $data['class'] = 'form-switch';

        return '<label class="relative inline-flex items-center' .
            ' ' .
            $class .
            '">' .
            form_checkbox($data, $value, $checked, $extra) .
            '<span class="form-switch-slider"></span>' .
            '<span class="ml-2">' .
            $label .
            '</span></label>';
    }
}

//--------------------------------------------------------------------

if (!function_exists('form_label')) {
    /**
     * Form Label Tag
     *
     * @param string $label_text The text to appear onscreen
     * @param string $id         The id the label applies to
     * @param array  $attributes Additional attributes
     * @param string  $hintText Hint text to add next to the label
     * @param boolean  $isOptional adds an optional text if true
     *
     * @return string
     */
    function form_label(
        string $label_text = '',
        string $id = '',
        array $attributes = [],
        string $hintText = '',
        bool $isOptional = false
    ): string {
        $label = '<label';

        if ($id !== '') {
            $label .= ' for="' . $id . '"';
        }

        if (is_array($attributes) && $attributes) {
            foreach ($attributes as $key => $val) {
                $label .= ' ' . $key . '="' . $val . '"';
            }
        }

        $label_content = $label_text;
        if ($isOptional) {
            $label_content .=
                '<small class="ml-1 lowercase">(' .
                lang('Common.optional') .
                ')</small>';
        }

        if ($hintText !== '') {
            $label_content .= hint_tooltip($hintText, 'ml-1');
        }

        return $label . '>' . $label_content . '</label>';
    }
}

//--------------------------------------------------------------------

if (!function_exists('form_multiselect')) {
    /**
     * Multi-select menu
     *
     * @param string $name
     * @param array  $options
     * @param array  $selected
     * @param mixed  $extra
     *
     * @return string
     */
    function form_multiselect(
        string $name = '',
        array $options = [],
        array $selected = [],
        $customExtra = ''
    ): string {
        $defaultExtra = [
            'data-class' => $customExtra['class'],
            'data-select-text' => lang('Common.forms.multiSelect.selectText'),
            'data-loading-text' => lang('Common.forms.multiSelect.loadingText'),
            'data-no-results-text' => lang(
                'Common.forms.multiSelect.noResultsText'
            ),
            'data-no-choices-text' => lang(
                'Common.forms.multiSelect.noChoicesText'
            ),
            'data-max-item-text' => lang(
                'Common.forms.multiSelect.maxItemText'
            ),
        ];
        $extra = stringify_attributes(array_merge($defaultExtra, $customExtra));

        if (stripos($extra, 'multiple') === false) {
            $extra .= ' multiple="multiple"';
        }

        return form_dropdown($name, $options, $selected, $extra);
    }
}

//--------------------------------------------------------------------
