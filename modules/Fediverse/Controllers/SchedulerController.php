<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
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
        $scheduledActivities = model('ActivityModel', false)
            ->getScheduledActivities();

        // Send activity to all followers
        foreach ($scheduledActivities as $scheduledActivity) {
            if ($scheduledActivity->target_actor_id !== null) {
                if ($scheduledActivity->actor_id !== $scheduledActivity->target_actor_id) {
                    // send activity to targeted actor
                    send_activity_to_actor(
                        $scheduledActivity->actor,
                        $scheduledActivity->targetActor,
                        json_encode($scheduledActivity->payload, JSON_THROW_ON_ERROR)
                    );
                }
            } else {
                // send activity to all actor followers
                send_activity_to_followers(
                    $scheduledActivity->actor,
                    json_encode($scheduledActivity->payload, JSON_THROW_ON_ERROR),
                );
            }

            // set activity post to delivered
            model('ActivityModel', false)
                ->update($scheduledActivity->id, [
                    'status' => 'delivered',
                ]);
        }
    }
}
