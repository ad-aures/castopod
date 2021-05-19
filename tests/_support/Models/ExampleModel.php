<?php

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
     * @var string
     */
    protected $returnType = 'object';

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var string[]
     */
    protected $allowedFields = ['name', 'uid', 'class', 'icon', 'summary'];

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var mixed[]
     */
    protected $validationRules = [];

    /**
     * @var mixed[]
     */
    protected $validationMessages = [];

    /**
     * @var bool
     */
    protected $skipValidation = false;
}
