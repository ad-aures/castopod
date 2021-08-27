<?php

declare(strict_types=1);

namespace Modules\Fediverse\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class BaseModel extends Model
{
    /**
     * Model constructor.
     *
     * @param ConnectionInterface|null $db         DB Connection
     * @param ValidationInterface|null $validation Validation
     */
    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);

        $this->table = config('Fediverse')
            ->tablesPrefix . $this->table;
    }
}
