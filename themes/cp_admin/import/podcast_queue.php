<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.all_imports') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.all_imports') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php // @icon("loop-left-fill")?>
<Button uri="<?= route_to('podcast-imports-sync', $podcast->id) ?>" variant="primary" iconLeft="loop-left-fill"><?= lang('PodcastImport.syncForm.title') ?></Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('import/_queue_table'); ?>

<?= $this->endSection() ?>
