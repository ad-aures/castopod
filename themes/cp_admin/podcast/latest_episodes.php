<section class="flex flex-col">
    <header class="flex justify-between py-2">
        <Heading tagName="h2"><?= lang('Podcast.latest_episodes') ?></Heading>
        <a href="<?= route_to(
    'episode-list',
    $podcast->id,
) ?>" class="inline-flex items-center text-sm underline hover:no-underline focus:ring-castopod">
            <?= lang('Podcast.see_all_episodes') ?>
            <?= icon('chevron-right', 'ml-2') ?>
        </a>
    </header>
    <?php if ($episodes): ?>
        <div class="grid px-4 py-2 -mx-2 overflow-x-auto grid-cols-latestEpisodes gap-x-4 snap snap-x snap-proximity">
        <?php foreach ($episodes as $episode): ?>
            <?= view('episode/_card', [
                'episode' => $episode,
            ]) ?>
        <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="italic"><?= lang('Podcast.no_episode') ?></p>
    <?php endif; ?>
</section>
