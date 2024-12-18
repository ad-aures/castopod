<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('episode-create', $podcast->id) ?>" method="POST" enctype="multipart/form-data" class="flex flex-col w-full max-w-xl mt-6 gap-y-8">
<?= csrf_field() ?>


<x-Forms.Section title="<?= lang('Episode.form.info_section_title') ?>" >

<x-Forms.Field
    name="audio_file"
    label="<?= esc(lang('Episode.form.audio_file')) ?>"
    hint="<?= esc(lang('Episode.form.audio_file_hint')) ?>"
    helper="<?= esc(lang('Common.size_limit', [formatBytes(file_upload_max_size(), true)])) ?>"
    type="file"
    accept=".mp3,.m4a"
    isRequired="true"
    data-max-size="<?= file_upload_max_size() ?>"
    data-max-size-error="<?= lang('Episode.form.file_size_error', [formatBytes(file_upload_max_size(), true)]) ?>" />

<x-Forms.Field
    name="cover"
    label="<?= esc(lang('Episode.form.cover')) ?>"
    hint="<?= esc(lang('Episode.form.cover_hint')) ?>"
    helper="<?= esc(lang('Episode.form.cover_size_hint')) ?>"
    type="file"
    accept=".jpg,.jpeg,.png" />

<x-Forms.Field
    name="title"
    label="<?= esc(lang('Episode.form.title')) ?>"
    hint="<?= esc(lang('Episode.form.title_hint')) ?>"
    isRequired="true"
    data-slugify="title" />

<x-Forms.PermalinkEditor
    name="slug"
    label="<?= lang('Episode.form.permalink') ?>"
    prefix="<?= '…/' . esc($podcast->at_handle) . '/' ?>"
    data-slugify="slug"
    permalinkBase="<?= url_to('podcast-episodes', $podcast->handle) ?>"
    />

<div class="flex flex-col gap-x-2 gap-y-4 md:flex-row">
    <x-Forms.Field
        class="flex-1 w-full"
        name="season_number"
        label="<?= esc(lang('Episode.form.season_number')) ?>"
        type="number"
        value="<?= $currentSeasonNumber ?>"
    />
    <x-Forms.Field
        class="flex-1 w-full"
        name="episode_number"
        label="<?= esc(lang('Episode.form.episode_number')) ?>"
        type="number"
        value="<?= $nextEpisodeNumber ?>"
        required="<?= $podcast->type === 'serial' ? 'true' : 'false' ?>"
    />
</div>

<x-Forms.RadioGroup
    label="<?= lang('Episode.form.type.label') ?>"
    name="type"
    options="<?= esc(json_encode([
        [
            'label'       => lang('Episode.form.type.full'),
            'value'       => 'full',
            'description' => lang('Episode.form.type.full_description'),
        ],
        [
            'label'       => lang('Episode.form.type.trailer'),
            'value'       => 'trailer',
            'description' => lang('Episode.form.type.trailer_description'),
        ],
        [
            'label'       => lang('Episode.form.type.bonus'),
            'value'       => 'bonus',
            'description' => lang('Episode.form.type.bonus_description'),
        ],
    ])) ?>"
    isRequired="true"
/>

<x-Forms.RadioGroup
    label="<?= lang('Episode.form.parental_advisory.label') ?>"
    hint="<?= lang('Episode.form.parental_advisory.hint') ?>"
    name="parental_advisory"
    options="<?= esc(json_encode([
        [
            'label' => lang('Episode.form.parental_advisory.undefined'),
            'value' => 'undefined',
        ],
        [
            'label' => lang('Episode.form.parental_advisory.clean'),
            'value' => 'clean',
        ],
        [
            'label' => lang('Episode.form.parental_advisory.explicit'),
            'value' => 'explicit',
        ],
    ])) ?>"
    isRequired="true"
/>

</x-Forms.Section>


<x-Forms.Section
    title="<?= lang('Episode.form.show_notes_section_title') ?>"
    subtitle="<?= lang('Episode.form.show_notes_section_subtitle') ?>">

<x-Forms.Field
    as="MarkdownEditor"
    name="description"
    label="<?= esc(lang('Episode.form.description')) ?>"
    isRequired="true"
    disallowList="header,quote" />

</x-Forms.Section>

<x-Forms.Section title="<?= lang('Episode.form.premium_title') ?>">
    <x-Forms.Toggler class="mt-2" name="premium" isChecked="<?= $podcast->is_premium_by_default ? 'true' : 'false' ?>">
        <?= lang('Episode.form.premium') ?></x-Forms.Toggler>
</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Episode.form.location_section_title') ?>"
    subtitle="<?= lang('Episode.form.location_section_subtitle') ?>"
>
<x-Forms.Field
    name="location_name"
    label="<?= esc(lang('Episode.form.location_name')) ?>"
    hint="<?= esc(lang('Episode.form.location_name_hint')) ?>" />
</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Episode.form.additional_files_section_title') ?>">

<fieldset class="flex flex-col">
<legend><?= lang('Episode.form.transcript') .
            '<small class="ml-1 lowercase">(' .
            lang('Common.optional') .
            ')</small>' ?><x-Hint class="ml-1"><?= lang('Episode.form.transcript_hint') ?></x-Hint></legend>
<div class="form-input-tabs">
    <input type="radio" name="transcript-choice" id="transcript-file-upload-choice" aria-controls="transcript-file-upload-choice" value="upload-file" <?= old('transcript-choice') !== 'remote-file' ? 'checked' : '' ?> />
    <label for="transcript-file-upload-choice"><?= lang('Common.forms.upload_file') ?></label>

    <input type="radio" name="transcript-choice" id="transcript-file-remote-url-choice" aria-controls="transcript-file-remote-url-choice" value="remote-url" <?= old('transcript-choice') === 'remote-file' ? 'checked' : '' ?> />
    <label for="transcript-file-remote-url-choice"><?= lang('Common.forms.remote_url') ?></label>

    <div class="py-2 tab-panels">
        <section id="transcript-file-upload" class="flex items-center tab-panel">
            <x-Forms.Label class="sr-only" for="transcript_file" isOptional="true"><?= lang('Episode.form.transcript_file') ?></x-Forms.Label>
            <x-Forms.Input class="w-full" name="transcript_file" type="file" accept=".srt,.vtt" />
        </section>
        <section id="transcript-file-remote-url" class="tab-panel">
            <x-Forms.Label class="sr-only" for="transcript_remote_url" isOptional="true"><?= lang('Episode.form.transcript_remote_url') ?></x-Forms.Label>
            <x-Forms.Input class="w-full" placeholder="https://…" name="transcript_remote_url" />
        </section>
    </div>
</div>
</fieldset>


<fieldset class="flex flex-col">
<legend><?= lang('Episode.form.chapters') .
            '<small class="ml-1 lowercase">(' .
            lang('Common.optional') .
            ')</small>' ?><x-Hint class="ml-1"><?= lang('Episode.form.chapters_hint') ?></x-Hint></legend>
<div class="form-input-tabs">
    <input type="radio" name="chapters-choice" id="chapters-file-upload-choice" aria-controls="chapters-file-upload-choice" value="upload-file" <?= old('chapters-choice') !== 'remote-file' ? 'checked' : '' ?> />
    <label for="chapters-file-upload-choice"><?= lang('Common.forms.upload_file') ?></label>

    <input type="radio" name="chapters-choice" id="chapters-file-remote-url-choice" aria-controls="chapters-file-remote-url-choice" value="remote-url" <?= old('chapters-choice') === 'remote-file' ? 'checked' : '' ?> />
    <label for="chapters-file-remote-url-choice"><?= lang('Common.forms.remote_url') ?></label>

    <div class="py-2 tab-panels">
        <section id="chapters-file-upload" class="flex items-center tab-panel">
            <x-Forms.Label class="sr-only" for="chapters_file" isOptional="true"><?= lang('Episode.form.chapters_file') ?></x-Forms.Label>
            <x-Forms.Input class="w-full" name="chapters_file" type="file" accept=".json" />
        </section>
        <section id="chapters-file-remote-url" class="tab-panel">
            <x-Forms.Label class="sr-only" for="chapters_remote_url" isOptional="true"><?= lang('Episode.form.chapters_remote_url') ?></x-Forms.Label>
            <x-Forms.Input class="w-full" placeholder="https://…" name="chapters_remote_url" />
        </section>
    </div>
</div>
</fieldset>
</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Episode.form.advanced_section_title') ?>"
    subtitle="<?= lang('Episode.form.advanced_section_subtitle') ?>"
>

<x-Forms.Toggler name="block" isChecked="false" hint="<?= esc(lang('Episode.form.block_hint')) ?>"><?= lang('Episode.form.block') ?></x-Forms.Toggler>

</x-Forms.Section>


<x-Button class="self-end" variant="primary" type="submit"><?= lang('Episode.form.submit_create') ?></x-Button>

</form>

<?= $this->endSection() ?>
