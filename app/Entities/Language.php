<?php

namespace App\Entities;

use CodeIgniter\Entity;

class Language extends Entity
{
    protected $casts = [
        'code' => 'string',
        'native_name' => 'string'
    ];
}
