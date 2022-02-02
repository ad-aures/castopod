<?php

declare(strict_types=1);

if (! function_exists('form_markdown_textarea')) {
    /**
     * Textarea field
     *
     * @param mixed $data
     * @param mixed $extra
     */
    function form_markdown_textarea($data = '', string $value = '', $extra = ''): string
    {
        $defaults = [
            'name' => is_array($data) ? '' : $data,
            'cols' => '40',
            'rows' => '10',
        ];
        if (! is_array($data) || ! isset($data['value'])) {
            $val = $value;
        } else {
            $val = $data['value'];
            unset($data['value']); // textareas don't use the value attribute
        }

        // Unsets default rows and cols if defined in extra field as array or string.
        if ((is_array($extra) && array_key_exists('rows', $extra)) || (is_string($extra) && stripos(
            preg_replace('~\s+~', '', $extra),
            'rows='
        ) !== false)) {
            unset($defaults['rows']);
        }

        if ((is_array($extra) && array_key_exists('cols', $extra)) || (is_string($extra) && stripos(
            preg_replace('~\s+~', '', $extra),
            'cols='
        ) !== false)) {
            unset($defaults['cols']);
        }

        return '<textarea ' . rtrim(parse_form_attributes($data, $defaults)) . stringify_attributes($extra) . '>'
                . $val
                . "</textarea>\n";
    }
}
