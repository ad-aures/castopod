<?php

namespace App\Models;

use CodeIgniter\Model;

class EpisodeModel extends Model
{
    protected $table = 'episodes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'slug',
        'title',
        'enclosure_url',
        'enclosure_length',
        'enclosure_type',
        'guid',
        'pub_date',
        'description',
        'duration',
        'image',
        'explicit',
        'episode_number',
        'season_number',
        'type',
        'block',
    ];

    protected $returnType = 'App\Entities\Episode';
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
}
