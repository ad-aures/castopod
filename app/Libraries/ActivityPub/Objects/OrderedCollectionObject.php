<?php

/**
 * This class defines a Paginated OrderedCollection
 * based on CodeIgniter4 Pager to get the pagination metadata
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Objects;

use ActivityPub\Core\ObjectType;

class OrderedCollectionObject extends ObjectType
{
    protected $type = 'OrderedCollection';

    /**
     * @var integer
     */
    protected $totalItems;

    /**
     * @var integer|null
     */
    protected $first;

    /**
     * @var integer|null
     */
    protected $current;

    /**
     * @var integer|null
     */
    protected $last;

    /**
     * @var array|null
     */
    protected $orderedItems;

    /**
     * @param \ActivityPub\Libraries\ActivityPub\Activity[] $orderedItems
     * @param \CodeIgniter\Pager\Pager $pager
     */
    public function __construct($orderedItems, $pager = null)
    {
        $this->id = current_url();

        if ($pager) {
            $totalItems = $pager->getTotal();
            $this->totalItems = $totalItems;

            if ($totalItems) {
                $this->first = $pager->getPageURI($pager->getFirstPage());
                $this->current = $pager->getPageURI();
                $this->last = $pager->getPageURI($pager->getLastPage());
            }
        }

        $this->orderedItems = $orderedItems;
    }
}
