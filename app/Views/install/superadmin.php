<?= $this->extend('install/_layout') ?>

<?= $this->section('content') ?>

<?= form_open(route_to('install_create_superadmin'), [
    'class' => 'flex flex-col max-w-sm mx-auto',
]) ?>

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
    ]) ?>
    
    <?= form_label(lang('Install.form.username'), 'username') ?>
    <?= form_input([
        'id' => 'username',
        'name' => 'username',
        'class' => 'form-input mb-4',
    ]) ?>

    <?= form_label(lang('Install.form.password'), 'password') ?>
    <?= form_input([
        'id' => 'password',
        'name' => 'password',
        'class' => 'form-input',
        'type' => 'password',
    ]) ?>
<?= form_fieldset_close() ?>

<?= form_button([
    'content' => lang('Install.form.submit_create_superadmin'),
    'type' => 'submit',
    'class' => 'self-end px-4 py-2 bg-gray-200',
]) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
