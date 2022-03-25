<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button variant="primary" type="submit" form="episode-edit-form"><?= lang('Episode.form.submit_edit') ?></Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form id="episode-edit-form" action="<?= route_to('episode-edit', $podcast->id, $episode->id) ?>" method="POST" enctype="multipart/form-data" class="flex flex-col w-full max-w-xl mt-6 gap-y-8">
<?= csrf_field() ?>


<Forms.Section title="<?= lang('Episode.form.info_section_title') ?>" >

<Forms.Field
    name="audio_file"
    label="<?= lang('Episode.form.audio_file') ?>"
    hint="<?= lang('Episode.form.audio_file_hint') ?>"
    helper="<?= lang('Common.size_limit', [formatBytes(file_upload_max_size())]) ?>"
    type="file"
    accept=".mp3,.m4a"
    data-max-size="<?= file_upload_max_size() ?>"
    data-max-size-error="<?= lang('Episode.form.file_size_error', [formatBytes(file_upload_max_size())]) ?>" />

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
    value="<?= esc($episode->title) ?>"
    required="true"
    data-slugify="title" />

<div>
    <Forms.Label for="slug"><?= lang('Episode.form.permalink') ?></Forms.Label>
    <permalink-edit class="inline-flex items-center text-xs" edit-label="<?= lang('Common.edit') ?>" copy-label="<?= lang('Common.copy') ?>" copied-label="<?= lang('Common.copied') ?>">
        <span slot="domain"><?= base_url('/@' . esc($podcast->handle) . '/episodes') . '/' ?></span>
        <Forms.Input name="slug" value="<?= esc($episode->slug) ?>" required="true" data-slugify="slug" slot="slug-input" class="flex-1 text-xs" />
    </permalink-edit>
</div>

<div class="flex flex-col gap-x-2 gap-y-4 md:flex-row">
    <Forms.Field
        class="flex-1 w-full"
        name="season_number"
        label="<?= lang('Episode.form.season_number') ?>"
        type="number"
        value="<?= $episode->season_number ?>"
    />
    <Forms.Field
        class="flex-1 w-full"
        name="episode_number"
        label="<?= lang('Episode.form.episode_number') ?>"
        type="number"
        value="<?= $episode->number ?>"
        required="<?= $podcast->type === 'serial' ? 'true' : 'false' ?>"
    />
</div>

<fieldset class="flex gap-1">
<legend><?= lang('Episode.form.type.label') ?></legend>
<Forms.RadioButton
    value="full"
    name="type"
    hint="<?= lang('Episode.form.type.full_hint') ?>"
    isChecked="<?= $episode->type === 'full' ? 'true' : 'false' ?>" ><?= lang('Episode.form.type.full') ?></Forms.RadioButton>
<Forms.RadioButton
    value="trailer"
    name="type"
    hint="<?= lang('Episode.form.type.trailer_hint') ?>"
    isChecked="<?= $episode->type === 'trailer' ? 'true' : 'false' ?>" ><?= lang('Episode.form.type.trailer') ?></Forms.RadioButton>    
<Forms.RadioButton
    value="bonus"
    name="type"
    hint="<?= lang('Episode.form.type.bonus_hint') ?>"
    isChecked="<?= $episode->type === 'bonus' ? 'true' : 'false' ?>" ><?= lang('Episode.form.type.bonus') ?></Forms.RadioButton>
</fieldset>

<fieldset class="flex gap-1">
<legend>
    <?= lang('Episode.form.parental_advisory.label') .
        hint_tooltip(lang('Episode.form.parental_advisory.hint'), 'ml-1') ?>
</legend>
<Forms.RadioButton
    value="undefined"
    name="parental_advisory"
    isChecked="<?= $episode->parental_advisory === null ? 'true' : 'false' ?>" ><?= lang('Episode.form.parental_advisory.undefined') ?></Forms.RadioButton>
<Forms.RadioButton
    value="clean"
    name="parental_advisory"
    isChecked="<?= $episode->parental_advisory === 'clean' ? 'true' : 'false' ?>" ><?= lang('Episode.form.parental_advisory.clean') ?></Forms.RadioButton>    
<Forms.RadioButton
    value="explicit"
    name="parental_advisory"
    isChecked="<?= $episode->parental_advisory === 'explicit' ? 'true' : 'false' ?>" ><?= lang('Episode.form.parental_advisory.explicit') ?></Forms.RadioButton>
</fieldset>

</Forms.Section>


<Forms.Section
    title="<?= lang('Episode.form.show_notes_section_title') ?>"
    subtitle="<?= lang('Episode.form.show_notes_section_subtitle') ?>">

<Forms.Field
    as="MarkdownEditor"
    name="description"
    label="<?= lang('Episode.form.description') ?>"
    value="<?= esc($episode->description_markdown) ?>"
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

<Forms.Section
    title="<?= lang('Episode.form.location_section_title') ?>"
    subtitle="<?= lang('Episode.form.location_section_subtitle') ?>"
>
<Forms.Field
    name="location_name"
    label="<?= lang('Episode.form.location_name') ?>"
    hint="<?= lang('Episode.form.location_name_hint') ?>"
    value="<?= esc($episode->location_name) ?>" />
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
    <input type="radio" name="transcript-choice" id="transcript-file-upload-choice" aria-controls="transcript-file-upload-choice" value="upload-file" <?= $episode->transcript_remote_url ? '' : 'checked' ?> />
    <label for="transcript-file-upload-choice"><?= lang('Common.forms.upload_file') ?></label>

    <input type="radio" name="transcript-choice" id="transcript-file-remote-url-choice" aria-controls="transcript-file-remote-url-choice" value="remote-url" <?= $episode->transcript_remote_url ? 'checked' : '' ?> />
    <label for="transcript-file-remote-url-choice"><?= lang('Common.forms.remote_url') ?></label>

    <div class="py-2 tab-panels">
        <section id="transcript-file-upload" class="flex items-center tab-panel">
            <?php if ($episode->transcript) : ?>
                <div class="flex items-center mb-1 gap-x-2">
                    <?= anchor(
                $episode->transcript->file_url,
                icon('file-download', 'mr-1 text-skin-muted text-xl') . lang('Episode.form.transcript_download'),
                [
                    'class' => 'flex-1 font-semibold hover:underline inline-flex items-center text-xs',
                    'download' => '',
                ],
            ) .
                        anchor(
                            route_to(
                                'transcript-delete',
                                $podcast->id,
                                $episode->id,
                            ),
                            icon('delete-bin', 'mx-auto'),
                            [
                                'class' =>
                                'p-1 text-sm bg-red-100 rounded-full text-red-700 hover:text-red-900 focus:ring-accent',
                                'data-tooltip' => 'bottom',
                                'title' => lang(
                                    'Episode.form.transcript_file_delete',
                                ),
                            ],
                        ) ?>
                </div>
            <?php endif; ?>
            <Forms.Label class="sr-only" for="transcript_file" isOptional="true"><?= lang('Episode.form.transcript_file') ?></Forms.Label>
            <Forms.Input class="w-full" name="transcript_file" type="file" accept=".txt,.html,.srt,.json" />
        </section>
        <section id="transcript-file-remote-url" class="tab-panel">
            <Forms.Label class="sr-only" for="transcript_remote_url" isOptional="true"><?= lang('Episode.form.transcript_remote_url') ?></Forms.Label>
            <Forms.Input class="w-full" placeholder="https://…" name="transcript_remote_url" value="<?= esc($episode->transcript_remote_url) ?>" />
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
    <input type="radio" name="chapters-choice" id="chapters-file-upload-choice" aria-controls="chapters-file-upload-choice" value="upload-file" <?= $episode->chapters_remote_url ? '' : 'checked' ?> />
    <label for="chapters-file-upload-choice"><?= lang('Common.forms.upload_file') ?></label>

    <input type="radio" name="chapters-choice" id="chapters-file-remote-url-choice" aria-controls="chapters-file-remote-url-choice" value="remote-url" <?= $episode->chapters_remote_url ? 'checked' : '' ?> />
    <label for="chapters-file-remote-url-choice"><?= lang('Common.forms.remote_url') ?></label>

    <div class="py-2 tab-panels">
        <section id="chapters-file-upload" class="flex items-center tab-panel">
            <?php if ($episode->chapters) : ?>
                <div class="flex mb-1 gap-x-2">
                    <?= anchor(
                $episode->chapters->file_url,
                icon('file-download', 'mr-1 text-skin-muted text-xl') . lang('Episode.form.chapters_download'),
                [
                    'class' => 'flex-1 font-semibold hover:underline inline-flex items-center text-xs',
                    'download' => '',
                ],
            ) .
                    anchor(
                        route_to(
                            'chapters-delete',
                            $podcast->id,
                            $episode->id,
                        ),
                        icon('delete-bin', 'mx-auto'),
                        [
                            'class' =>
                            'text-sm p-1 bg-red-100 rounded-full text-red-700 hover:text-red-900 focus:ring-accent',
                            'data-tooltip' => 'bottom',
                            'title' => lang(
                                'Episode.form.chapters_file_delete',
                            ),
                        ],
                    ) ?>
                </div>
            <?php endif; ?>
            <Forms.Label class="sr-only" for="chapters_file" isOptional="true"><?= lang('Episode.form.chapters_file') ?></Forms.Label>
            <Forms.Input class="w-full" name="chapters_file" type="file" accept=".json" />
        </section>
        <section id="chapters-file-remote-url" class="tab-panel">
            <Forms.Label class="sr-only" for="chapters_remote_url" isOptional="true"><?= lang('Episode.form.chapters_remote_url') ?></Forms.Label>
            <Forms.Input class="w-full" placeholder="https://…" name="chapters_remote_url" value="<?= esc($episode->chapters_remote_url) ?>" />
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
    content="<?= esc($episode->custom_rss_string) ?>"
/>

</Forms.Section>

<Forms.Toggler id="block" name="block" value="yes" checked="<?= $episode->is_blocked ? 'true' : 'false' ?>" hint="<?= lang('Episode.form.block_hint') ?>"><?= lang('Episode.form.block') ?></Forms.Toggler>

</form>

<Button class="mt-8" variant="danger" uri="<?= route_to('episode-delete', $podcast->id, $episode->id) ?>" iconLeft="delete-bin"><?= lang('Episode.delete') ?></Button>


<?= $this->endSection() ?>
