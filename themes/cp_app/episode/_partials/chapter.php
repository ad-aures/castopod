<article class="flex p-2 gap-x-2">
    <img src="<?= $chapterImgUrl ?>" class="w-20 h-20 rounded-lg aspect-square" loading="lazy" />
    <div class="flex flex-col">
        <div class="flex items-baseline gap-x-2">
            <span class="px-1 text-sm font-semibold rounded bg-subtle"><?= $startTime ?></span><?= $title ?>
        </div>
        <?php if ($chapterUrl !== ''): ?>
            <a class="inline-flex items-baseline mt-1 text-sm underline text-skin-muted hover:no-underline" href='<?= $chapterUrl ?>' target='_blank' rel="noopener noreferrer"><?= $chapterUrl ?><?= icon('external-link', 'sm:ml-1 sm:text-base sm:opacity-60') ?></a>
        <?php endif; ?>
    </div>
</article>
