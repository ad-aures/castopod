<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.all_podcasts') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.all_podcasts') ?> (<?= count($podcasts) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php
// @icon("import-fill")
// @icon("add-fill")
?>
<Button uri="<?= route_to('podcast-imports-add') ?>" variant="secondary" iconLeft="import-fill"><?= lang('Podcast.import') ?></Button>
<Button uri="<?= route_to('podcast-create') ?>" variant="primary" iconLeft="add-fill"><?= lang('Podcast.create') ?></Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="grid gap-4 grid-cols-cards">
    <?php if ($podcasts !== []): ?>
        <?php foreach ($podcasts as $podcast): ?>
            <?= view('podcast/_card', [
                'podcast' => $podcast,
            ]) ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="italic"><?= lang('Podcast.no_podcast') ?></p>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
