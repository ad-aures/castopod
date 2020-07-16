<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.podcast_contributors') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<a class="inline-block px-4 py-2 mb-2 border hover:bg-gray-100" href="<?= route_to(
    'contributor_add',
    $podcast->id
) ?>"><?= lang('Contributor.add') ?></a>

<table class="table-auto">
    <thead>
        <tr>
            <th class="px-4 py-2">Username</th>
            <th class="px-4 py-2">Permissions</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($podcast->contributors as $contributor): ?>
        <tr>
            <td class="px-4 py-2 border"><?= $contributor->username ?></td>
            <td class="px-4 py-2 border">[<?= implode(
                ', ',
                $contributor->permissions
            ) ?>]</td>
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
