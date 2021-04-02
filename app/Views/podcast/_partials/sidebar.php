<aside id="main-sidebar" class="fixed top-0 right-0 flex flex-col items-start flex-shrink-0 w-64 h-screen px-6 py-4 overflow-y-auto transform translate-x-full lg:sticky lg:translate-x-0">
    <?php if (
        array_search(
            true,
            array_column($podcast->fundingPlatforms, 'is_visible'),
        ) !== false
    ): ?>
    <h2 class="mb-2 text-sm font-semibold"><?= lang(
        'Podcast.sponsor_title',
    ) ?></h2>
    <button
    class="inline-flex items-center px-2 py-1 mb-8 text-sm font-semibold text-gray-600 border rounded-full shadow-sm focus:outline-none focus:ring focus:ring-pine-600 hover:bg-rose-200 hover:text-gray-800 border-rose-600 bg-rose-100"
    data-toggle="funding-links"
    data-toggle-class="hidden"><?= icon('heart', 'mr-2 text-rose-600') .
        lang('Podcast.sponsor') ?></button>
    <?php endif; ?>

    <?php if (
        array_search(
            true,
            array_column($podcast->socialPlatforms, 'is_visible'),
        ) !== false
    ): ?>
    <h2 class="mb-2 text-sm font-semibold"> <?= lang('Podcast.find_on', [
        'podcastTitle' => $podcast->title,
    ]) ?></h2>
    <div class="grid items-center justify-center grid-cols-5 gap-3 mb-8">
    <?php foreach ($podcast->socialPlatforms as $socialPlatform): ?>
        <?php if ($socialPlatform->is_visible): ?>
            <?= anchor(
                $socialPlatform->link_url,
                icon($socialPlatform->type . '/' . $socialPlatform->slug),
                [
                    'class' => 'text-2xl text-gray-500 hover:text-gray-700',
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

    <h2 class="mb-2 text-sm font-semibold"><?= lang('Podcast.listen_on') ?></h2>
    <div class="grid items-center justify-center grid-cols-5 gap-3 mb-8">
        <?= anchor(route_to('podcast_feed', $podcast->name), icon('rss'), [
            'class' =>
                'bg-yellow-500 text-xl text-yellow-900 hover:bg-yellow-600 w-8 h-8 inline-flex items-center justify-center rounded-lg',
            'target' => '_blank',
            'rel' => 'noopener noreferrer',
            'data-toggle' => 'tooltip',
            'data-placement' => 'bottom',
            'title' => lang('Podcast.feed'),
        ]) ?>
        <?php foreach ($podcast->podcastingPlatforms as $podcastingPlatform): ?>
            <?php if ($podcastingPlatform->is_visible): ?>
                <?= anchor(
                    $podcastingPlatform->link_url,
                    icon(
                        $podcastingPlatform->type .
                            '/' .
                            $podcastingPlatform->slug,
                    ),
                    [
                        'class' => 'text-2xl text-gray-500 hover:text-gray-700',
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
    <footer class="px-2 py-4 mt-auto text-gray-600 border-t">
        <div class="container flex flex-col justify-between mx-auto text-xs">
            <?= render_page_links('inline-flex mb-2') ?>
            <div class="flex flex-col">
                <p><?= $podcast->copyright ?></p>
                <p><?= lang('Common.powered_by', [
                    'castopod' =>
                        '<a class="underline hover:no-underline" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod</a>',
                ]) ?></p>
            </div>
        </div>
    </footer>
</aside>
