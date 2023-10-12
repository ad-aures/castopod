<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('PodcastImport.syncForm.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('PodcastImport.syncForm.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<form action="<?= route_to('podcast-imports-sync', $podcast->id) ?>" method="POST" class="flex flex-col max-w-sm gap-y-4" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <Forms.Field
        name="feed_url"
        label="<?= lang('PodcastImport.syncForm.feed_url') ?>"
        hint="<?= lang('PodcastImport.syncForm.feed_url_hint') ?>"
        required="true"
        value="<?= $podcast->imported_feed_url ?? '' ?>"
    />
    <Button variant="primary" class="self-end" type="submit"><?= lang('PodcastImport.syncForm.submit') ?></Button>
</form>

<?= $this->endSection() ?>
