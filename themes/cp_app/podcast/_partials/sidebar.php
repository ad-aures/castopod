<aside id="podcast-sidebar" class="sticky hidden col-span-1 sm:block top-12">
    <div class="absolute z-0 w-full h-full sm:hidden bg-pine-800/50"></div>
    <div class="z-10 bg-pine-50">
        <a href="<?= route_to('podcast_feed', $podcast->handle) ?>" class="inline-flex items-center mb-6 text-sm font-semibold text-pine-800 group" target="_blank" rel="noopener noreferrer">
            <?= icon('rss', ' mr-2 bg-orange-500 text-xl text-white group-hover:bg-orange-700 p-1 w-6 h-6 inline-flex items-center justify-center rounded-lg') . lang('Podcast.feed') ?>
        </a>
        <?php if (
            in_array(true, array_column($podcast->socialPlatforms, 'is_visible'), true)
        ): ?>
        <h2 class="mb-2 font-bold font-display text-pine-900"> <?= lang('Podcast.find_on', [
            'podcastTitle' => $podcast->title,
        ]) ?></h2>
        <div class="grid items-center justify-center grid-cols-6 gap-3 mb-6">
        <?php foreach ($podcast->socialPlatforms as $socialPlatform): ?>
            <?php if ($socialPlatform->is_visible): ?>
                <?= anchor(
            $socialPlatform->link_url,
            icon("{$socialPlatform->type}/{$socialPlatform->slug}"),
            [
                'class' => 'text-2xl text-gray-500 hover:text-gray-700 w-8 h-8 items-center inline-flex justify-center',
                'target' => '_blank',
                'rel' => 'noopener noreferrer',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
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
        <h2 class="mb-2 font-bold font-display text-pine-900"><?= lang('Podcast.listen_on') ?></h2>
        <div class="grid items-center justify-center grid-cols-6 gap-3 mb-6">
            <?php foreach ($podcast->podcastingPlatforms as $podcastingPlatform): ?>
                <?php if ($podcastingPlatform->is_visible): ?>
                    <?= anchor(
            $podcastingPlatform->link_url,
            icon(
                "{$podcastingPlatform->type}/{$podcastingPlatform->slug}",
            ),
            [
                'class' => 'text-2xl text-gray-500 hover:text-gray-700 w-8 h-8 items-center inline-flex justify-center',
                'target' => '_blank',
                'rel' => 'noopener noreferrer',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => $podcastingPlatform->label,
            ],
        ) ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <footer class="flex flex-col items-center py-2 text-xs text-center text-gray-600 border-t">
            <?= render_page_links('inline-flex mb-2 flex-wrap gap-y-1') ?>
            <div class="flex flex-col">
                <p><?= $podcast->copyright ?></p>
                <p><?= lang('Common.powered_by', [
                    'castopod' =>
                        '<a class="inline-flex font-semibold text-gray-500 hover:underline" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod' . icon('social/castopod', 'ml-1 text-lg') . '</a>',
                ]) ?></p>
            </div>
        </footer>
    </div>
</aside>