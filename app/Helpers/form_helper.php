<?php

declare(strict_types=1);

if (! function_exists('form_textarea')) {
    /**
     * Adapted textarea field from CI4 core: without value escaping.
     */
    function form_textarea(mixed $data = '', string $value = '', mixed $extra = ''): string
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
            (string) preg_replace('~\s+~', '', $extra),
            'rows=',
        ) !== false)) {
            unset($defaults['rows']);
        }

        if ((is_array($extra) && array_key_exists('cols', $extra)) || (is_string($extra) && stripos(
            (string) preg_replace('~\s+~', '', $extra),
            'cols=',
        ) !== false)) {
            unset($defaults['cols']);
        }

        return '<textarea ' . rtrim(parse_form_attributes($data, $defaults)) . stringify_attributes(
            $extra,
        ) . '>' . $val . "</textarea>\n";
    }
}

if (! function_exists('parse_form_attributes')) {
    /**
     * Parse the form attributes
     *
     * Helper function used by some of the form helpers
     *
     * @param array<string, string>|string $attributes List of attributes
     * @param array<string, mixed>        $default    Default values
     */
    function parse_form_attributes(array|string $attributes, array $default): string
    {
        if (is_array($attributes)) {
            foreach (array_keys($default) as $key) {
                if (isset($attributes[$key])) {
                    $default[$key] = $attributes[$key];
                    unset($attributes[$key]);
                }
            }

            if ($attributes !== []) {
                $default = array_merge($default, $attributes);
            }
        }

        $att = '';

        foreach ($default as $key => $val) {
            if (! is_bool($val)) {
                if ($key === 'name' && ! strlen((string) $default['name'])) {
                    continue;
                }

                $att .= $key . '="' . $val . '"' . ($key === array_key_last($default) ? '' : ' ');
            } else {
                $att .= $key . ' ';
            }
        }

        return $att;
    }
}
