<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= $page->title ?>
<a class="inline-flex items-center px-2 py-1 mb-2 ml-4 text-sm text-white bg-teal-500 rounded shadow-xs outline-none hover:bg-teal-600 focus:shadow-outline" href="<?= route_to(
    'page-edit',
    $page->id
) ?>">
<?= icon('edit', 'mr-2') ?>
<?= lang('Page.edit') ?></a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="prose">
    <?= $page->content_html ?>
</div>
<?= $this->endSection() ?>
