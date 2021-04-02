<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= $page->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $page->title ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= button(lang('Page.edit'), route_to('page-edit', $page->id), [
    'variant' => 'accent',
    'iconLeft' => 'add',
]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="prose">
    <?= $page->content_html ?>
</div>
<?= $this->endSection() ?>
