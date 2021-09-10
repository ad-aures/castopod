<?php

declare(strict_types=1);

if (! function_exists('flatten_attributes')) {
    /**
     * Stringify attributes for use in HTML tags.
     *
     * Helper function used to convert a string, array, or object of attributes to a string.
     *
     * @param mixed $attributes string, array, object
     */
    function flatten_attributes($attributes, bool $js = false): string
    {
        $atts = '';

        if ($attributes === null) {
            return $atts;
        }

        if (is_string($attributes)) {
            return ' ' . $attributes;
        }

        $attributes = (array) $attributes;

        foreach ($attributes as $key => $val) {
            $atts .= ($js) ? $key . '=' . esc($val, 'js') . ',' : ' ' . $key . '="' . $val . '"';
        }

        return rtrim($atts, ',');
    }
}
