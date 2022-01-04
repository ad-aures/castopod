<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\Publisher as BasePublisher;

/**
 * Publisher Configuration
 *
 * Defines basic security restrictions for the Publisher class to prevent abuse by injecting malicious files into a
 * project.
 */
class Publisher extends BasePublisher
{
}
