<?php

declare(strict_types=1);

namespace App\Validation;

class OtherRules
{
    /**
     * Is a boolean (true or false)
     */
    public function is_boolean(mixed $str = null): bool
    {
        return is_bool($str);
    }

    /**
     * Is it an array?
     */
    public function is_list(mixed $str = null): bool
    {
        return is_array($str);
    }
}
