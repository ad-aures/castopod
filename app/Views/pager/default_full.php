<?php declare(strict_types=1);

use CodeIgniter\Pager\PagerRenderer;

/** @var PagerRenderer $pager */
$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="flex justify-center">
        <?php if ($pager->hasPreviousPage()): ?>
            <li>
                <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang(
                    'Pager.first',
                ) ?>"  class="block px-3 py-2 text-skin-muted hover:bg-highlight">
                    <span aria-hidden="true"><?= lang('Pager.first') ?></span>
                </a>
            </li>
            <li>
                <a href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang(
                    'Pager.previous',
                ) ?>" class="block px-3 py-2 text-skin-muted hover:bg-highlight">
                    <span aria-hidden="true"><?= lang(
                        'Pager.previous',
                    ) ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php foreach ($pager->links() as $link): ?>
            <li>
                <?php if ($link['active']): ?>
                    <span class="block px-4 py-2 font-semibold rounded-full text-accent-contrast bg-accent-base">
                        <?= $link['title'] ?>
                    </span>
                <?php else: ?>
                    <a href="<?= $link['uri'] ?>" class="block px-4 py-2 rounded-full text-skin-muted hover:bg-highlight">
                        <?= $link['title'] ?>
                    </a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>

        <?php if ($pager->hasNextPage()): ?>
            <li>
                <a href="<?= $pager->getNextPage() ?>" aria-label="<?= lang(
                    'Pager.next',
                ) ?>" class="block px-3 py-2 text-skin-muted hover:bg-highlight">
                    <span aria-hidden="true"><?= lang('Pager.next') ?></span>
                </a>
            </li>
            <li>
                <a href="<?= $pager->getLast() ?>" aria-label="<?= lang(
                    'Pager.last',
                ) ?>" class="block px-3 py-2 text-skin-muted hover:bg-highlight">
                    <span aria-hidden="true"><?= lang('Pager.last') ?></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
