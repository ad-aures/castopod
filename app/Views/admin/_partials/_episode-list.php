<div class="flex flex-col py-4">
    <?php if ($episodes): ?>
        <?php foreach ($episodes as $episode): ?>
            <?= view('admin/_partials/_episode-card', [
                'episode' => $episode,
            ]) ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="italic"><?= lang('Podcast.no_episode') ?></p>
    <?php endif; ?>
</div>