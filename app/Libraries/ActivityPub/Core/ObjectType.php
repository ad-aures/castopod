<?php

/**
 * This class defines the Object which is the primary base type for the Activity Streams vocabulary.
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
     * @var string|string[]
     */
    protected string | array $context = 'https://www.w3.org/ns/activitystreams';

    protected string $id;

    protected string $type = 'Object';

    protected string $content;

    protected string $published;

    /**
     * @var string[]
     */
    protected array $to = ['https://www.w3.org/ns/activitystreams#Public'];

    /**
     * @var string[]|null
     */
    protected ?array $cc = null;
}
