<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.edit_roles', ['username' => $user->username]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open(route_to('user-edit', $user->id), [
    'class' => 'flex flex-col max-w-sm',
]) ?>
<?= csrf_field() ?>

<?= form_label(lang('User.form.roles'), 'roles') ?>
<?= form_multiselect('roles[]', $roleOptions, $user->roles, [
    'id' => 'roles',
    'class' => 'form-multiselect mb-4',
]) ?>

<?= form_button([
    'content' => lang('User.form.submit_edit'),
    'type' => 'submit',
    'class' => 'self-end px-4 py-2 bg-gray-200',
]) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
