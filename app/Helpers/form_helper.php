<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

if (! function_exists('form_section')) {
    /**
     * Form section
     *
     * Used to produce a responsive form section with a title and subtitle. To close section, use form_section_close()
     *
     * @param string $title The section title
     * @param string $subtitle The section subtitle
     * @param array<string, string>  $attributes  Additional attributes
     */
    function form_section(
        string $title = '',
        string $subtitle = '',
        array $attributes = [],
        string $customSubtitleClass = ''
    ): string {
        $subtitleClass = 'text-sm text-gray-600';
        if ($customSubtitleClass !== '') {
            $subtitleClass = $customSubtitleClass;
        }

        $section =
            '<div class="flex flex-wrap w-full gap-6 mb-8"' .
            stringify_attributes($attributes) .
            ">\n";

        $info =
            '<div class="w-full max-w-xs"><h2 class="text-lg font-semibold">' .
            $title .
            '</h2><p class="' .
            $subtitleClass .
            '">' .
            $subtitle .
            '</p></div>';

        return $section . $info . '<div class="flex flex-col w-full max-w-lg">';
    }
}

//--------------------------------------------------------------------

if (! function_exists('form_section_close')) {
    /**
     * Form Section close Tag
     */
    function form_section_close(string $extra = ''): string
    {
        return '</div></div>' . $extra;
    }
}

//--------------------------------------------------------------------

if (! function_exists('form_switch')) {
    /**
     * Form Checkbox Switch
     *
     * Abstracts form_label to stylize it as a switch toggle
     *
     * @param mixed[] $data
     * @param mixed[] $extra
     */
    function form_switch(
        string $label = '',
        array $data = [],
        string $value = '',
        bool $checked = false,
        string $class = '',
        array $extra = []
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

if (! function_exists('form_label')) {
    /**
     * Form Label Tag
     *
     * @param string $text The text to appear onscreen
     * @param string $id         The id the label applies to
     * @param array<string, string>  $attributes Additional attributes
     * @param string  $hintText Hint text to add next to the label
     * @param boolean  $isOptional adds an optional text if true
     */
    function form_label(
        string $text = '',
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

        $labelContent = $text;
        if ($isOptional) {
            $labelContent .=
                '<small class="ml-1 lowercase">(' .
                lang('Common.optional') .
                ')</small>';
        }

        if ($hintText !== '') {
            $labelContent .= hint_tooltip($hintText, 'ml-1');
        }

        return $label . '>' . $labelContent . '</label>';
    }
}

//--------------------------------------------------------------------

if (! function_exists('form_multiselect')) {
    /**
     * Multi-select menu
     *
     * @param array<string, string> $options
     * @param string[] $selected
     * @param array<string, string> $customExtra
     */
    function form_multiselect(
        string $name = '',
        array $options = [],
        array $selected = [],
        array $customExtra = []
    ): string {
        $defaultExtra = [
            'data-class' => $customExtra['class'],
            'multiple' => 'multiple',
        ];
        $extra = array_merge($defaultExtra, $customExtra);

        return form_dropdown($name, $options, $selected, $extra);
    }
}

//--------------------------------------------------------------------

if (! function_exists('form_dropdown')) {
    /**
     * Drop-down Menu (based on html select tag)
     *
     * @param array<string, mixed> $options
     * @param string[] $selected
     * @param array<string, mixed> $customExtra
     */
    function form_dropdown(
        string $name = '',
        array $options = [],
        array $selected = [],
        array $customExtra = []
    ): string {
        $defaultExtra = [
            'data-select-text' => lang('Common.forms.multiSelect.selectText'),
            'data-loading-text' => lang('Common.forms.multiSelect.loadingText'),
            'data-no-results-text' => lang('Common.forms.multiSelect.noResultsText'),
            'data-no-choices-text' => lang('Common.forms.multiSelect.noChoicesText'),
            'data-max-item-text' => lang('Common.forms.multiSelect.maxItemText'),
        ];
        $extra = array_merge($defaultExtra, $customExtra);
        $defaults = [
            'name' => $name,
        ];

        // standardize selected as strings, like  the option keys will be.
        foreach ($selected as $key => $item) {
            $selected[$key] = $item;
        }

        $placeholderOption = '';
        if (isset($extra['placeholder'])) {
            $placeholderOption = '<option value="" disabled="disabled" hidden="hidden"' . (in_array(
                '',
                $selected,
                true
            ) ? ' selected="selected"' : '') . '>' . $extra['placeholder'] . '</option>';
            unset($extra['placeholder']);
        }

        $extra = stringify_attributes($extra);
        $multiple = (count($selected) > 1 && stripos($extra, 'multiple') === false) ? ' multiple="multiple"' : '';
        $form = '<select ' . rtrim(parse_form_attributes($name, $defaults)) . $extra . $multiple . ">\n";
        $form .= $placeholderOption;

        foreach ($options as $key => $val) {
            if (is_array($val)) {
                if ($val === []) {
                    continue;
                }
                $form .= '<optgroup label="' . $key . "\">\n";
                foreach ($val as $optgroupKey => $optgroupVal) {
                    $sel = in_array($optgroupKey, $selected, true) ? ' selected="selected"' : '';
                    $form .= '<option value="' . htmlspecialchars($optgroupKey) . '"' . $sel . '>'
                            . $optgroupVal . "</option>\n";
                }
                $form .= "</optgroup>\n";
            } else {
                /** @noRector RecastingRemovalRector */
                $form .= '<option value="' . htmlspecialchars((string) $key) . '"'
                        . (in_array($key, $selected, true) ? ' selected="selected"' : '') . '>'
                        . $val . "</option>\n";
            }
        }

        return $form . "</select>\n";
    }
}

//--------------------------------------------------------------------

if (! function_exists('form_editor')) {
    /**
     * Markdown editor
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed>|string $extra
     */
    function form_markdown_editor(array $data = [], string $value = '', string | array $extra = ''): string
    {
        $editorClass = 'w-full flex flex-col bg-white border border-gray-500 focus-within:ring-1 focus-within:ring-blue-600';
        if (array_key_exists('class', $data) && $data['class'] !== '') {
            $editorClass .= ' ' . $data['class'];
            unset($data['class']);
        }

        $data['class'] = 'border-none outline-none focus:border-none focus:outline-none w-full h-full';

        return '<div class="' . $editorClass . '">' .
            '<header class="sticky top-0 z-20 flex flex-wrap justify-between bg-white border-b border-gray-500">' .
                '<markdown-write-preview for="' . $data['id'] . '" class="relative inline-flex h-8">' .
                    '<button type="button" slot="write" class="px-2 font-semibold focus:outline-none focus:ring-inset focus:ring-2 focus:ring-pine-600">' . lang(
                        'Common.forms.editor.write'
                    ) . '</button>' .
                    '<button type="button" slot="preview" class="px-2 focus:outline-none focus:ring-inset focus:ring-2 focus:ring-pine-600">' . lang(
                        'Common.forms.editor.preview'
                    ) . '</button>' .
                '</markdown-write-preview>' .
                '<markdown-toolbar for="' . $data['id'] . '" class="flex gap-4 px-2 py-1">' .
                    '<div class="inline-flex text-2xl gap-x-1">' .
                        '<md-header class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'heading'
                        ) . '</md-header>' .
                        '<md-bold class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'bold'
                        ) . '</md-bold>' .
                        '<md-italic class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'italic'
                        ) . '</md-italic>' .
                    '</div>' .
                    '<div class="inline-flex text-2xl gap-x-1">' .
                        '<md-unordered-list class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'list-unordered'
                        ) . '</md-unordered-list>' .
                        '<md-ordered-list class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'list-ordered'
                        ) . '</md-ordered-list>' .
                    '</div>' .
                    '<div class="inline-flex text-2xl gap-x-1">' .
                        '<md-quote class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'quote'
                        ) . '</md-quote>' .
                        '<md-link class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'link'
                        ) . '</md-link>' .
                        '<md-image class="opacity-50 hover:opacity-100 focus:outline-none focus:ring-2 focus:opacity-100 focus:ring-pine-600">' . icon(
                            'image-add'
                        ) . '</md-image>' .
                    '</div>' .
                '</markdown-toolbar>' .
            '</header>' .
            '<div class="relative">' .
                form_textarea($data, $value, $extra) .
                '<markdown-preview for="' . $data['id'] . '" class="absolute top-0 left-0 hidden w-full h-full p-2 overflow-y-auto prose bg-gray-50" showClass="bg-white"></markdown-preview>' .
            '</div>' .
            '<footer class="flex px-2 py-1 bg-gray-100 border-t">' .
                '<a href="https://commonmark.org/help/" class="inline-flex items-center text-xs font-semibold text-gray-500 hover:text-gray-700" target="_blank" rel="noopener noreferrer">' . icon(
                    'markdown',
                    'mr-1 text-lg text-gray-400'
                ) . lang('Common.forms.editor.help') . '</a>' .
            '</footer>' .
        '</div>';
    }
}

// ------------------------------------------------------------------------
