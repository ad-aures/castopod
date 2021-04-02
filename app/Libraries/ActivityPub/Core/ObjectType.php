<?php

/**
 * This class defines the Object which is the
 * primary base type for the Activity Streams vocabulary.
 *
 * Object is a reserved word in php, so the class is named ObjectType.
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Core;

class ObjectType extends AbstractObject
{
    /**
     * @var array|string
     */
    protected $context = 'https://www.w3.org/ns/activitystreams';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $type = 'Object';

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $published;

    /**
     * @var array
     */
    protected $to = ['https://www.w3.org/ns/activitystreams#Public'];

    /**
     * @var array
     */
    protected $cc;
}
