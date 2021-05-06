<?= $this->extend('install/_layout') ?>

<?= $this->section('content') ?>

<?= form_open(route_to('database-config'), [
    'class' => 'flex flex-col max-w-sm w-full',
    'autocomplete' => 'off',
]) ?>
<?= csrf_field() ?>

<h1 class="mb-2 text-xl font-bold font-display"><span class="inline-flex items-center justify-center w-12 h-12 mr-2 text-sm font-semibold tracking-wider border-4 rounded-full text-pine-700 border-pine-700 font-body">2/4</span><?= lang(
    'Install.form.database_config',
) ?></h1>

<p class="mb-4 text-sm text-gray-600"><?= lang(
    'Install.form.database_config_hint',
) ?></p>

<?= form_label(lang('Install.form.db_hostname'), 'db_hostname') ?>
<?= form_input([
    'id' => 'db_hostname',
    'name' => 'db_hostname',
    'class' => 'form-input mb-4',
    'value' => old('db_hostname', config('Database')->default['hostname']),
    'required' => 'required',
]) ?>

<?= form_label(lang('Install.form.db_name'), 'db_name') ?>
<?= form_input([
    'id' => 'db_name',
    'name' => 'db_name',
    'class' => 'form-input mb-4',
    'value' => old('db_name', config('Database')->default['database']),
    'required' => 'required',
]) ?>

<?= form_label(lang('Install.form.db_username'), 'db_username') ?>
<?= form_input([
    'id' => 'db_username',
    'name' => 'db_username',
    'class' => 'form-input mb-4',
    'value' => old('db_username', config('Database')->default['username']),
    'required' => 'required',
    'autocomplete' => 'off',
]) ?>

<?= form_label(lang('Install.form.db_password'), 'db_password') ?>
<?= form_input([
    'id' => 'db_password',
    'name' => 'db_password',
    'class' => 'form-input mb-4',
    'value' => old('db_password', config('Database')->default['password']),
    'type' => 'password',
    'required' => 'required',
    'autocomplete' => 'off',
]) ?>

<?= form_label(
    lang('Install.form.db_prefix'),
    'db_prefix',
    [],
    lang('Install.form.db_prefix_hint'),
) ?>
<?= form_input([
    'id' => 'db_prefix',
    'name' => 'db_prefix',
    'class' => 'form-input mb-6',
    'value' => old('db_prefix', config('Database')->default['DBPrefix']),
]) ?>

<?= button(
    lang('Install.form.next') . icon('arrow-right', 'ml-2'),
    '',
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
