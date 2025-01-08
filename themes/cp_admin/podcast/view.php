<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= esc($podcast->title) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= esc($podcast->title) ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php
// @icon("pencil-fill")
// @icon("add-fill")
?>
<Button uri="<?= route_to('podcast-edit', $podcast->id) ?>" variant="secondary" class="[&>span]:hidden [&>span]:md:block py-3 md:py-2" iconLeft="pencil-fill"><?= lang('Podcast.edit') ?></Button>
<Button uri="<?= route_to('episode-create', $podcast->id) ?>" variant="primary" class="[&>span]:hidden [&>span]:md:block py-3 md:py-2" iconLeft="add-fill"><?= lang('Episode.create') ?></Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= view_cell('Modules\Admin\Controllers\PodcastController::latestEpisodes', [
    'limit'     => 5,
    'podcastId' => $podcast->id,
]) ?>

<?= $this->endSection() ?>
