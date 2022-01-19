<?= $this->extend('podcast/_layout') ?>

<?= $this->section('content') ?>

<?php if ($episodes): ?>
    <div class="flex items-center justify-between px-2">
        <h1 class="font-semibold">
            <?php if ($activeQuery['type'] === 'year'): ?>
                <?= lang('Podcast.list_of_episodes_year', [
    'year' => $activeQuery['value'],
                    'episodeCount' => count($episodes),
]) ?>
            <?php elseif ($activeQuery['type'] === 'season'): ?>
                <?= lang('Podcast.list_of_episodes_season', [
    'seasonNumber' => $activeQuery['value'],
                    'episodeCount' => count($episodes),
]) ?>
            <?php endif; ?>
        </h1>
        <?php if ($activeQuery): ?>
            <button id="episode-lists-dropdown" type="button" class="inline-flex items-center px-2 py-1 text-sm font-semibold focus:ring-accent" data-dropdown="button" data-dropdown-target="episode-lists-dropdown-menu" aria-label="<?= lang('Common.more') ?>" aria-haspopup="true" aria-expanded="false">
                <?= $activeQuery['label'] . icon('caret-down', 'ml-2 text-xl') ?>
            </button>
            <nav id="episode-lists-dropdown-menu" class="flex flex-col py-2 rounded-lg shadow border-3 border-contrast bg-elevated" aria-labelledby="episode-lists-dropdown" data-dropdown="menu" data-dropdown-placement="bottom-end">
                <?php foreach ($episodesNav as $link): ?>
                    <?= anchor(
    $link['route'],
    $link['label'] . ' (' . $link['number_of_episodes'] . ')',
    [
        'class' =>
            'px-2 py-1 whitespace-nowrap hover:bg-highlight ' .
            ($link['is_active']
                ? 'font-semibold'
                : 'text-skin-muted hover:text-skin-base'),
    ],
) ?>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>
    </div>
    <div class="flex flex-col mt-4 gap-y-4">
        <?php foreach ($episodes as $episode): ?>
            <?= view('episode/_partials/card', [
                'episode' => $episode,
                'podcast' => $podcast,
            ]) ?>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <h1 class="px-4 mb-2 text-xl text-center"><?= lang(
                'Podcast.no_episode',
            ) ?></h1>
<?php endif; ?>

<?= $this->endSection()
?>
