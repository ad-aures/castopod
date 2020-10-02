<?= $this->extend('install/_layout') ?>

<?= $this->section('content') ?>

<?= form_open(route_to('create-superadmin'), [
    'class' => 'flex flex-col max-w-sm mx-auto',
]) ?>
<?= csrf_field() ?>

<?= form_fieldset('', ['class' => 'flex flex-col mb-6']) ?>
    <legend class="mb-4 text-xl"><?= lang(
        'Install.form.create_superadmin'
    ) ?></legend>
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
<?= form_fieldset_close() ?>

<?= button(
    lang('Install.form.submit_create_superadmin'),
    null,
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end']
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
