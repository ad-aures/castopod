<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Soundbite.form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Soundbite.form.title') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form id="soundbites-form" action="<?= route_to('episode-soundbites-edit', $podcast->id, $episode->id) ?>" method="POST" class="flex flex-col">
<?= csrf_field() ?>

    <Forms.Field
        name="title"
        label="<?= lang('Soundbite.form.soundbite_title') ?>"
        required="true"
        class="max-w-sm"
    />
    <audio-clipper start-time="<?= old('start_time', 0) ?>" audio-duration="<?= $episode->audio->duration ?>" duration="<?= old('duration', $episode->audio->duration >= 60 ? 60 : $episode->audio->duration) ?>" min-duration="10" volume=".5" height="50" trim-start-label="<?= lang('VideoClip.form.trim_start') ?>" trim-end-label="<?= lang('VideoClip.form.trim_end') ?>" class="mt-8">
        <audio slot="audio" src="<?= $episode->audio->file_url ?>" preload="auto">
            Your browser does not support the <code>audio</code> element.
        </audio>
        <input slot="start_time" type="number" name="start_time" placeholder="<?= lang('VideoClip.form.start_time') ?>" step="0.001" />
        <input slot="duration" type="number" name="duration" placeholder="<?= lang('VideoClip.form.duration') ?>" step="0.001" />
    </audio-clipper>

    <Button variant="primary" type="submit" class="self-end mt-4" iconRight="arrow-right"><?= lang('Soundbite.form.submit') ?></Button>

</form>

<?= $this->endSection() ?>
