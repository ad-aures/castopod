<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.edit_role', [$user->username]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<form action="<?= route_to(
    'contributor_edit',
    $podcast->id,
    $user->id
) ?>" method="post" class="flex flex-col max-w-lg">
    <?= csrf_field() ?>

    <div class="flex flex-col mb-4">
        <label for="category"><?= lang('Contributor.form.role') ?></label>
        <select id="role" name="role" autocomplete="off" class="form-select" required>
            <?php foreach ($roles as $role): ?>
                <option value="<?= $role->id ?>"
                <?php if (
                    old('role') == $role->id
                ): ?> selected <?php endif; ?>>
                    <?= $role->name ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" name="submit" class="self-end px-4 py-2 bg-gray-200"><?= lang(
        'Contributor.form.submit_edit'
    ) ?></button>

</form>
<?= $this->endSection() ?>
