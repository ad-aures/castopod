<?php declare(strict_types=1);

?>

<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Settings.theme.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Settings.theme.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('settings-theme') ?>" method="POST" class="flex flex-col w-full max-w-xl gap-y-4" enctype="multipart/form-data">
<?= csrf_field() ?>
<x-Forms.Section
    title="<?= lang('Settings.theme.accent_section_title') ?>"
    subtitle="<?= lang('Settings.theme.accent_section_subtitle') ?>">

<div class="grid gap-4 grid-cols-colorButtons">
    <?php foreach (config('Colors')->themes as $themeName => $color): ?>
        <x-Forms.ColorRadioButton
        class="theme-<?= $themeName ?> mx-auto"
        value="<?= esc($themeName) ?>"
        name="theme"
        isSelected="<?= $themeName === service('settings')
        ->get('App.theme') ? 'true' : 'false' ?>" ><?= lang('Settings.theme.' . $themeName) ?></x-Forms.ColorRadioButton>
    <?php endforeach; ?>
</div>

<x-Button variant="primary" type="submit" class="self-end"><?= lang('Settings.theme.submit') ?></x-Button>

</x-Forms.Section>

</form>
<?= $this->endSection() ?>