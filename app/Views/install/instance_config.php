<?= $this->extend('install/_layout') ?>

<?= $this->section('content') ?>

<form action="<?= '/' .
    config('App')->installGateway .
    '/instance-config' ?>" class="flex flex-col w-full max-w-sm" method="post" accept-charset="utf-8">
<?= csrf_field() ?>

<h1 class="mb-4 text-xl"><span class="inline-flex items-center justify-center w-12 h-12 mr-2 text-sm font-semibold tracking-wider text-green-700 border-4 border-green-500 rounded-full">1/4</span><?= lang(
    'Install.form.instance_config'
) ?></h1>
<?= form_label(lang('Install.form.hostname'), 'hostname') ?>
<?= form_input([
    'id' => 'hostname',
    'name' => 'hostname',
    'class' => 'form-input mb-4',
    'value' => old('hostname', host_url() ?? config('App')->baseURL),
    'required' => 'required',
]) ?>

<?= form_label(
    lang('Install.form.admin_gateway'),
    'admin_gateway',
    [],
    lang('Install.form.admin_gateway_hint')
) ?>
<?= form_input([
    'id' => 'admin_gateway',
    'name' => 'admin_gateway',
    'class' => 'form-input mb-4',
    'value' => old('admin_gateway', config('App')->adminGateway),
    'required' => 'required',
]) ?>

<?= form_label(
    lang('Install.form.auth_gateway'),
    'auth_gateway',
    [],
    lang('Install.form.auth_gateway_hint')
) ?>
<?= form_input([
    'id' => 'auth_gateway',
    'name' => 'auth_gateway',
    'class' => 'form-input mb-6',
    'value' => old('auth_gateway', config('App')->authGateway),
    'required' => 'required',
]) ?>

<?= button(
    lang('Install.form.next') . icon('arrow-right', 'ml-2'),
    null,
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end']
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
