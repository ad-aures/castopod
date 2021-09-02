<?= $this->extend('_layout') ?>

<?= $this->section('content') ?>

<?= form_open(route_to('cache-config'), [
    'class' => 'flex flex-col max-w-sm w-full',
]) ?>
<?= csrf_field() ?>

<h1 class="mb-4 text-xl font-bold font-display"><span class="inline-flex items-center justify-center w-12 h-12 mr-2 text-sm font-semibold tracking-wider border-4 rounded-full text-pine-700 border-pine-700 font-body">3/4</span><?= lang(
    'Install.form.cache_config',
) ?></h1>

<p class="mb-4 text-sm text-gray-600"><?= lang(
    'Install.form.cache_config_hint',
) ?></p>

<?= form_label(lang('Install.form.cache_handler'), 'db_prefix') ?>
<?= form_dropdown(
    'cache_handler',
    [
        'file' => lang('Install.form.cacheHandlerOptions.file'),
        'redis' => lang('Install.form.cacheHandlerOptions.redis'),
        'predis' => lang('Install.form.cacheHandlerOptions.predis'),
    ],
    [old('cache_handler', 'file')],
    [
        'id' => 'cache_handler',
        'name' => 'cache_handler',
        'class' => 'form-select mb-6',
        'value' => config('Database')->default['DBPrefix'],
    ],
) ?>

<?= button(
    lang('Install.form.next') . icon('arrow-right', 'ml-2'),
    '',
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
