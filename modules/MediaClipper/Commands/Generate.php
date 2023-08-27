<?php

declare(strict_types=1);

namespace Modules\MediaClipper\Commands;

use App\Models\ClipModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\Files\File;
use CodeIgniter\I18n\Time;
use Exception;
use Modules\Admin\Config\Admin;
use Modules\MediaClipper\VideoClipper;

class Generate extends BaseCommand
{
    protected $group = 'media-clipper';

    protected $name = 'video-clips:generate';

    protected $description = 'Displays basic application information.';

    public function run(array $params): void
    {
        // get number of running clips to prevent from having too much running in parallel
        // TODO: get the number of running ffmpeg processes directly from the machine?
        $runningVideoClips = (new ClipModel())->getRunningVideoClipsCount();
        if ($runningVideoClips >= config(Admin::class)->videoClipWorkers) {
            return;
        }

        // get all clips that haven't been processed yet
        $scheduledClips = (new ClipModel())->getScheduledVideoClips();

        if ($scheduledClips === []) {
            return;
        }

        $data = [];
        foreach ($scheduledClips as $scheduledClip) {
            $data[] = [
                'id'     => $scheduledClip->id,
                'status' => 'pending',
            ];
        }

        (new ClipModel())->updateBatch($data, 'id');

        // Loop through clips to generate them
        foreach ($scheduledClips as $scheduledClip) {
            try {
                // set clip to pending
                (new ClipModel())
                    ->update($scheduledClip->id, [
                        'status'         => 'running',
                        'job_started_at' => Time::now(),
                    ]);
                $clipper = new VideoClipper(
                    $scheduledClip->episode,
                    $scheduledClip->start_time,
                    $scheduledClip->end_time,
                    $scheduledClip->format,
                    $scheduledClip->theme['name'],
                );
                $exitCode = $clipper->generate();

                $clipModel = new ClipModel();
                if ($exitCode === 0) {
                    // success, video was generated
                    $scheduledClip->setMedia(new File($clipper->videoClipOutput), $clipper->videoClipFileKey);
                    $clipModel->update($scheduledClip->id, [
                        'media_id'     => $scheduledClip->media_id,
                        'status'       => 'passed',
                        'logs'         => $clipper->logs,
                        'job_ended_at' => Time::now(),
                    ]);
                } else {
                    // error
                    $clipModel->update($scheduledClip->id, [
                        'status'       => 'failed',
                        'logs'         => $clipper->logs,
                        'job_ended_at' => Time::now(),
                    ]);
                }

                $clipModel->clearVideoClipCache($scheduledClip->id);
            } catch (Exception $exception) {
                (new ClipModel())->update($scheduledClip->id, [
                    'status'       => 'failed',
                    'logs'         => $exception,
                    'job_ended_at' => Time::now(),
                ]);
            }
        }
    }
}
