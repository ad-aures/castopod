<?= $this->extend('_layout') ?>

<?= $this->section('content') ?>

<form action="<?= route_to('create-superadmin') ?>" method="POST" class="flex flex-col w-full max-w-sm gap-y-4">
<?= csrf_field() ?>

<div class="flex items-center mb-2">
    <span class="inline-flex items-center justify-center w-12 h-12 mr-2 text-sm font-semibold tracking-wider border-4 rounded-full text-accent-base border-accent-base">4/4</span>
    <x-Heading tagName="h1"><?= lang('Install.form.create_superadmin') ?></x-Heading>
</div>

<x-Forms.Field
    name="username"
    label="<?= esc(lang('Install.form.username')) ?>"
    isRequired="true" />

<x-Forms.Field
    name="email"
    label="<?= esc(lang('Install.form.email')) ?>"
    type="email"
    autocomplete="username"
    isRequired="true" />

<x-Forms.Field
    name="password"
    label="<?= esc(lang('Install.form.password')) ?>"
    type="password"
    isRequired="true"
    autocomplete="new-password" />
<?php // @icon("check-fill")?>
<x-Button variant="primary" type="submit" class="self-end" iconLeft="check-fill"><?= lang('Install.form.submit') ?></x-Button>

</form>

<?= $this->endSection() ?>
