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
     * Value should not be within the array of protected slugs (adminGateway, authGateway or installGateway)
     *
     * @param string $value
     *
     * @return boolean
     */
    public function not_in_protected_slugs(string $value = null): bool
    {
        $appConfig = config('App');
        $protectedSlugs = [
            $appConfig->adminGateway,
            $appConfig->authGateway,
            $appConfig->installGateway,
        ];
        return !in_array($value, $protectedSlugs, true);
    }

    //--------------------------------------------------------------------
}
