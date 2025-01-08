<?php declare(strict_types=1);

?>
<?= $this->extend('_layout') ?>

<?= $this->section('content') ?>

<form action="<?= route_to('database-config') ?>" method="POST" class="flex flex-col w-full max-w-sm gap-y-4" autocomplete="off">
<?= csrf_field() ?>

<div class="flex flex-col mb-2">
    <div class="flex items-center">
        <span class="inline-flex items-center justify-center w-12 h-12 mr-2 text-sm font-semibold tracking-wider border-4 rounded-full text-accent-base border-accent-base">2/4</span>
        <Heading tagName="h1"><?= lang(
            'Install.form.database_config',
        ) ?></Heading>
    </div>

    <p class="mt-2 text-sm text-skin-muted"><?= lang(
        'Install.form.database_config_hint',
    ) ?></p>
</div>

<Forms.Field
    name="db_hostname"
    label="<?= esc(lang('Install.form.db_hostname')) ?>"
    value="<?= config('Database')->default['hostname'] ?>"
    required="true"
/>

<Forms.Field
    name="db_name"
    label="<?= esc(lang('Install.form.db_name')) ?>"
    value="<?= config('Database')->default['database'] ?>"
    required="true" />

<Forms.Field
    name="db_username"
    label="<?= esc(lang('Install.form.db_username')) ?>"
    value="<?= config('Database')->default['username'] ?>"
    required="true"
    autocomplete="off" />

<Forms.Field
    name="db_password"
    label="<?= esc(lang('Install.form.db_password')) ?>"
    value="<?= config('Database')->default['password'] ?>"
    type="password"
    required="true"
    autocomplete="off" />

<Forms.Field
    name="db_prefix"
    label="<?= esc(lang('Install.form.db_prefix')) ?>"
    hint="<?= esc(lang('Install.form.db_prefix_hint')) ?>"
    value="<?= config('Database')->default['DBPrefix'] ?>" />
<?php // @icon("arrow-right-fill")?>
<Button variant="primary" type="submit" class="self-end" iconRight="arrow-right-fill"><?= lang('Install.form.next') ?></Button>

</form>

<?= $this->endSection() ?>
