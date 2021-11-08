<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Settings.theme.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Settings.theme.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('settings-theme') ?>" method="POST" class="flex flex-col gap-y-4" enctype="multipart/form-data">
<?= csrf_field() ?>
<Forms.Section
    title="<?= lang('Settings.theme.accent_section_title') ?>"
    subtitle="<?= lang('Settings.theme.accent_section_subtitle') ?>">

<div class="grid gap-4 grid-cols-colorButtons">
    <?php foreach (['pine', 'lake', 'jacaranda', 'crimson', 'amber', 'onyx'] as $theme): ?>
        <Forms.ColorRadioButton
        class="theme-<?= $theme ?> mx-auto"
        value="<?= $theme ?>"
        name="theme"
        isChecked="<?= $theme === service('settings')->get('App.theme') ? 'true' : 'false' ?>" ><?= lang('Settings.theme.' . $theme) ?></Forms.ColorRadioButton>
    <?php endforeach; ?>
</div>

<Button variant="primary" type="submit" class="self-end"><?= lang('Settings.theme.submit') ?></Button>

</Forms.Section>

</form>
<?= $this->endSection() ?>