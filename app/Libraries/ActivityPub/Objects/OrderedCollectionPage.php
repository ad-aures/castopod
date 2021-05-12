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

use CodeIgniter\Pager\Pager;
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
     * @var string|null
     */
    protected $prev;

    /**
     * @var string|null
     */
    protected $next;

    public function __construct(Pager $pager, ?array $orderedItems = null)
    {
        parent::__construct($orderedItems, $pager);

        $isFirstPage = $pager->getCurrentPage() === $pager->getFirstPage();
        $isLastPage = $pager->getCurrentPage() === $pager->getLastPage();
        if ($isFirstPage) {
            $this->first = null;
        }
        if ($isLastPage) {
            $this->last = null;
        }

        $this->id = $pager->getPageURI($pager->getCurrentPage());
        $this->partOf = $pager->getPageURI();
        $this->prev = $pager->getPreviousPageURI();
        $this->current = $pager->getPageURI($pager->getCurrentPage());
        $this->next = $pager->getNextPageURI();
    }
}
