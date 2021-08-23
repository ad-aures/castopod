<?= $this->extend('Modules\Admin\Views\_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.create') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('User.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open(route_to('user-create'), ['class' => 'flex flex-col max-w-sm']) ?>
<?= csrf_field() ?>

<?= form_label(lang('User.form.email'), 'email') ?>
<?= form_input([
    'id' => 'email',
    'name' => 'email',
    'class' => 'form-input mb-4',
    'value' => old('email'),
    'type' => 'email',
]) ?>

<?= form_label(lang('User.form.username'), 'username') ?>
<?= form_input([
    'id' => 'username',
    'name' => 'username',
    'class' => 'form-input mb-4',
    'value' => old('username'),
]) ?>

<?= form_label(lang('User.form.password'), 'password') ?>
<?= form_input([
    'id' => 'password',
    'name' => 'password',
    'class' => 'form-input mb-4',
    'type' => 'password',
    'autocomplete' => 'new-password',
]) ?>

<?= button(
    lang('User.form.submit_create'),
    '',
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
