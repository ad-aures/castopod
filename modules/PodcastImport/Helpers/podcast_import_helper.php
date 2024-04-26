<?php

declare(strict_types=1);

use Modules\PodcastImport\Entities\PodcastImportTask;
use Modules\PodcastImport\Entities\TaskStatus;

/**
 * @copyright  2023 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

if (! function_exists('get_import_tasks')) {
    /**
     * @return PodcastImportTask[]
     */
    function get_import_tasks(?string $podcastHandle = null): array
    {
        /** @var PodcastImportTask[] $podcastImportsQueue */
        $podcastImportsQueue = service('settings')
            ->get('Import.queue') ?? [];

        if (! is_array($podcastImportsQueue)) {
            return [];
        }

        if ($podcastHandle !== null) {
            $podcastImportsQueue = array_filter(
                $podcastImportsQueue,
                static fn ($importTask): bool => $importTask->handle === $podcastHandle
            );
        }

        usort($podcastImportsQueue, static function (PodcastImportTask $a, PodcastImportTask $b): int {
            if ($a->status === $b->status) {
                return $a->created_at->isAfter($b->created_at) ? -1 : 1;
            }

            if ($a->status === TaskStatus::Running) {
                return -1;
            }

            if ($a->status === TaskStatus::Queued && $b->status !== TaskStatus::Running) {
                return -1;
            }

            return $a->created_at->isAfter($b->created_at) ? -1 : 1;
        });

        return array_values($podcastImportsQueue);
    }
}
