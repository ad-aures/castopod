<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.create') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('episode-create', $podcast->id) ?>" method="POST" enctype="multipart/form-data" class="flex flex-col w-full max-w-xl mt-6 gap-y-8">
<?= csrf_field() ?>


<Forms.Section title="<?= lang('Episode.form.info_section_title') ?>" >

<Forms.Field
    name="audio_file"
    label="<?= lang('Episode.form.audio_file') ?>"
    hint="<?= lang('Episode.form.audio_file_hint') ?>"
    helper="<?= lang('Common.size_limit', [formatBytes(file_upload_max_size(), true)]) ?>"
    type="file"
    accept=".mp3,.m4a"
    required="true"
    data-max-size="<?= file_upload_max_size() ?>"
    data-max-size-error="<?= lang('Episode.form.file_size_error', [formatBytes(file_upload_max_size(), true)]) ?>" />

<Forms.Field
    name="cover"
    label="<?= lang('Episode.form.cover') ?>"
    hint="<?= lang('Episode.form.cover_hint') ?>"
    helper="<?= lang('Episode.form.cover_size_hint') ?>"
    type="file"
    accept=".jpg,.jpeg,.png" />

<Forms.Field
    name="title"
    label="<?= lang('Episode.form.title') ?>"
    hint="<?= lang('Episode.form.title_hint') ?>"
    required="true"
    data-slugify="title" />

<div>
    <Forms.Label for="slug"><?= lang('Episode.form.permalink') ?></Forms.Label>
    <permalink-edit class="inline-flex items-center w-full text-xs" edit-label="<?= lang('Common.edit') ?>" copy-label="<?= lang('Common.copy') ?>" copied-label="<?= lang('Common.copied') ?>" permalink-base="<?= url_to('podcast-episodes', $podcast->handle) ?>">
        <span slot="domain"><?= '…/' . esc($podcast->at_handle) . '/' ?></span>
        <Forms.Input name="slug" required="true" data-slugify="slug" slot="slug-input" class="flex-1 text-xs" />
    </permalink-edit>
</div>

<div class="flex flex-col gap-x-2 gap-y-4 md:flex-row">
    <Forms.Field
        class="flex-1 w-full"
        name="season_number"
        label="<?= lang('Episode.form.season_number') ?>"
        type="number"
        value="<?= $currentSeasonNumber ?>"
    />
    <Forms.Field
        class="flex-1 w-full"
        name="episode_number"
        label="<?= lang('Episode.form.episode_number') ?>"
        type="number"
        value="<?= $nextEpisodeNumber ?>"
        required="<?= $podcast->type === 'serial' ? 'true' : 'false' ?>"
    />
</div>

<fieldset class="flex gap-1">
<legend><?= lang('Episode.form.type.label') ?></legend>
<Forms.RadioButton
    value="full"
    name="type"
    hint="<?= lang('Episode.form.type.full_hint') ?>"
    isChecked="true" ><?= lang('Episode.form.type.full') ?></Forms.RadioButton>
<Forms.RadioButton
    value="trailer"
    name="type"
    hint="<?= lang('Episode.form.type.trailer_hint') ?>"
    isChecked="false" ><?= lang('Episode.form.type.trailer') ?></Forms.RadioButton>    
<Forms.RadioButton
    value="bonus"
    name="type"
    hint="<?= lang('Episode.form.type.bonus_hint') ?>"
    isChecked="false" ><?= lang('Episode.form.type.bonus') ?></Forms.RadioButton>
</fieldset>

<fieldset class="flex gap-1">
<legend>
    <?= lang('Episode.form.parental_advisory.label') .
        hint_tooltip(lang('Episode.form.parental_advisory.hint'), 'ml-1') ?>
</legend>
<Forms.RadioButton
    value="undefined"
    name="parental_advisory"
    isChecked="true" ><?= lang('Episode.form.parental_advisory.undefined') ?></Forms.RadioButton>
<Forms.RadioButton
    value="clean"
    name="parental_advisory"
    isChecked="false" ><?= lang('Episode.form.parental_advisory.clean') ?></Forms.RadioButton>    
<Forms.RadioButton
    value="explicit"
    name="parental_advisory"
    isChecked="false" ><?= lang('Episode.form.parental_advisory.explicit') ?></Forms.RadioButton>
</fieldset>



</Forms.Section>


<Forms.Section
    title="<?= lang('Episode.form.show_notes_section_title') ?>"
    subtitle="<?= lang('Episode.form.show_notes_section_subtitle') ?>">

<Forms.Field
    as="MarkdownEditor"
    name="description"
    label="<?= lang('Episode.form.description') ?>"
    required="true"
    disallowList="header,quote" />

<Forms.Field
    as="MarkdownEditor"
    name="description_footer"
    label="<?= lang('Episode.form.description_footer') ?>"
    hint="<?= lang('Episode.form.description_footer_hint') ?>"
    value="<?= esc($podcast->episode_description_footer_markdown) ?? '' ?>"
    disallowList="header,quote" />

</Forms.Section>

<Forms.Section title="<?= lang('Episode.form.premium_title') ?>">
    <Forms.Toggler class="mt-2" name="premium" value="yes" checked="<?= $podcast->is_premium_by_default ? 'true' : 'false' ?>">
        <?= lang('Episode.form.premium') ?></Forms.Toggler>
</Forms.Section>

<Forms.Section
    title="<?= lang('Episode.form.location_section_title') ?>"
    subtitle="<?= lang('Episode.form.location_section_subtitle') ?>"
>
<Forms.Field
    name="location_name"
    label="<?= lang('Episode.form.location_name') ?>"
    hint="<?= lang('Episode.form.location_name_hint') ?>" />
</Forms.Section>

<Forms.Section
    title="<?= lang('Episode.form.additional_files_section_title') ?>">

<fieldset class="flex flex-col">
<legend><?= lang('Episode.form.transcript') .
            '<small class="ml-1 lowercase">(' .
            lang('Common.optional') .
            ')</small>' .
            hint_tooltip(lang('Episode.form.transcript_hint'), 'ml-1') ?></legend>
<div class="form-input-tabs">
    <input type="radio" name="transcript-choice" id="transcript-file-upload-choice" aria-controls="transcript-file-upload-choice" value="upload-file" <?= old('transcript-choice') !== 'remote-file' ? 'checked' : '' ?> />
    <label for="transcript-file-upload-choice"><?= lang('Common.forms.upload_file') ?></label>

    <input type="radio" name="transcript-choice" id="transcript-file-remote-url-choice" aria-controls="transcript-file-remote-url-choice" value="remote-url" <?= old('transcript-choice') === 'remote-file' ? 'checked' : '' ?> />
    <label for="transcript-file-remote-url-choice"><?= lang('Common.forms.remote_url') ?></label>

    <div class="py-2 tab-panels">
        <section id="transcript-file-upload" class="flex items-center tab-panel">
            <Forms.Label class="sr-only" for="transcript_file" isOptional="true"><?= lang('Episode.form.transcript_file') ?></Forms.Label>
            <Forms.Input class="w-full" name="transcript_file" type="file" accept=".txt,.html,.srt,.json" />
        </section>
        <section id="transcript-file-remote-url" class="tab-panel">
            <Forms.Label class="sr-only" for="transcript_remote_url" isOptional="true"><?= lang('Episode.form.transcript_remote_url') ?></Forms.Label>
            <Forms.Input class="w-full" placeholder="https://…" name="transcript_remote_url" />
        </section>
    </div>
</div>
</fieldset>


<fieldset class="flex flex-col">
<legend><?= lang('Episode.form.chapters') .
            '<small class="ml-1 lowercase">(' .
            lang('Common.optional') .
            ')</small>' .
            hint_tooltip(lang('Episode.form.chapters_hint'), 'ml-1') ?></legend>
<div class="form-input-tabs">
    <input type="radio" name="chapters-choice" id="chapters-file-upload-choice" aria-controls="chapters-file-upload-choice" value="upload-file" <?= old('chapters-choice') !== 'remote-file' ? 'checked' : '' ?> />
    <label for="chapters-file-upload-choice"><?= lang('Common.forms.upload_file') ?></label>

    <input type="radio" name="chapters-choice" id="chapters-file-remote-url-choice" aria-controls="chapters-file-remote-url-choice" value="remote-url" <?= old('chapters-choice') === 'remote-file' ? 'checked' : '' ?> />
    <label for="chapters-file-remote-url-choice"><?= lang('Common.forms.remote_url') ?></label>

    <div class="py-2 tab-panels">
        <section id="chapters-file-upload" class="flex items-center tab-panel">
            <Forms.Label class="sr-only" for="chapters_file" isOptional="true"><?= lang('Episode.form.chapters_file') ?></Forms.Label>
            <Forms.Input class="w-full" name="chapters_file" type="file" accept=".json" />
        </section>
        <section id="chapters-file-remote-url" class="tab-panel">
            <Forms.Label class="sr-only" for="chapters_remote_url" isOptional="true"><?= lang('Episode.form.chapters_remote_url') ?></Forms.Label>
            <Forms.Input class="w-full" placeholder="https://…" name="chapters_remote_url" />
        </section>
    </div>
</div>
</fieldset>
</Forms.Section>

<Forms.Section
    title="<?= lang('Episode.form.advanced_section_title') ?>"
    subtitle="<?= lang('Episode.form.advanced_section_subtitle') ?>"
>
<Forms.Field 
    as="XMLEditor"
    name="custom_rss"
    label="<?= lang('Episode.form.custom_rss') ?>"
    hint="<?= lang('Episode.form.custom_rss_hint') ?>"
/>

</Forms.Section>

<Forms.Toggler name="block" value="yes" checked="false" hint="<?= lang('Episode.form.block_hint') ?>"><?= lang('Episode.form.block') ?></Forms.Toggler>

<Button class="self-end" variant="primary" type="submit"><?= lang('Episode.form.submit_create') ?></Button>

</form>

<?= $this->endSection() ?>
