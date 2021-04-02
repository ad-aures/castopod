<?php

/**
 * This class defines the Object which is the
 * primary base type for the Activity Streams vocabulary.
 *
 * Object is a reserved word in php, so the class is named ObjectType.
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Core;

abstract class AbstractObject
{
    public function set($property, $value)
    {
        $this->$property = $value;

        return $this;
    }

    public function toArray()
    {
        $objectVars = get_object_vars($this);
        $array = [];
        foreach ($objectVars as $key => $value) {
            if ($key === 'context') {
                $key = '@context';
            }
            if (is_object($value) && $value instanceof self) {
                $array[$key] = $value->toArray();
            } else {
                $array[$key] = $value;
            }
        }

        // removes all NULL, FALSE and Empty Strings but leaves 0 (zero) values
        return array_filter($array, function ($value) {
            return $value !== null && $value !== false && $value !== '';
        });
    }

    public function toJSON()
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE);
    }
}
