<?php

namespace App\Models;

use CodeIgniter\Model;

class LanguageModel extends Model
{
    protected $table = 'languages';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'code', 'native_name'
    ];

    protected $returnType = 'App\Entities\Language';
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
}
