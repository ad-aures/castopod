<?php

declare(strict_types=1);

namespace ViewComponents\Exceptions;

use CodeIgniter\Exceptions\ExceptionInterface;
use RuntimeException;

class ComponentNotFoundException extends RuntimeException implements ExceptionInterface
{
}
