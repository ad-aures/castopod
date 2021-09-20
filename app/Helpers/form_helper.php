<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

//--------------------------------------------------------------------

if (! function_exists('form_dropdown')) {
    /**
     * Drop-down Menu (based on html select tag)
     *
     * @param array<string, mixed> $options
     * @param array<string|int> $selected
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
