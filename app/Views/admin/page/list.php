<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Page.all_pages') ?> (<?= count($pages) ?>)
<a class="inline-flex items-center px-2 py-1 mb-2 ml-4 text-sm text-white bg-green-500 rounded shadow-xs outline-none hover:bg-green-600 focus:shadow-outline" href="<?= route_to(
    'page-create'
) ?>">
<?= icon('add', 'mr-2') ?>
<?= lang('Page.create') ?></a>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<table class="table-auto">
    <thead>
        <tr>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Slug</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pages as $page): ?>
        <tr>
            <td class="px-4 py-2 border"><?= $page->title ?></td>
            <td class="px-4 py-2 border"><?= $page->slug ?></td>
            <td class="px-4 py-2 border">
                <a class="inline-flex px-2 py-1 mb-2 text-sm text-white bg-gray-700 hover:bg-gray-800" href="<?= route_to(
                    'page',
                    $page->slug
                ) ?>"><?= lang('Page.go_to_page') ?></a>
                <a class="inline-flex px-2 py-1 mb-2 text-sm text-white bg-teal-700 hover:bg-teal-800" href="<?= route_to(
                    'page-edit',
                    $page->id
                ) ?>"><?= lang('Page.edit') ?></a>
                <a class="inline-flex px-2 py-1 text-sm text-white bg-red-700 hover:bg-red-800" href="<?= route_to(
                    'page-delete',
                    $page->id
                ) ?>"><?= lang('Page.delete') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
