<?php

namespace App\Models;

use CodeIgniter\Model;

class PodcastModel extends Model
{
    protected $table = 'podcasts';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'name',
        'description',
        'episode_description_footer',
        'image',
        'language',
        'category',
        'explicit',
        'author',
        'owner_name',
        'owner_email',
        'type',
        'copyright',
        'block',
        'complete',
        'custom_html_head',
    ];

    protected $returnType = 'App\Entities\Podcast';
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
}
