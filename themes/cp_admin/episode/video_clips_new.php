<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('VideoClip.form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form id="new-video-clip-form" action="<?= route_to('video-clips-create', $podcast->id, $episode->id) ?>" method="POST" class="flex flex-col items-center gap-4 xl:items-start xl:flex-row">
<?= csrf_field() ?>

<div class="flex-1 w-full rounded-xl border-3 border-subtle">
    <video-clip-previewer duration="<?= old('duration', 30) ?>">
        <img slot="preview_image" src="<?= $episode->cover->thumbnail_url ?>" alt="<?= $episode->cover->description ?>" loading="lazy" />
    </video-clip-previewer>
    <audio-clipper start-time="<?= old('start_time', 0) ?>" audio-duration="<?= $episode->audio->duration ?>" duration="<?= old('duration', $episode->audio->duration >= 60 ? 60 : $episode->audio->duration) ?>" volume=".5" height="50" trim-start-label="<?= lang('VideoClip.form.trim_start') ?>" trim-end-label="<?= lang('VideoClip.form.trim_end') ?>">
        <audio slot="audio" src="<?= $episode->audio->file_url ?>" preload="auto">
            Your browser does not support the <code>audio</code> element.
        </audio>
        <input slot="start_time" type="number" name="start_time" placeholder="<?= lang('VideoClip.form.start_time') ?>" step="0.001" />
        <input slot="duration" type="number" name="duration" placeholder="<?= lang('VideoClip.form.duration') ?>" step="0.001" />
    </audio-clipper>
</div>

<div class="flex flex-col items-end w-full max-w-xl xl:max-w-sm 2xl:max-w-xl gap-y-4">
    <x-Forms.Section title="<?= lang('VideoClip.form.params_section_title') ?>" >
        <x-Forms.Field
            name="title"
            label="<?= esc(lang('VideoClip.form.clip_title')) ?>"
            isRequired="true"
        />
        <fieldset class="flex flex-wrap gap-x-1 gap-y-2">
            <legend><?= lang('VideoClip.form.format.label') ?></legend>
            <x-Forms.RadioButton
                value="landscape"
                name="format"
                isSelected="true"
                isRequired="true"
                hint="<?= esc(lang('VideoClip.form.format.landscape_hint')) ?>"><?= lang('VideoClip.format.landscape') ?></x-Forms.RadioButton>
            <x-Forms.RadioButton
                value="portrait"
                name="format"
                isRequired="true"
                hint="<?= esc(lang('VideoClip.form.format.portrait_hint')) ?>"><?= lang('VideoClip.format.portrait') ?></x-Forms.RadioButton>
            <x-Forms.RadioButton
                value="squared"
                name="format"
                isRequired="true"
                hint="<?= esc(lang('VideoClip.form.format.squared_hint')) ?>"><?= lang('VideoClip.format.squared') ?></x-Forms.RadioButton>
        </fieldset>
        <fieldset>
            <legend><?= lang('VideoClip.form.theme') ?></legend>
            <div class="grid gap-x-4 gap-y-2 grid-cols-colorButtons">
                <?php foreach (config('MediaClipper')->themes as $themeName => $colors): ?>
                    <x-Forms.ColorRadioButton
                    class="mx-auto"
                    value="<?= esc($themeName) ?>"
                    name="theme"
                    isRequired="true"
                    isSelected="<?= $themeName === 'pine' ? 'true' : 'false' ?>"
                    style="--color-accent-base: <?= $colors['preview']?>; --color-background-preview: <?= $colors['preview-background'] ?>"><?= lang('Settings.theme.' . $themeName) ?></x-Forms.ColorRadioButton>
                <?php endforeach; ?>
            </div>
        </fieldset>
    </x-Forms.Section>
    <?php // @icon("arrow-right-fill")?>
    <x-Button variant="primary" type="submit" iconRight="arrow-right-fill" class="self-end"><?= lang('VideoClip.form.submit') ?></x-Button>
</div>
</form>

<?= $this->endSection() ?>
