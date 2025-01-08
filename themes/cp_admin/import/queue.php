<?php declare(strict_types=1);

?>
<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.all_imports') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.all_imports') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php // @icon("add-fill")?>
<Button uri="<?= route_to('podcast-imports-add') ?>" variant="primary" iconLeft="add-fill"><?= lang('Podcast.import') ?></Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->include('import/_queue_table'); ?>

<?= $this->endSection() ?>
