<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="flex justify-center">
        <?php if ($pager->hasPreviousPage()): ?>
            <li>
                <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang(
    'Pager.first',
) ?>"  class="block px-3 py-2 text-gray-700 hover:bg-gray-200 hover:text-black">
                    <span aria-hidden="true"><?= lang('Pager.first') ?></span>
                </a>
            </li>
            <li>
                <a href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang(
    'Pager.previous',
) ?>" class="block px-3 py-2 text-gray-700 hover:bg-gray-200 hover:text-black">
                    <span aria-hidden="true"><?= lang(
                        'Pager.previous',
                    ) ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php foreach ($pager->links() as $link): ?>
            <li>
                <?php if ($link['active']): ?>
                    <span class="block px-4 py-2 font-semibold text-white rounded-full bg-pine-600">
                        <?= $link['title'] ?>
                    </span>
                <?php else: ?>
                    <a href="<?= $link[
                        'uri'
                    ] ?>" class="block px-4 py-2 text-gray-700 rounded-full hover:bg-gray-200 hover:text-black">
                        <?= $link['title'] ?>
                    </a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>

        <?php if ($pager->hasNextPage()): ?>
            <li>
                <a href="<?= $pager->getNextPage() ?>" aria-label="<?= lang(
    'Pager.next',
) ?>" class="block px-3 py-2 text-gray-700 hover:bg-gray-200 hover:text-black">
                    <span aria-hidden="true"><?= lang('Pager.next') ?></span>
                </a>
            </li>
            <li>
                <a href="<?= $pager->getLast() ?>" aria-label="<?= lang(
    'Pager.last',
) ?>" class="block px-3 py-2 text-gray-700 hover:bg-gray-200 hover:text-black">
                    <span aria-hidden="true"><?= lang('Pager.last') ?></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
