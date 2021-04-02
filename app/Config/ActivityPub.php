<?php namespace Config;

use ActivityPub\Config\ActivityPub as ActivityPubBase;

class ActivityPub extends ActivityPubBase
{
    /**
     * --------------------------------------------------------------------
     * ActivityPub Objects
     * --------------------------------------------------------------------
     */
    public $actorObject = 'App\Libraries\PodcastActor';
    public $noteObject = 'App\Libraries\NoteObject';
}
