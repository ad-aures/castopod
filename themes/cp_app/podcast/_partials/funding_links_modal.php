<div id="funding-links" class="fixed top-0 left-0 z-50 flex items-center justify-center hidden w-screen h-screen">
    <div
    class="absolute w-full h-full bg-backdrop/75"
    role="button"
    data-toggle="funding-links"
    data-toggle-class="hidden"
    aria-label="<?= lang('Common.close') ?>"></div>
    <div class="z-10 w-full max-w-xl rounded-lg shadow-2xl bg-elevated">
        <div class="flex justify-between px-4 py-2 border-b border-subtle">
            <h3 class="self-center text-lg"><?= lang('Podcast.funding_links', [
                'podcastTitle' => esc($podcast->title),
            ]) ?></h3>
            <button
            data-toggle="funding-links"
            data-toggle-class="hidden"
            aria-label="<?= lang('Common.close') ?>"
            class="self-start p-1 text-2xl rounded-full focus:ring-accent"><?= icon('close') ?></button>
        </div>
        <div class="flex flex-col items-start p-4 space-y-4 overflow-hidden">
            <?php foreach ($podcast->fundingPlatforms as $fundingPlatform): ?>
                <?php if ($fundingPlatform->is_visible): ?>
                    <a
                    href="<?= esc($fundingPlatform->link_url) ?>"
                    title="<?= esc($fundingPlatform->account_id) ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center w-full font-semibold text-accent-base hover:text-accent-hover focus:ring-accent">
                    <?= icon(
                esc($fundingPlatform->slug),
                'mr-2 flex-shrink-0',
                $fundingPlatform->type
            ) . '<span class="truncate">' . esc($fundingPlatform->link_url) . '</span>' ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>