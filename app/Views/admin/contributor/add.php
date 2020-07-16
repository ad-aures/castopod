<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.add_contributor', [$podcast->title]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<form action="<?= route_to(
    'contributor_add',
    $podcast->id
) ?>" method="post" class="flex flex-col max-w-lg">
    <?= csrf_field() ?>
    
    <div class="flex flex-col mb-4">
        <label for="user"><?= lang('Contributor.form.user') ?></label>
        <select id="user" name="user" autocomplete="off" class="form-select" required>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user->id ?>"
                <?php if (
                    old('user') == $user->id
                ): ?> selected <?php endif; ?>>
                    <?= $user->username ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="flex flex-col mb-4">
        <label for="role"><?= lang('Contributor.form.role') ?></label>
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
        'Contributor.form.submit_add'
    ) ?></button>
</form>

<?= $this->endSection() ?>
