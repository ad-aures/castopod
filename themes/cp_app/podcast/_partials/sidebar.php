<div data-sidebar-toggler="backdrop" class="absolute top-0 left-0 z-10 hidden w-full h-full bg-backdrop/75 md:hidden" role="button" tabIndex="0" aria-label="<?= lang('Common.close') ?>"></div>
<aside id="podcast-sidebar" data-sidebar-toggler="sidebar" data-toggle-class="hidden" data-hide-class="hidden" class="z-20 hidden h-full col-span-1 col-start-2 row-start-1 p-4 py-6 shadow-2xl md:shadow-none md:block bg-base">
    <div class="sticky z-10 bg-base top-12">
        <a href="<?= $podcast->feed_url ?>" class="inline-flex items-center mb-6 text-sm font-semibold focus:ring-accent text-skin-muted hover:text-skin-base group" target="_blank" rel="noopener noreferrer">
            <?= icon('rss', ' mr-2 bg-orange-500 text-xl text-white group-hover:bg-orange-700 p-1 w-6 h-6 inline-flex items-center justify-center rounded-lg') . lang('Podcast.feed') ?>
        </a>
        <?php if (
            in_array(true, array_column($podcast->socialPlatforms, 'is_visible'), true)
        ): ?>
        <h2 class="text-sm font-bold font-display text-accent-muted"> <?= lang('Podcast.find_on', [
            'podcastTitle' => esc($podcast->title),
        ]) ?></h2>
        <div class="grid items-center justify-center grid-cols-6 gap-3 mb-6">
        <?php foreach ($podcast->socialPlatforms as $socialPlatform): ?>
            <?php if ($socialPlatform->is_visible): ?>
                <?= anchor(
            esc($socialPlatform->link_url),
            icon(
                esc($socialPlatform->slug),
                '',
                $socialPlatform->type
            ),
            [
                'class' => 'text-2xl text-skin-muted hover:text-skin-base w-8 h-8 items-center inline-flex justify-center',
                'target' => '_blank',
                'rel' => 'noopener noreferrer',
                'data-tooltip' => 'bottom',
                'title' => $socialPlatform->label,
            ],
        ) ?>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (
            in_array(true, array_column($podcast->podcastingPlatforms, 'is_visible'), true)
        ): ?>
        <h2 class="text-sm font-bold font-display text-accent-muted"><?= lang('Podcast.listen_on') ?></h2>
        <div class="grid items-center justify-center grid-cols-6 gap-3 mb-6">
            <?php foreach ($podcast->podcastingPlatforms as $podcastingPlatform): ?>
                <?php if ($podcastingPlatform->is_visible): ?>
                    <?= anchor(
            esc($podcastingPlatform->link_url),
            icon(
                esc($podcastingPlatform->slug),
                '',
                $podcastingPlatform->type
            ),
            [
                'class' => 'text-2xl text-skin-muted hover:text-skin-base w-8 h-8 items-center inline-flex justify-center',
                'target' => '_blank',
                'rel' => 'noopener noreferrer',
                'data-tooltip' => 'bottom',
                'title' => $podcastingPlatform->label,
            ],
        ) ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <footer class="flex flex-col items-center py-2 text-xs text-center border-t border-subtle text-skin-muted">
            <?= render_page_links('inline-flex mb-2 flex-wrap gap-y-1 justify-center') ?>
            <div class="flex flex-col">
                <p><?= esc($podcast->copyright) ?></p>
                <p><?= lang('Common.powered_by', [
                    'castopod' =>
                        '<a class="inline-flex font-semibold text-skin-muted hover:underline focus:ring-accent" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod' . icon('castopod', 'ml-1 text-lg', 'social') . '</a>',
                ], null, false) ?></p>
            </div>
        </footer>
    </div>
</aside>