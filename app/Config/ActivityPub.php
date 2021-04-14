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

    /**
     * --------------------------------------------------------------------
     * Default avatar and cover images
     * --------------------------------------------------------------------
     */
    public $defaultAvatarImagePath = 'assets/images/castopod-avatar-default.jpg';
    public $defaultAvatarImageMimetype = 'image/jpeg';

    public $defaultCoverImagePath = 'assets/images/castopod-cover-default.jpg';
    public $defaultCoverImageMimetype = 'image/jpeg';
}
