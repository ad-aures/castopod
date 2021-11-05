<?= $this->extend('_layout') ?>

<?= $this->section('content') ?>

<form action="<?= '/' . config('Install')->gateway . '/instance-config' ?>" class="flex flex-col w-full max-w-sm gap-y-4" method="post" accept-charset="utf-8">
<?= csrf_field() ?>

<div class="flex items-center mb-2">
    <span class="inline-flex items-center justify-center w-12 h-12 mr-2 text-sm font-semibold tracking-wider border-4 rounded-full text-accent-base border-accent-base">1/4</span>
    <Heading tagName="h1"><?= lang('Install.form.instance_config') ?></Heading>
</div>

<Forms.Field
    name="hostname"
    label="<?= lang('Install.form.hostname') ?>"
    value="<?= host_url() === null ? config('App')
    ->baseURL : host_url() ?>"
    required="true" />

<Forms.Field
    name="media_base_url"
    label="<?= lang('Install.form.media_base_url') ?>"
    hint="<?= lang('Install.form.media_base_url_hint') ?>" />

<Forms.Field
    name="admin_gateway"
    label="<?= lang('Install.form.admin_gateway') ?>"
    hint="<?= lang('Install.form.admin_gateway_hint') ?>"
    value="<?= config('Admin')
    ->gateway ?>"
    required="true" />

<Forms.Field
    name="auth_gateway"
    label="<?= lang('Install.form.auth_gateway') ?>"
    hint="<?= lang('Install.form.auth_gateway_hint') ?>"
    value="<?= config('Auth')
    ->gateway ?>"
    required="true" />

<Button class="self-end" variant="primary" type="submit" iconRight="arrow-right"><?= lang('Install.form.next') ?></Button>
</form>

<?= $this->endSection() ?>
