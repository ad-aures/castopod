<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.edit_roles', ['username' => $user->username]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to(
    'user_edit',
    $user->id
) ?>" method="post" class="flex flex-col max-w-lg">
    <?= csrf_field() ?>

    <label for="roles"><?= lang('User.form.roles') ?></label>
    <select id="roles" name="roles[]" autocomplete="off" class="mb-6 form-multiselect" multiple>
        <?php foreach ($roles as $role): ?>
            <option value="<?= $role->id ?>"
            <?php if (
                in_array($role->name, $user->roles)
            ): ?> selected <?php endif; ?>>
                <?= $role->name ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit" class="px-4 py-2 ml-auto border">
        <?= lang('User.form.submit_edit') ?>
    </button>
</form>

<?= $this->endSection() ?>
