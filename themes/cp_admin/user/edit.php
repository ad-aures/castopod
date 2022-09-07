<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.edit_roles', [
    'username' => esc($user->username),
]) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('User.edit_roles', [
    'username' => esc($user->username),
]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('user-edit', $user->id) ?>" method="POST" class="flex flex-col max-w-sm">
<?= csrf_field() ?>

<Forms.Field
    as="MultiSelect"
    id="roles"
    name="roles[]"
    label="<?= lang('User.form.roles') ?>"
    options="<?= esc(json_encode($roleOptions)) ?>"
    selected="<?= esc(json_encode($user->roles)) ?>" />

<Button variant="primary" type="submit" class="self-end mt-4"><?= lang('User.form.submit_edit') ?></Button>

</form>

<?= $this->endSection() ?>
