<?php namespace Config;

use App\Libraries\PodcastActor;
use App\Libraries\NoteObject;
use ActivityPub\Config\ActivityPub as ActivityPubBase;

class ActivityPub extends ActivityPubBase
{
    /**
     * --------------------------------------------------------------------
     * ActivityPub Objects
     * --------------------------------------------------------------------
     * @var string
     */
    public $actorObject = PodcastActor::class;
    /**
     * @var string
     */
    public $noteObject = NoteObject::class;

    /**
     * --------------------------------------------------------------------
     * Default avatar and cover images
     * --------------------------------------------------------------------
     * @var string
     */
    public $defaultAvatarImagePath = 'assets/images/castopod-avatar-default.jpg';
    /**
     * @var string
     */
    public $defaultAvatarImageMimetype = 'image/jpeg';

    /**
     * @var string
     */
    public $defaultCoverImagePath = 'assets/images/castopod-cover-default.jpg';
    /**
     * @var string
     */
    public $defaultCoverImageMimetype = 'image/jpeg';
}
