<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('PodcastImport.syncForm.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<form action="<?= route_to('podcast-imports-sync', $podcast->id) ?>" method="POST" class="flex flex-col max-w-sm gap-y-4" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <x-Forms.Field
        name="feed_url"
        label="<?= esc(lang('PodcastImport.syncForm.feed_url')) ?>"
        hint="<?= esc(lang('PodcastImport.syncForm.feed_url_hint')) ?>"
        isRequired="true"
        value="<?= $podcast->imported_feed_url ?? '' ?>"
    />
    <x-Button variant="primary" class="self-end" type="submit"><?= lang('PodcastImport.syncForm.submit') ?></x-Button>
</form>

<?= $this->endSection() ?>
