<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.edit_role', [
    'username' => esc($user->username),
]) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('User.edit_role', [
    'username' => esc($user->username),
]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('user-edit', $user->id) ?>" method="POST" class="flex flex-col max-w-sm">
<?= csrf_field() ?>

<Forms.Field
    as="Select"
    name="role"
    label="<?= lang('User.form.role') ?>"
    options="<?= esc(json_encode($roleOptions)) ?>"
    selected="<?= esc(get_instance_group($user)) ?>"
    required="true" />

<Button variant="primary" type="submit" class="self-end mt-4"><?= lang('User.form.submit_edit') ?></Button>

</form>

<?= $this->endSection() ?>
