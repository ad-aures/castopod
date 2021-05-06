<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('MyAccount.changePassword') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('MyAccount.changePassword') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open(route_to('change-password'), [
    'class' => 'flex flex-col max-w-sm',
]) ?>
<?= csrf_field() ?>

<?= form_label(lang('User.form.password'), 'password') ?>
<?= form_input([
    'id' => 'password',
    'name' => 'password',
    'class' => 'form-input mb-4',
    'required' => 'required',
    'type' => 'password',
]) ?>

<?= form_label(lang('User.form.new_password'), 'new_password') ?>
<?= form_input([
    'id' => 'new_password',
    'name' => 'new_password',
    'class' => 'form-input mb-4',
    'required' => 'required',
    'type' => 'password',

    'autocomplete' => 'new-password',
]) ?>

<?= button(
    lang('User.form.submit_password_change'),
    '',
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
