<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\PodcastImport\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use Exception;

/**
 * @property string $id
 * @property string $handle
 * @property string $feed_url
 * @property string $language
 * @property string $category
 * @property TaskStatus $status
 * @property ?string $error
 * @property int $episodes_newly_imported
 * @property int $episodes_already_imported
 * @property int $episodes_imported
 * @property ?int $episodes_count
 * @property int $progress
 * @property ?int $duration
 *
 * @property ?int $process_id
 *
 * @property int $created_by
 * @property int $updated_by
 *
 * @property ?Time $started_at
 * @property ?Time $ended_at
 * @property Time $created_at
 * @property Time $updated_at
 */
class PodcastImportTask extends Entity
{
    public string $error = '';

    public int $episodes_already_imported = 0;

    public int $episodes_newly_imported = 0;

    public ?int $episodes_count = null;

    protected ?int $duration = null;

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (! array_key_exists('id', $data)) {
            $this->id = md5($this->feed_url . Time::now());
        }
    }

    public function getProgress(): float
    {
        if ($this->episodes_count === null) {
            return 0;
        }

        return $this->episodes_imported / $this->episodes_count;
    }

    public function getEpisodesImported(): int
    {
        return $this->episodes_newly_imported + $this->episodes_already_imported;
    }

    public function setEpisodesNewlyImported(int $episodesImported): void
    {
        $this->episodes_newly_imported = $episodesImported;

        $this->save();
    }

    public function setEpisodesAlreadyImported(int $episodesImported): void
    {
        $this->episodes_already_imported = $episodesImported;

        $this->save();
    }

    public function setEpisodesCount(int $episodesCount): void
    {
        $this->episodes_count = $episodesCount;

        $this->save();
    }

    public function getDuration(): int
    {
        if ($this->duration === null && $this->started_at !== null && $this->ended_at !== null) {
            $this->duration = ($this->started_at->difference($this->ended_at))
                ->getSeconds();
        }

        return $this->duration;
    }

    public function start(): void
    {
        if ($this->process_id !== null) {
            throw new Exception('Task is already running!');
        }

        $processId = getmypid();

        if ($processId === false) {
            throw new Exception('Error Processing Request', 1);
        }

        $this->process_id = $processId;
        $this->started_at = Time::now();
        $this->status = TaskStatus::Running;
        $this->save();

        service('settings')
            ->set('Import.current', $this->handle);
    }

    public function pass(): void
    {
        $this->process_id = null;
        $this->ended_at = Time::now();
        $this->status = TaskStatus::Passed;

        $this->save();

        service('settings')
            ->forget('Import.current');
    }

    public function cancel(): void
    {
        if ($this->status !== TaskStatus::Running && $this->status !== TaskStatus::Queued) {
            throw new Exception('Task can only be canceled if running or queued.');
        }

        if ($this->isProcessRunning()) {
            // kill process
            $isProcessKilled = posix_kill($this->process_id, 9);

            if (! $isProcessKilled) {
                throw new Exception('Something wrong happened, process could not be killed.');
            }
        }

        $this->process_id = null;
        $this->status = TaskStatus::Canceled;
        $this->ended_at = Time::now();
        $this->save();
    }

    public function delete(): void
    {
        if ($this->isProcessRunning()) {
            $this->cancel();
        }

        $importQueue = service('settings')
            ->get('Import.queue') ?? [];

        if ($importQueue === []) {
            return;
        }

        unset($importQueue[$this->id]);

        service('settings')
            ->set('Import.queue', $importQueue);
    }

    public function fail(string $message): void
    {
        $this->error = $message;

        $this->status = TaskStatus::Failed;
        $this->ended_at = Time::now();
        $this->save();

        service('settings')
            ->forget('Import.current');
    }

    public function save(): void
    {
        $importQueue = service('settings')
            ->get('Import.queue') ?? [];

        $now = Time::now();

        if (! array_key_exists($this->id, $importQueue)) {
            $this->created_at = $now;
        }

        $this->updated_at = $now;

        $importQueue[$this->id] = $this;

        service('settings')
            ->set('Import.queue', $importQueue);
    }

    public function syncWithProcess(): void
    {
        if ($this->status !== TaskStatus::Running && $this->process_id !== null) {
            $this->process_id = null;
            $this->save();
            return;
        }

        if ($this->status === TaskStatus::Running && $this->process_id === null) {
            $this->fail('Running task has no process id set.');
            return;
        }

        if (! $this->isProcessRunning()) {
            $this->fail('Process was killed.');
            return;
        }
    }

    private function isProcessRunning(): bool
    {
        if ($this->process_id === null) {
            return false;
        }

        return posix_getpgid($this->process_id) !== false;
    }
}
