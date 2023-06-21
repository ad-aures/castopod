<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.all_imports') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.all_imports') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button uri="<?= route_to('podcast-imports-sync', $podcast->id) ?>" variant="primary" iconLeft="refresh" data-tooltip="bottom" title="<?= lang('Podcast.sync_feed_hint') ?>"><?= lang('Podcast.sync_feed') ?></Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= $this->include('import/_queue_table'); ?>

<?= $this->endSection() ?>
