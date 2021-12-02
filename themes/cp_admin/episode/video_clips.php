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
    <input type="radio" name="format" value="16:9" id="landscape"/>
    <label for="landscape">Landscape - 16:9</label>
</div>
<div class="mx-auto">
    <input type="radio" name="format" value="1:1" id="square" checked="checked"/>
    <label for="square">Square - 1:1</label>
</div>
<div class="mx-auto">
    <input type="radio" name="format" value="9:16" id="portrait"/>
    <label for="portrait">Portrait - 9:16</label>
</div>
</fieldset>

<Forms.Field
    type="number"
    name="start_time"
    label="START"
    required="true"
    value="0"
/>
<Forms.Field
    type="number"
    name="end_time"
    label="END"
    required="true"
    value="15"
/>

<audio></audio>

<Button variant="primary" type="submit"><?= lang('Episode.video_clips.submit') ?></Button>

</form>

<?= $this->endSection() ?>
