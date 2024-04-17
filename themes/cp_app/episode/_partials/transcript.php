<article class="flex flex-col items-baseline p-2 sm:flex-row gap-x-2">
    <span class="px-1 text-sm font-semibold rounded bg-subtle"><?= $startTime ?></span>
    <p>
        <?php if ($speaker !== ''): ?>
            <span class="mr-1 font-bold"><?= $speaker ?></span>
        <?php endif; ?>
        <?= $text ?>
    </p>
</article>
