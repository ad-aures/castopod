<?php

declare(strict_types=1);

namespace App\Libraries;

use CodeIgniter\HTTP\Negotiate as CodeIgniterHTTPNegotiate;

class Negotiate extends CodeIgniterHTTPNegotiate
{
    /**
     * @param mixed[] $acceptable
     */
    public function callMatch(array $acceptable, string $supported, bool $enforceTypes = false): bool
    {
        return $this->match($acceptable, $supported, $enforceTypes);
    }
}
