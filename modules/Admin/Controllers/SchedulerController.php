<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Models\ClipModel;
use CodeIgniter\Controller;
use MediaClipper\VideoClipper;

class SchedulerController extends Controller
{
    public function generateVideoClips(): bool
    {
        // get all clips that haven't been processed yet
        $scheduledClips = (new ClipModel())->getScheduledVideoClips();

        if ($scheduledClips === []) {
            return true;
        }

        $data = [];
        foreach ($scheduledClips as $scheduledClip) {
            $data[] = [
                'id' => $scheduledClip->id,
                'status' => 'pending',
            ];
        }

        (new ClipModel())->updateBatch($data, 'id');

        // Loop through clips to generate them
        foreach ($scheduledClips as $scheduledClip) {
            // set clip to pending
            (new ClipModel())
                ->update($scheduledClip->id, [
                    'status' => 'running',
                ]);
            $clipper = new VideoClipper(
                $scheduledClip->episode,
                $scheduledClip->start_time,
                $scheduledClip->end_time,
                $scheduledClip->format,
                $scheduledClip->theme['name'],
            );
            $exitCode = $clipper->generate();

            if ($exitCode === 0) {
                // success, video was generated
                $scheduledClip->setMedia($clipper->videoClipOutput);
                (new ClipModel())->update($scheduledClip->id, [
                    'media_id' => $scheduledClip->media_id,
                    'status' => 'passed',
                    'logs' => $clipper->logs,
                ]);
            } else {
                // error
                (new ClipModel())->update($scheduledClip->id, [
                    'status' => 'failed',
                    'logs' => $clipper->logs,
                ]);
            }
        }

        return true;
    }
}
