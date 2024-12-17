<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.all_imports') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php // @icon("add-fill")?>
<x-Button uri="<?= route_to('podcast-imports-add') ?>" variant="primary" iconLeft="add-fill"><?= lang('Podcast.import') ?></x-Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->include('import/_queue_table'); ?>

<?= $this->endSection() ?>
