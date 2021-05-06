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
    public function set($property, $value): self
    {
        $this->$property = $value;

        return $this;
    }

    /**
     * @return array<string, string|int|bool|array>
     */
    public function toArray(): array
    {
        $objectVars = get_object_vars($this);
        $array = [];
        foreach ($objectVars as $key => $value) {
            if ($key === 'context') {
                $key = '@context';
            }

            $array[$key] =
                is_object($value) && $value instanceof self
                    ? $value->toArray()
                    : $value;
        }

        // removes all NULL, FALSE and Empty Strings but leaves 0 (zero) values
        return array_filter($array, function ($value): bool {
            return $value !== null && $value !== false && $value !== '';
        });
    }

    /**
     * @return string|bool
     */
    public function toJSON()
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE);
    }
}
