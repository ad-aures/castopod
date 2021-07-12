<?php

declare(strict_types=1);

namespace Config;

use ActivityPub\Config\ActivityPub as ActivityPubBase;
use App\Libraries\NoteObject;

class ActivityPub extends ActivityPubBase
{
    /**
     * --------------------------------------------------------------------
     * ActivityPub Objects
     * --------------------------------------------------------------------
     */
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
