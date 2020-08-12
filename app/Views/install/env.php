<?= $this->extend('install/_layout') ?>

<?= $this->section('content') ?>

<?= form_open(route_to('install_generate_env'), [
    'class' => 'flex flex-col max-w-sm mx-auto',
]) ?>

<?= form_fieldset('', ['class' => 'flex flex-col mb-6']) ?>
    <legend class="mb-4 text-xl"><?= lang(
        'Install.form.castopod_config'
    ) ?></legend>
    <?= form_label(lang('Install.form.hostname'), 'hostname') ?>
    <?= form_input([
        'id' => 'hostname',
        'name' => 'hostname',
        'class' => 'form-input mb-4',
        'value' => config('App')->baseURL,
    ]) ?>

    <?= form_label(lang('Install.form.admin_gateway'), 'admin_gateway') ?>
    <?= form_input([
        'id' => 'admin_gateway',
        'name' => 'admin_gateway',
        'class' => 'form-input mb-4',
        'value' => config('App')->adminGateway,
    ]) ?>

    <?= form_label(lang('Install.form.auth_gateway'), 'auth_gateway') ?>
    <?= form_input([
        'id' => 'auth_gateway',
        'name' => 'auth_gateway',
        'class' => 'form-input',
        'value' => config('App')->authGateway,
    ]) ?>
<?= form_fieldset_close() ?>

<?= form_fieldset('', ['class' => 'flex flex-col mb-6']) ?>
    <legend class="mb-4 text-xl"><?= lang('Install.form.db_config') ?></legend>
    <?= form_label(lang('Install.form.db_hostname'), 'db_hostname') ?>
    <?= form_input([
        'id' => 'db_hostname',
        'name' => 'db_hostname',
        'class' => 'form-input mb-4',
        'value' => config('Database')->default['hostname'],
    ]) ?>

    <?= form_label(lang('Install.form.db_name'), 'db_name') ?>
    <?= form_input([
        'id' => 'db_name',
        'name' => 'db_name',
        'class' => 'form-input mb-4',
        'value' => config('Database')->default['database'],
    ]) ?>

    <?= form_label(lang('Install.form.db_username'), 'db_username') ?>
    <?= form_input([
        'id' => 'db_username',
        'name' => 'db_username',
        'class' => 'form-input mb-4',
        'value' => config('Database')->default['username'],
    ]) ?>

    <?= form_label(lang('Install.form.db_password'), 'db_password') ?>
    <?= form_input([
        'id' => 'db_password',
        'name' => 'db_password',
        'class' => 'form-input mb-4',
        'value' => config('Database')->default['password'],
    ]) ?>

    <?= form_label(lang('Install.form.db_prefix'), 'db_prefix') ?>
    <?= form_input([
        'id' => 'db_prefix',
        'name' => 'db_prefix',
        'class' => 'form-input',
        'value' => config('Database')->default['DBPrefix'],
    ]) ?>
<?= form_fieldset_close() ?>

<?= form_button([
    'content' => lang('Install.form.submit_install'),
    'type' => 'submit',
    'class' => 'self-end px-4 py-2 bg-gray-200',
]) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
