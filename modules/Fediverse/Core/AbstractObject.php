<?php

declare(strict_types=1);

/**
 * This class defines the Object which is the primary base type for the Activity Streams vocabulary.
 *
 * Object is a reserved word in php, so the class is named ObjectType.
 *
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Core;

abstract class AbstractObject
{
    public function set(string $property, mixed $value): static
    {
        $this->{$property} = $value;

        return $this;
    }

    /**
     * @return array<string, mixed>
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
                is_object($value) && is_subclass_of($value, self::class)
                    ? $value->toArray()
                    : $value;
        }

        // removes all NULL, FALSE and Empty Strings but leaves 0 (zero) values
        return array_filter($array, static fn ($value): bool => ! in_array($value, [null, false, ''], true));
    }

    public function toJSON(): string
    {
        return (string) json_encode($this->toArray(), JSON_UNESCAPED_UNICODE);
    }
}
