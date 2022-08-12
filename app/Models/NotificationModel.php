<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Notification;
use Michalsn\Uuid\UuidModel;

class NotificationModel extends UuidModel
{
    /**
     * @var string
     */
    protected $table = 'notifications';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string
     */
    protected $returnType = Notification::class;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var string[]
     */
    protected $uuidFields = ['post_id', 'activity_id'];

    /**
     * @var string[]
     */
    protected $allowedFields = ['read_at'];
}
