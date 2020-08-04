<?php helper('html'); ?>

<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.all_users') ?> (<?= count($users) ?>)
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<table class="table-auto">
    <thead>
        <tr>
            <th class="px-4 py-2">Username</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Roles</th>
            <th class="px-4 py-2">Banned?</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td class="px-4 py-2 border"><?= $user->username ?></td>
            <td class="px-4 py-2 border"><?= $user->email ?></td>
            <td class="px-4 py-2 border">
                [<?= implode(', ', $user->roles) ?>]
                <a class="inline-flex p-2 mr-2 text-teal-700 bg-teal-100 rounded-full shadow-xs hover:bg-teal-200" href="<?= route_to(
                    'user_edit',
                    $user->id
                ) ?>" data-toggle="tooltip" data-placement="bottom"
                title="<?= lang('User.edit_roles', [
                    'username' => $user->username,
                ]) ?>">
                <?= icon('edit') ?>
                </a>
            </td>
            <td class="px-4 py-2 border"><?= $user->isBanned()
                ? 'Yes'
                : 'No' ?></td>
            <td class="px-4 py-2 border">
                <a class="inline-flex px-2 py-1 mb-2 text-sm text-white bg-gray-700 hover:bg-gray-800" href="<?= route_to(
                    'user_force_pass_reset',
                    $user->id
                ) ?>"><?= lang('User.forcePassReset') ?></a>
                <a class="inline-flex px-2 py-1 mb-2 text-sm text-white bg-orange-700 hover:bg-orange-800" href="<?= route_to(
                    $user->isBanned() ? 'user_unban' : 'user_ban',
                    $user->id
                ) ?>">
                <?= $user->isBanned()
                    ? lang('User.unban')
                    : lang('User.ban') ?></a>
                <a class="inline-flex px-2 py-1 text-sm text-white bg-red-700 hover:bg-red-800" href="<?= route_to(
                    'user_delete',
                    $user->id
                ) ?>"><?= lang('User.delete') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection()
?>
