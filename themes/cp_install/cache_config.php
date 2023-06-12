<?= $this->extend('_layout') ?>

<?= $this->section('content') ?>

<form action="<?= route_to('cache-config') ?>" method="POST" class="flex flex-col w-full max-w-sm gap-y-4">
<?= csrf_field() ?>

<div class="flex flex-col mb-2">
    <div class="flex items-center">
        <span class="inline-flex items-center justify-center w-12 h-12 mr-2 text-sm font-semibold tracking-wider border-4 rounded-full text-accent-base border-accent-base">3/4</span>
        <Heading tagName="h1"><?= lang('Install.form.cache_config') ?></h1>
    </div>

    <p class="mt-2 text-sm text-skin-muted"><?= lang(
        'Install.form.cache_config_hint',
    ) ?></p>
</div>

<Forms.Field
    as="Select"
    name="cache_handler"
    label="<?= lang('Install.form.cache_handler') ?>"
    options="<?= esc(json_encode([
            'file'   => lang('Install.form.cacheHandlerOptions.file'),
            'redis'  => lang('Install.form.cacheHandlerOptions.redis'),
            'predis' => lang('Install.form.cacheHandlerOptions.predis'),
        ])) ?>"
    selected="file"
    required="true" />

<Button variant="primary" class="self-end" iconRight="arrow-right" type="submit"><?= lang('Install.form.next') ?></Button>

<?= form_close() ?>

<?= $this->endSection() ?>
