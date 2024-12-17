<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<x-Button variant="primary" type="submit" form="episode-edit-form"><?= lang('Episode.form.submit_edit') ?></x-Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form id="episode-edit-form" action="<?= route_to('episode-edit', $podcast->id, $episode->id) ?>" method="POST" enctype="multipart/form-data" class="flex flex-col w-full max-w-xl mt-6 gap-y-8">
<?= csrf_field() ?>


<x-Forms.Section title="<?= lang('Episode.form.info_section_title') ?>" >

<x-Forms.Field
    name="audio_file"
    label="<?= esc(lang('Episode.form.audio_file')) ?>"
    hint="<?= esc(lang('Episode.form.audio_file_hint')) ?>"
    helper="<?= esc(lang('Common.size_limit', [formatBytes(file_upload_max_size(), true)])) ?>"
    type="file"
    accept=".mp3,.m4a"
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
    value="<?= esc($episode->title) ?>"
    isRequired="true" />

<div>
    <x-Forms.Label for="slug"><?= lang('Episode.form.permalink') ?></x-Forms.Label>
    <permalink-edit class="inline-flex items-center w-full text-xs" edit-label="<?= lang('Common.edit') ?>" copy-label="<?= lang('Common.copy') ?>" copied-label="<?= lang('Common.copied') ?>" permalink-base="<?= url_to('podcast-episodes', esc($podcast->handle)) ?>">
        <span slot="domain"><?= '…/' . esc($podcast->handle) . '/' ?></span>
        <x-Forms.Input name="slug" value="<?= esc($episode->slug) ?>" isRequired="true" data-slugify="slug" slot="slug-input" class="flex-1 text-xs" />
    </permalink-edit>
</div>

<div class="flex flex-col gap-x-2 gap-y-4 md:flex-row">
    <x-Forms.Field
        class="flex-1 w-full"
        name="season_number"
        label="<?= esc(lang('Episode.form.season_number')) ?>"
        type="number"
        value="<?= $episode->season_number ?>"
    />
    <x-Forms.Field
        class="flex-1 w-full"
        name="episode_number"
        label="<?= esc(lang('Episode.form.episode_number')) ?>"
        type="number"
        value="<?= $episode->number ?>"
        required="<?= $podcast->type === 'serial' ? 'true' : 'false' ?>"
    />
</div>

<x-Forms.RadioGroup
    label="<?= lang('Episode.form.type.label') ?>"
    name="type"
    value="<?= $episode->type ?>"
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
    value="<?= $episode->parental_advisory ?>"
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
    value="<?= esc($episode->description_markdown) ?>"
    isRequired="true"
    disallowList="header,quote" />

</x-Forms.Section>

<x-Forms.Section title="<?= lang('Episode.form.premium_title') ?>" >
    <x-Forms.Toggler class="mt-2" name="premium" isChecked="<?= $episode->is_premium ? 'true' : 'false' ?>">
        <?= lang('Episode.form.premium') ?></x-Forms.Toggler>
</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Episode.form.location_section_title') ?>"
    subtitle="<?= lang('Episode.form.location_section_subtitle') ?>"
>
<x-Forms.Field
    name="location_name"
    label="<?= esc(lang('Episode.form.location_name')) ?>"
    hint="<?= esc(lang('Episode.form.location_name_hint')) ?>"
    value="<?= esc($episode->location_name) ?>" />
</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Episode.form.additional_files_section_title') ?>">

<fieldset class="flex flex-col">
<legend><?= lang('Episode.form.transcript') .
            '<small class="ml-1 lowercase">(' .
            lang('Common.optional') .
            ')</small>' ?><x-Hint class="ml-1"><?= lang('Episode.form.transcript_hint') ?></x-Hint></legend>
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
                        icon('file-download-fill', [
                            'class' => 'mr-1 text-skin-muted text-xl',
                        ]) . lang('Episode.form.transcript_download'),
                        [
                            'class'    => 'flex-1 font-semibold hover:underline inline-flex items-center text-xs',
                            'download' => '',
                        ],
                    ) .
                        anchor(
                            route_to(
                                'transcript-delete',
                                $podcast->id,
                                $episode->id,
                            ),
                            icon('delete-bin-fill', [
                                'class' => 'mx-auto',
                            ]),
                            [
                                'class'        => 'p-1 text-sm bg-red-100 rounded-full text-red-700 hover:text-red-900',
                                'data-tooltip' => 'bottom',
                                'title'        => lang(
                                    'Episode.form.transcript_file_delete',
                                ),
                            ],
                        ) ?>
                </div>
            <?php endif; ?>
            <x-Forms.Label class="sr-only" for="transcript_file" isOptional="true"><?= lang('Episode.form.transcript_file') ?></x-Forms.Label>
            <x-Forms.Input class="w-full" name="transcript_file" type="file" accept=".srt,.vtt" />
        </section>
        <section id="transcript-file-remote-url" class="tab-panel">
            <x-Forms.Label class="sr-only" for="transcript_remote_url" isOptional="true"><?= lang('Episode.form.transcript_remote_url') ?></x-Forms.Label>
            <x-Forms.Input class="w-full" placeholder="https://…" name="transcript_remote_url" value="<?= esc($episode->transcript_remote_url) ?>" />
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
                        icon('file-download-fill', [
                            'class' => 'mr-1 text-skin-muted text-xl',
                        ]) . lang('Episode.form.chapters_download'),
                        [
                            'class'    => 'flex-1 font-semibold hover:underline inline-flex items-center text-xs',
                            'download' => '',
                        ],
                    ) .
                    anchor(
                        route_to(
                            'chapters-delete',
                            $podcast->id,
                            $episode->id,
                        ),
                        icon('delete-bin-fill', [
                            'class' => 'mx-auto',
                        ]),
                        [
                            'class'        => 'text-sm p-1 bg-red-100 rounded-full text-red-700 hover:text-red-900',
                            'data-tooltip' => 'bottom',
                            'title'        => lang(
                                'Episode.form.chapters_file_delete',
                            ),
                        ],
                    ) ?>
                </div>
            <?php endif; ?>
            <x-Forms.Label class="sr-only" for="chapters_file" isOptional="true"><?= lang('Episode.form.chapters_file') ?></x-Forms.Label>
            <x-Forms.Input class="w-full" name="chapters_file" type="file" accept=".json" />
        </section>
        <section id="chapters-file-remote-url" class="tab-panel">
            <x-Forms.Label class="sr-only" for="chapters_remote_url" isOptional="true"><?= lang('Episode.form.chapters_remote_url') ?></x-Forms.Label>
            <x-Forms.Input class="w-full" placeholder="https://…" name="chapters_remote_url" value="<?= esc($episode->chapters_remote_url) ?>" />
        </section>
    </div>
</div>
</fieldset>
</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Episode.form.advanced_section_title') ?>"
    subtitle="<?= lang('Episode.form.advanced_section_subtitle') ?>"
>

<x-Forms.Toggler id="block" name="block" isChecked="<?= $episode->is_blocked ? 'true' : 'false' ?>" hint="<?= esc(lang('Episode.form.block_hint')) ?>"><?= lang('Episode.form.block') ?></x-Forms.Toggler>

</x-Forms.Section>

</form>

<?php if ($episode->published_at === null): ?>
    <?php // @icon("delete-bin-fill")?>
    <x-Button class="mt-8" variant="danger" uri="<?= route_to('episode-delete', $podcast->id, $episode->id) ?>" iconLeft="delete-bin-fill"><?= lang('Episode.delete') ?></x-Button>    
<?php else: ?>
    <?php // @icon("forbid-fill")?>
    <x-Button class="mt-8" variant="disabled" iconLeft="forbid-fill" data-tooltip="right" title="<?= lang('Episode.messages.unpublishBeforeDeleteTip') ?>"><?= lang('Episode.delete') ?></x-Button>
<?php endif ?>


<?= $this->endSection() ?>
