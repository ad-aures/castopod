<?= $this->extend('_layout') ?>

<?= $this->section('content') ?>

<?= form_open(route_to('create-superadmin'), [
    'class' => 'flex flex-col max-w-sm w-full',
]) ?>
<?= csrf_field() ?>

<h1 class="mb-4 text-xl font-bold font-display"><span class="inline-flex items-center justify-center w-12 h-12 mr-2 text-sm font-semibold tracking-wider border-4 rounded-full text-pine-700 border-pine-700 font-body">4/4</span><?= lang(
    'Install.form.create_superadmin',
) ?></h1>

<?= form_label(lang('Install.form.email'), 'email') ?>
<?= form_input([
    'id' => 'email',
    'name' => 'email',
    'class' => 'form-input mb-4',
    'type' => 'email',
    'required' => 'required',
    'value' => old('email'),
]) ?>

<?= form_label(lang('Install.form.username'), 'username') ?>
<?= form_input([
    'id' => 'username',
    'name' => 'username',
    'class' => 'form-input mb-4',
    'required' => 'required',
    'value' => old('username'),
]) ?>

<?= form_label(lang('Install.form.password'), 'password') ?>
<?= form_input([
    'id' => 'password',
    'name' => 'password',
    'class' => 'form-input mb-4',
    'type' => 'password',
    'required' => 'required',
    'autocomplete' => 'new-password',
]) ?>

<?= button(
    icon('check', 'mr-2') . lang('Install.form.submit'),
    '',
    [
        'variant' => 'primary',
    ],
    [
        'type' => 'submit',
        'class' => 'self-end',
    ],
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
