<?php

declare(strict_types=1);

/**
 * This class defines a Paginated OrderedCollection based on CodeIgniter4 Pager to get the pagination metadata
 *
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Objects;

use CodeIgniter\Pager\Pager;
use Modules\Fediverse\Core\ObjectType;

class OrderedCollectionObject extends ObjectType
{
    protected string $type = 'OrderedCollection';

    protected int $totalItems;

    protected ?string $first = null;

    protected ?string $current = null;

    protected ?string $last = null;

    /**
     * @param ObjectType[]|list<string>|null $orderedItems
     */
    public function __construct(
        protected ?array $orderedItems = null,
        ?Pager $pager = null,
    ) {
        $this->id = current_url();

        if ($pager instanceof Pager) {
            $totalItems = $pager->getTotal();
            $this->totalItems = $totalItems;

            if ($totalItems !== 0) {
                $this->first = $pager->getPageURI($pager->getFirstPage());
                $this->current = $pager->getPageURI();
                $this->last = $pager->getPageURI($pager->getLastPage());
            }
        }
    }
}
