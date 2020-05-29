<?php

namespace App\Entities;

use CodeIgniter\Entity;

class Category extends Entity
{
    protected $casts = [
        'parent_id' => 'integer',
        'apple_category' => 'string',
        'google_category' => 'string',
    ];
}
