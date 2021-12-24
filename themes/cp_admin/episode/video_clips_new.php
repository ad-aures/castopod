<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('VideoClip.form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('VideoClip.form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('video-clips-create', $podcast->id, $episode->id) ?>" method="POST" class="flex flex-col gap-y-4">

<Forms.Section title="<?= lang('VideoClip.form.params_section_title') ?>" >
 
<Forms.Field
    name="label"
    label="<?= lang('VideoClip.form.clip_title') ?>"
    required="true"
/>

<fieldset class="flex gap-1">
<legend><?= lang('VideoClip.form.format.label') ?></legend>
<Forms.RadioButton
    value="landscape"
    name="format"
    hint="<?= lang('VideoClip.form.format.landscape_hint') ?>"><?= lang('VideoClip.form.format.landscape') ?></Forms.RadioButton>
<Forms.RadioButton
    value="portrait"
    name="format"
    hint="<?= lang('VideoClip.form.format.portrait_hint') ?>"><?= lang('VideoClip.form.format.portrait') ?></Forms.RadioButton>
<Forms.RadioButton
    value="squared"
    name="format"
    hint="<?= lang('VideoClip.form.format.squared_hint') ?>"><?= lang('VideoClip.form.format.squared') ?></Forms.RadioButton>
</fieldset>

<fieldset>
<legend><?= lang('VideoClip.form.theme') ?></legend>
<div class="grid gap-4 grid-cols-colorButtons">
    <?php foreach (config('MediaClipper')->themes as $themeName => $colors): ?>
        <Forms.ColorRadioButton
        class="mx-auto"
        value="<?= $themeName ?>"
        name="theme"
        style="--color-accent-base: <?= $colors['preview']?>"><?= lang('Settings.theme.' . $themeName) ?></Forms.ColorRadioButton>
    <?php endforeach; ?>
</div>
</fieldset>

<div class="flex flex-col gap-x-2 gap-y-4 md:flex-row">
    <Forms.Field
        type="number"
        name="start_time"
        label="<?= lang('VideoClip.form.start_time') ?>"
        required="true"
        step="0.001"
    />
    <Forms.Field
        type="number"
        name="duration"
        label="<?= lang('VideoClip.form.duration') ?>"
        required="true"
        step="0.001"
    />
</div>

<Button variant="primary" type="submit" iconRight="arrow-right" class="self-end"><?= lang('VideoClip.form.submit') ?></Button>

</Forms.Section>

</form>

<?= $this->endSection() ?>
