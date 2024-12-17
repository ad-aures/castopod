<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('User.edit_role', [
    'username' => esc($user->username),
]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('user-edit', $user->id) ?>" method="POST" class="flex flex-col max-w-sm">
<?= csrf_field() ?>

<x-Forms.Field
    as="Select"
    name="role"
    label="<?= esc(lang('User.form.role')) ?>"
    options="<?= esc(json_encode($roleOptions)) ?>"
    defaultValue="<?= esc(get_instance_group($user)) ?>"
    isRequired="true" />

<x-Button variant="primary" type="submit" class="self-end mt-4"><?= lang('User.form.submit_edit') ?></x-Button>

</form>

<?= $this->endSection() ?>
