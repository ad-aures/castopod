<?php helper('html'); ?>

<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.all_podcasts') ?> (<?= count($podcasts) ?>)
<a class="inline-flex items-center px-2 py-1 mb-2 ml-4 text-sm text-white bg-green-500 rounded shadow-xs outline-none hover:bg-green-600 focus:shadow-outline" href="<?= route_to(
    'podcast_create'
) ?>">
<?= icon('add', 'mr-2') ?>
<?= lang('Podcast.create') ?></a>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="flex flex-wrap">
    <?php if (!empty($podcasts)): ?>
        <?php foreach ($podcasts as $podcast): ?>
            <?= view('admin/_partials/_podcast-card', [
                'podcast' => $podcast,
            ]) ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="italic"><?= lang('Podcast.no_podcast') ?></p>
    <?php endif; ?>
</div>

<?= $this->endSection()
?>
