<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Tasks\Scheduler;

class Tasks extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Should performance metrics be logged
     * --------------------------------------------------------------------------
     *
     * If true, will log the time it takes for each task to run.
     * Requires the settings table to have been created previously.
     */
    public bool $logPerformance = false;

    /**
     * --------------------------------------------------------------------------
     * Maximum performance logs
     * --------------------------------------------------------------------------
     *
     * The maximum number of logs that should be saved per Task.
     * Lower numbers reduced the amount of database required to
     * store the logs.
     */
    public int $maxLogsPerTask = 10;

    /**
     * Register any tasks within this method for the application.
     * Called by the TaskRunner.
     */
    public function init(Scheduler $schedule): void
    {
        $schedule->command('fediverse:broadcast')
            ->everyMinute()
            ->named('fediverse-broadcast');

        $schedule->command('websub:publish')
            ->everyMinute()
            ->named('websub-publish');

        $schedule->command('video-clips:generate')
            ->everyMinute()
            ->named('video-clips-generate');

        $schedule->command('podcast:import')
            ->everyMinute()
            ->named('podcast-import');

        $schedule->command('episodes:compute-downloads')
            ->everyHour()
            ->named('episodes:compute-downloads');
    }
}
