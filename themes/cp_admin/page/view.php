<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= $page->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $page->title ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button variant="primary" uri="<?= route_to('page-edit', $page->id) ?>" iconLeft="add"><?= lang('Page.edit') ?></Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="prose">
    <?= $page->content_html ?>
</div>
<?= $this->endSection() ?>
