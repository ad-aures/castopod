<?php

namespace App\Entities;

use CodeIgniter\Entity;

class Podcast extends Entity
{
    protected $casts = [
        'title' => 'string',
        'name' => 'string',
        'description' => 'string',
        'episode_description_footer' => '?string',
        'image' => 'string',
        'language' => 'string',
        'category' => 'array',
        'explicit' => 'boolean',
        'author' => '?string',
        'owner_name' => '?string',
        'owner_email' => '?string',
        'type' => '?string',
        'copyright' => '?string',
        'block' => 'boolean',
        'complete' => 'boolean',
        'custom_html_head' => '?string',
    ];
}
