<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'categories';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'apple_category', 'google_category'
    ];

    protected $returnType    = 'App\Entities\Category';
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
}
