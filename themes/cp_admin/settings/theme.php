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
<Forms.Section
    title="<?= lang('Settings.theme.accent_section_title') ?>"
    subtitle="<?= lang('Settings.theme.accent_section_subtitle') ?>">

<div class="grid gap-4 grid-cols-colorButtons">
    <?php foreach (config('Colors')->themes as $themeName => $color): ?>
        <Forms.ColorRadioButton
        class="theme-<?= $themeName ?> mx-auto"
        value="<?= $themeName ?>"
        name="theme"
        isChecked="<?= $themeName === service('settings')
        ->get('App.theme') ? 'true' : 'false' ?>" ><?= lang('Settings.theme.' . $themeName) ?></Forms.ColorRadioButton>
    <?php endforeach; ?>
</div>

<Button variant="primary" type="submit" class="self-end"><?= lang('Settings.theme.submit') ?></Button>

</Forms.Section>

</form>
<?= $this->endSection() ?>