<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= $page->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="prose">
    <?= $page->content_html ?>
</div>
<?= $this->endSection() ?>
