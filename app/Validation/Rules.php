<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Validation;

class Rules
{
    /**
     * Checks a URL to ensure it's formed correctly.
     *
     */
    public function validate_url(string $str = null): bool
    {
        if (empty($str)) {
            return false;
        }

        return filter_var($str, FILTER_VALIDATE_URL) !== false;
    }

    //--------------------------------------------------------------------
}
