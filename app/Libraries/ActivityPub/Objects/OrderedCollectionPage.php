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

class OrderedCollectionPage extends OrderedCollectionObject
{
    /**
     * @var string
     */
    protected $type = 'OrderedCollectionPage';

    /**
     * @var string
     */
    protected $partOf;

    /**
     * @var integer
     */
    protected $prev;

    /**
     * @var integer
     */
    protected $next;

    /**
     * @param \CodeIgniter\Pager\Pager $pager
     * @param \ActivityPub\Libraries\ActivityPub\Activity[] $orderedItems
     */
    public function __construct($pager, $orderedItems)
    {
        parent::__construct($orderedItems, $pager);

        $isFirstPage = $pager->getCurrentPage() === $pager->getFirstPage();
        $isLastPage = $pager->getCurrentPage() === $pager->getLastPage();
        $isFirstPage && ($this->first = null);
        $isLastPage && ($this->last = null);

        $this->id = $pager->getPageURI($pager->getCurrentPage());
        $this->partOf = $pager->getPageURI();
        $this->prev = $pager->getPreviousPageURI();
        $this->current = $pager->getPageURI($pager->getCurrentPage());
        $this->next = $pager->getNextPageURI();
    }
}
