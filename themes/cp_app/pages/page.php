<?= $this->extend('pages/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.credits') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="prose prose-brand">
        <?= $page->content_html ?>
    </div>
<?= $this->endSection() ?>