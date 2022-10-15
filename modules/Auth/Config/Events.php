<?php

declare(strict_types=1);

namespace Modules\Auth\Config;

use CodeIgniter\Events\Events;
use CodeIgniter\Shield\Entities\User;

Events::on('logout', static function (User $user): void {
    helper('auth');
    // remove user's interact_as_actor session
    remove_interact_as_actor();
});
