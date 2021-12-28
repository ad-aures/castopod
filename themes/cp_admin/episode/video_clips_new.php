<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('VideoClip.form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('VideoClip.form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('video-clips-create', $podcast->id, $episode->id) ?>" method="POST" class="flex gap-4">

<div class="flex-1 w-full">
    <!-- <div class="h-full bg-black"></div> -->
    <audio-clipper start-time="1000" duration="140" min-duration="10" volume=".25">
        <audio slot="audio" src="<?= $episode->audio->file_url ?>" class="w-full">
            Your browser does not support the <code>audio</code> element.
        </audio>
        <input slot="start_time" type="number" name="start_time" placeholder="<?= lang('VideoClip.form.start_time') ?>" step="0.001" />
        <input slot="duration" type="number" name="duration" placeholder="<?= lang('VideoClip.form.duration') ?>" step="0.001" />
    </audio-clipper>
</div>

<!-- <Forms.Section title="<?= lang('VideoClip.form.params_section_title') ?>" >
 
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

<Button variant="primary" type="submit" iconRight="arrow-right" class="self-end"><?= lang('VideoClip.form.submit') ?></Button>

</Forms.Section> -->

</form>

<?= $this->endSection() ?>
