<?php

declare(strict_types=1);

namespace Modules\PodcastImport\Entities;

enum TaskStatus: string
{
    case Queued = 'queued';
    case Running = 'running';
    case Canceled = 'canceled';
    case Failed = 'failed';
    case Passed = 'passed';
}
