<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.video_clips.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.video_clips.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('video-clips-generate', $podcast->id, $episode->id) ?>" method="POST" class="flex flex-col max-w-sm gap-y-4">

<fieldset>
<legend>Format</legend>
<div class="mx-auto">
    <input type="radio" name="format" value="landscape" id="landscape" checked="checked"/>
    <label for="landscape">Landscape - 16:9</label>
</div>
<div class="mx-auto">
    <input type="radio" name="format" value="portrait" id="portrait"/>
    <label for="portrait">Portrait - 9:16</label>
</div>
<div class="mx-auto">
    <input type="radio" name="format" value="squared" id="square"/>
    <label for="square">Square - 1:1</label>
</div>
</fieldset>

<div class="grid gap-4 grid-cols-colorButtons">
    <?php foreach (config('MediaClipper')->themes as $themeName => $colors): ?>
        <Forms.ColorRadioButton
        class="mx-auto"
        value="<?= $themeName ?>"
        name="theme"
        isChecked="<?= $themeName === 'pine' ? 'true' : 'false' ?>"
        style="--color-accent-base: <?= $colors['preview']?>"><?= lang('Settings.theme.' . $themeName) ?></Forms.ColorRadioButton>
    <?php endforeach; ?>
</div>

<Forms.Field
    type="number"
    name="start_time"
    label="START"
    required="true"
    value="5"
/>
<Forms.Field
    type="number"
    name="end_time"
    label="END"
    required="true"
    value="10"
/>

<Button variant="primary" type="submit"><?= lang('Episode.video_clips.submit') ?></Button>

</form>

<?= $this->endSection() ?>
