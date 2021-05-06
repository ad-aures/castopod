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

use ActivityPub\Core\Activity;
use CodeIgniter\Pager\Pager;
use ActivityPub\Core\ObjectType;

class OrderedCollectionObject extends ObjectType
{
    /**
     * @var string
     */
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
     * @param array $orderedItems
     */
    public function __construct(
        ?array $orderedItems = null,
        ?Pager $pager = null
    ) {
        $this->id = current_url();

        if ($pager !== null) {
            $totalItems = $pager->getTotal();
            $this->totalItems = $totalItems;

            if ($totalItems !== 0) {
                $this->first = $pager->getPageURI($pager->getFirstPage());
                $this->current = $pager->getPageURI();
                $this->last = $pager->getPageURI($pager->getLastPage());
            }
        }

        $this->orderedItems = $orderedItems;
    }
}
