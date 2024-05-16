<?php

declare(strict_types=1);

namespace Modules\Plugins\Core;

enum PluginStatus: string
{
    case INVALID = 'invalid';
    case INACTIVE = 'inactive';
    case ACTIVE = 'active';
}
