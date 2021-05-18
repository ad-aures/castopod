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
     */
    public string $actorObject = PodcastActor::class;

    public string $noteObject = NoteObject::class;

    /**
     * --------------------------------------------------------------------
     * Default avatar and cover images
     * --------------------------------------------------------------------
     */
    public string $defaultAvatarImagePath = 'assets/images/castopod-avatar-default.jpg';

    public string $defaultAvatarImageMimetype = 'image/jpeg';

    public string $defaultCoverImagePath = 'assets/images/castopod-cover-default.jpg';

    public string $defaultCoverImageMimetype = 'image/jpeg';
}
