<?= $this->extend('install/_layout') ?>

<?= $this->section('content') ?>

<form action="<?= '/' .
    config('App')->installGateway .
    '/instance-config' ?>" class="flex flex-col w-full max-w-sm" method="post" accept-charset="utf-8">
<?= csrf_field() ?>

<h1 class="mb-4 text-xl font-bold font-display"><span class="inline-flex items-center justify-center w-12 h-12 mr-2 text-sm font-semibold tracking-wider border-4 rounded-full text-pine-700 border-pine-700 font-body">1/4</span><?= lang(
    'Install.form.instance_config',
) ?></h1>
<?= form_label(lang('Install.form.hostname'), 'hostname') ?>
<?= form_input([
    'id' => 'hostname',
    'name' => 'hostname',
    'class' => 'form-input mb-4',
    'value' => old(
        'hostname',
        empty(host_url()) ? config('App')->baseURL : host_url(),
    ),
    'required' => 'required',
]) ?>


<?= form_label(
    lang('Install.form.media_base_url'),
    'media_base_url',
    [],
    lang('Install.form.media_base_url_hint'),
    true,
) ?>
<?= form_input([
    'id' => 'media_base_url',
    'name' => 'media_base_url',
    'class' => 'form-input mb-4',
    'value' => old('media_base_url', ''),
]) ?>

<?= form_label(
    lang('Install.form.admin_gateway'),
    'admin_gateway',
    [],
    lang('Install.form.admin_gateway_hint'),
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
    lang('Install.form.auth_gateway_hint'),
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
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
