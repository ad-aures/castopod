<?php

declare(strict_types=1);

namespace Modules\Fediverse\Commands;

use CodeIgniter\CLI\BaseCommand;
use Exception;

class Broadcast extends BaseCommand
{
    protected $group = 'fediverse';

    protected $name = 'fediverse:broadcast';

    protected $description = 'Broadcasts new outgoing activity to followers.';

    public function run(array $params): void
    {
        helper('fediverse');

        // retrieve scheduled activities from database
        $scheduledActivities = model('ActivityModel', false)
            ->getScheduledActivities(10);

        foreach ($scheduledActivities as $scheduledActivity) {
            // set activity post to processing
            model('ActivityModel', false)
                ->update($scheduledActivity->id, [
                    'status' => 'processing',
                ]);
        }

        // Send activity to all followers
        foreach ($scheduledActivities as $scheduledActivity) {
            try {
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

            } catch (Exception) {
                // set activity post to delivered
                model('ActivityModel', false)
                    ->update($scheduledActivity->id, [
                        'status' => 'failed',
                    ]);
            }
        }
    }
}
