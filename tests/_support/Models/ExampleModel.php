<?php

declare(strict_types=1);

namespace Tests\Support\Models;

use CodeIgniter\Model;

class ExampleModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'factories';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var 'object'
     */
    protected $returnType = 'object';

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var list<string>
     */
    protected $allowedFields = ['name', 'uid', 'class', 'icon', 'summary'];

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var array<string, array<string, array<string, string>|string>|string>|string
     */
    protected $validationRules = [];

    /**
     * @var array<string, array<string, string>>
     */
    protected $validationMessages = [];

    /**
     * @var bool
     */
    protected $skipValidation = false;
}
