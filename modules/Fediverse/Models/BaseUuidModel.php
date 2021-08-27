<?php

declare(strict_types=1);

namespace Modules\Fediverse\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;
use Michalsn\Uuid\UuidModel;

class BaseUuidModel extends UuidModel
{
    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);

        $this->table = config('Fediverse')
            ->tablesPrefix . $this->table;
    }
}
