<?php

namespace App\Libraries;

class Negotiate extends \CodeIgniter\HTTP\Negotiate
{
    public function callMatch(
        array $acceptable,
        string $supported,
        bool $enforceTypes = false
    ): bool {
        return $this->match($acceptable, $supported, $enforceTypes);
    }
}
