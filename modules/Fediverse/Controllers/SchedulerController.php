<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Controllers;

use CodeIgniter\Controller;

class SchedulerController extends Controller
{
    /**
     * @var string[]
     */
    protected $helpers = ['fediverse'];

    public function activity(): void
    {
        // retrieve scheduled activities from database
        $scheduledActivities = model('ActivityModel')
            ->getScheduledActivities();

        // Send activity to all followers
        foreach ($scheduledActivities as $scheduledActivity) {
            // send activity to all actor followers
            send_activity_to_followers(
                $scheduledActivity->actor,
                json_encode($scheduledActivity->payload, JSON_THROW_ON_ERROR),
            );

            // set activity post to delivered
            model('ActivityModel')
                ->update($scheduledActivity->id, [
                    'status' => 'delivered',
                ]);
        }
    }
}
