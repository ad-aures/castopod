<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.podcast_contributors') ?>
<a class="inline-flex items-center px-2 py-1 mb-2 ml-2 text-sm text-white bg-green-500 rounded shadow-xs outline-none hover:bg-green-600 focus:shadow-outline" href="<?= route_to(
    'contributor_add',
    $podcast->id
) ?>">
<?= icon('add', 'mr-2') ?>
<?= lang('Contributor.add') ?></a>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<table class="table-auto">
    <thead>
        <tr>
            <th class="px-4 py-2">Username</th>
            <th class="px-4 py-2">Role</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($podcast->contributors as $contributor): ?>
        <tr>
            <td class="px-4 py-2 border"><?= $contributor->username ?></td>
            <td class="px-4 py-2 border"><?= $contributor->podcast_role ?></td>
            <td class="px-4 py-2 border">
                <a class="inline-flex px-2 py-1 mb-2 text-sm text-white bg-teal-700 hover:bg-teal-800" href="<?= route_to(
                    'contributor_edit',
                    $podcast->id,
                    $contributor->id
                ) ?>"><?= lang('Contributor.edit') ?></a>
                <a class="inline-flex px-2 py-1 text-sm text-white bg-red-700 hover:bg-red-800" href="<?= route_to(
                    'contributor_remove',
                    $podcast->id,
                    $contributor->id
                ) ?>"><?= lang('Contributor.remove') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
