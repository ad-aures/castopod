<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.edit') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open_multipart(route_to('episode-edit', $podcast->id, $episode->id), [
    'method' => 'post',
    'class' => 'flex flex-col',
]) ?>
<?= csrf_field() ?>

<div class="inline-flex w-full p-2 mb-4 text-sm font-semibold text-yellow-800 bg-red-100 border border-red-300 rounded" role="alert">
    <?= icon('alert', 'mr-2 text-lg flex-shrink-0') .
        lang('Episode.form.warning') ?>
</div>

<?= form_section(
    lang('Episode.form.info_section_title'),
    '<img
    src="' .
        $episode->image->medium_url .
        '"
    alt="' .
        $episode->title .
        '"
    class="w-48"
/>',
) ?>

<Forms.Label for="audio_file" hint="<?= lang('Episode.form.audio_file_hint') ?>"><?= lang('Episode.form.audio_file') ?></Forms.Label>
<?= form_input([
    'id' => 'audio_file',
    'name' => 'audio_file',
    'class' => 'form-input mb-4',
    'type' => 'file',
    'accept' => '.mp3,.m4a',
]) ?>

<Forms.Label for="image" hint="<?= lang('Episode.form.image_hint') ?>" isOptional="true"><?= lang('Episode.form.image') ?></Forms.Label>
<?= form_input([
    'id' => 'image',
    'name' => 'image',
    'class' => 'form-input',
    'type' => 'file',
    'accept' => '.jpg,.jpeg,.png',
]) ?>
<small class="mb-4 text-gray-600"><?= lang(
    'Common.forms.image_size_hint',
) ?></small>

<Forms.Label for="title" hint="<?= lang('Episode.form.title_hint') ?>"><?= lang('Episode.form.title') ?></Forms.Label>
<?= form_input([
    'id' => 'title',
    'name' => 'title',
    'class' => 'form-input mb-4',
    'value' => old('title', $episode->title),
    'required' => 'required',
    'data-slugify' => 'title',
]) ?>

<Forms.Label for="slug"><?= lang('Episode.form.permalink') ?></Forms.Label>
<permalink-edit class="inline-flex items-center mb-4 text-xs" edit-label="<?= lang('Common.edit') ?>" copy-label="<?= lang('Common.copy') ?>" copied-label="<?= lang('Common.copied') ?>">
    <span slot="domain"><?= base_url('/@' . $podcast->handle . '/episodes') . '/' ?></span>
    <?= form_input([
        'id' => 'slug',
        'name' => 'slug',
        'class' => 'form-input flex-1 w-0 text-xs',
        'value' => old('slug', $episode->slug),
        'required' => 'required',
        'data-slugify' => 'slug',
        'slot' => 'slug-input'
    ]) ?>
</permalink-edit>

<div class="flex flex-col mb-4 gap-x-2 gap-y-4 md:flex-row">
    <div class="flex flex-col flex-1">
        <Forms.Label for="season_number"><?= lang('Episode.form.season_number') ?></Forms.Label>
        <?= form_input([
            'id' => 'season_number',
            'name' => 'season_number',
            'class' => 'form-input w-full',
            'value' => old('season_number', $episode->season_number),
            'type' => 'number',
        ]) ?>
    </div>
    <div class="flex flex-col flex-1">
        <Forms.Label for="episode_number"><?= lang('Episode.form.episode_number') ?></Forms.Label>
        <?= form_input([
            'id' => 'episode_number',
            'name' => 'episode_number',
            'class' => 'form-input w-full',
            'value' => old('episode_number', $episode->number),
            'type' => 'number',
        ]) ?>
    </div>
</div>

<?= form_fieldset('', ['class' => 'flex mb-4 gap-1']) ?>
<legend>
    <?= lang('Episode.form.type.label') .
        hint_tooltip(lang('Episode.form.type.hint'), 'ml-1') ?>
</legend>
<?= form_radio(
    ['id' => 'full', 'name' => 'type', 'class' => 'form-radio-btn'],
    'full',
    old('type') ? old('type') === 'full' : $episode->type === 'full',
) ?>
<label for="full" class="inline-flex items-center">
    <?= lang('Episode.form.type.full') ?>
</label>
<?= form_radio(
    ['id' => 'trailer', 'name' => 'type', 'class' => 'form-radio-btn'],
    'trailer',
    old('type') ? old('type') === 'trailer' : $episode->type === 'trailer',
) ?>
<label for="trailer" class="inline-flex items-center">
    <?= lang('Episode.form.type.trailer') ?>
</label>
<?= form_radio(
    ['id' => 'bonus', 'name' => 'type', 'class' => 'form-radio-btn'],
    'bonus',
    old('type') ? old('type') === 'bonus' : $episode->type === 'bonus',
) ?>
<label for="bonus" class="inline-flex items-center">
    <?= lang('Episode.form.type.bonus') ?>
</label>
<?= form_fieldset_close() ?>

<?= form_fieldset('', ['class' => 'mb-6']) ?>
<legend>
    <?= lang('Episode.form.parental_advisory.label') .
        hint_tooltip(lang('Episode.form.parental_advisory.hint'), 'ml-1') ?>
</legend>
<?= form_radio(
    [
        'id' => 'undefined',
        'name' => 'parental_advisory',
        'class' => 'form-radio-btn',
    ],
    'undefined',
    old('parental_advisory')
        ? old('parental_advisory') === 'undefined'
        : $episode->parental_advisory === null,
) ?>
<label for="undefined"><?= lang(
                            'Episode.form.parental_advisory.undefined',
                        ) ?></label>
<?= form_radio(
    [
        'id' => 'clean',
        'name' => 'parental_advisory',
        'class' => 'form-radio-btn',
    ],
    'clean',
    old('parental_advisory')
        ? old('parental_advisory') === 'clean'
        : $episode->parental_advisory === 'clean',
) ?>
<label for="clean"><?= lang(
                        'Episode.form.parental_advisory.clean',
                    ) ?></label>
<?= form_radio(
    [
        'id' => 'explicit',
        'name' => 'parental_advisory',
        'class' => 'form-radio-btn',
    ],
    'explicit',
    old('parental_advisory')
        ? old('parental_advisory') === 'explicit'
        : $episode->parental_advisory === 'explicit',
) ?>
<label for="explicit"><?= lang(
                            'Episode.form.parental_advisory.explicit',
                        ) ?></label>
<?= form_fieldset_close() ?>

<?= form_section_close() ?>


<?= form_section(
    lang('Episode.form.show_notes_section_title'),
    lang('Episode.form.show_notes_section_subtitle'),
) ?>

<div class="mb-4">
    <Forms.Label for="description"><?= lang('Episode.form.description') ?></Forms.Label>
    <Forms.MarkdownEditor id="description" name="description" required="required"><?= old('description', $episode->description_markdown, false) ?></Forms.MarkdownEditor>
</div>

<div class="mb-4">
    <Forms.Label for="description_footer" hint="<?= lang('Episode.form.description_footer_hint') ?>" isOptional="true"><?= lang('Episode.form.description_footer') ?></Forms.Label>
    <Forms.MarkdownEditor id="description_footer" name="description_footer" rows="6"><?= old('description_footer', $podcast->episode_description_footer_markdown ?? '', false) ?></Forms.MarkdownEditor>
</div>

<?= form_section_close() ?>

<?= form_section(
    lang('Episode.form.location_section_title'),
    lang('Episode.form.location_section_subtitle'),
) ?>

<Forms.Label for="location_name" hint="<?= lang('Episode.form.location_name_hint') ?>" isOptional="true"><?= lang('Episode.form.location_name') ?></Forms.Label>
<?= form_input([
    'id' => 'location_name',
    'name' => 'location_name',
    'class' => 'form-input mb-4',
    'value' => old('location_name', $episode->location_name),
]) ?>
<?= form_section_close() ?>


<?= form_section(
    lang('Episode.form.additional_files_section_title'),
    lang('Episode.form.additional_files_section_subtitle', [
        'podcastNamespaceLink' =>
        '“<a href="https://github.com/Podcastindex-org/podcast-namespace" target="_blank" rel="noreferrer noopener" style="text-decoration: underline;">podcast namespace</a>”',
    ]),
) ?>

<?= form_fieldset('', ['class' => 'flex flex-col mb-4']) ?>
<legend><?= lang('Episode.form.transcript') .
            '<small class="ml-1 lowercase">(' .
            lang('Common.optional') .
            ')</small>' .
            hint_tooltip(lang('Episode.form.transcript_hint'), 'ml-1') ?></legend>
<div class="mb-4 form-input-tabs">
    <input type="radio" name="transcript-choice" id="transcript-file-upload-choice" aria-controls="transcript-file-upload-choice" value="upload-file" <?= $episode->transcript_file_remote_url
                                                                                                                                                            ? ''
                                                                                                                                                            : 'checked' ?> />
    <label for="transcript-file-upload-choice"><?= lang(
                                                    'Common.forms.upload_file',
                                                ) ?></label>

    <input type="radio" name="transcript-choice" id="transcript-file-remote-url-choice" aria-controls="transcript-file-remote-url-choice" value="remote-url" <?= $episode->transcript_file_remote_url
                                                                                                                                                                    ? 'checked'
                                                                                                                                                                    : '' ?> />
    <label for="transcript-file-remote-url-choice"><?= lang(
                                                        'Common.forms.remote_url',
                                                    ) ?></label>

    <div class="py-2 tab-panels">
        <section id="transcript-file-upload" class="flex items-center tab-panel">
            <?php if ($episode->transcript_file) : ?>
                <div class="flex justify-between">
                    <?= anchor(
                        $episode->transcript_file_url,
                        icon('file', 'mr-2 text-gray-500') .
                            $episode->transcript_file,
                        [
                            'class' => 'inline-flex items-center text-xs',
                            'target' => '_blank',
                            'rel' => 'noreferrer noopener',
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
                                'p-1 bg-red-200 rounded-full text-red-700 hover:text-red-900',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'bottom',
                                'title' => lang(
                                    'Episode.form.transcript_file_delete',
                                ),
                            ],
                        ) ?>
                </div>
            <?php endif; ?>
            <Forms.Label class="sr-only" for="transcript_file" isOptional="true"><?= lang('Episode.form.transcript_file') ?></Forms.Label>
            <?= form_input([
                'id' => 'transcript_file',
                'name' => 'transcript_file',
                'class' => 'form-input',
                'type' => 'file',
                'accept' => '.txt,.html,.srt,.json',
            ]) ?>
        </section>
        <section id="transcript-file-remote-url" class="tab-panel">
            <Forms.Label class="sr-only" for="transcript_file_remote_url" isOptional="true"><?= lang('Episode.form.transcript_file_remote_url') ?></Forms.Label>
            <?= form_input([
                'id' => 'transcript_file_remote_url',
                'name' => 'transcript_file_remote_url',
                'class' => 'form-input w-full',
                'type' => 'url',
                'placeholder' => 'https://...',
                'value' => old(
                    'transcript_file_remote_url',
                    $episode->transcript_file_remote_url,
                ),
            ]) ?>
        </section>
    </div>
</div>
<?= form_fieldset_close() ?>

<?= form_fieldset('', ['class' => 'flex flex-col mb-4']) ?>
<legend><?= lang('Episode.form.chapters') .
            '<small class="ml-1 lowercase">(' .
            lang('Common.optional') .
            ')</small>' .
            hint_tooltip(lang('Episode.form.chapters_hint'), 'ml-1') ?></legend>
<div class="mb-4 form-input-tabs">
    <input type="radio" name="chapters-choice" id="chapters-file-upload-choice" aria-controls="chapters-file-upload-choice" value="upload-file" <?= $episode->chapters_file_remote_url
                                                                                                                                                    ? ''
                                                                                                                                                    : 'checked' ?> />
    <label for="chapters-file-upload-choice"><?= lang(
                                                    'Common.forms.upload_file',
                                                ) ?></label>

    <input type="radio" name="chapters-choice" id="chapters-file-remote-url-choice" aria-controls="chapters-file-remote-url-choice" value="remote-url" <?= $episode->chapters_file_remote_url
                                                                                                                                                            ? 'checked'
                                                                                                                                                            : '' ?> />
    <label for="chapters-file-remote-url-choice"><?= lang(
                                                        'Common.forms.remote_url',
                                                    ) ?></label>

    <div class="py-2 tab-panels">
        <section id="chapters-file-upload" class="flex items-center tab-panel">
            <?php if ($episode->chapters_file) : ?>
                <div class="flex justify-between">
                    <?= anchor(
                        $episode->chapters_file_url,
                        icon('file', 'mr-2') . $episode->chapters_file,
                        [
                            'class' => 'inline-flex items-center text-xs',
                            'target' => '_blank',
                            'rel' => 'noreferrer noopener',
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
                                'p-1 bg-red-200 rounded-full text-red-700 hover:text-red-900',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'bottom',
                                'title' => lang(
                                    'Episode.form.chapters_file_delete',
                                ),
                            ],
                        ) ?>
                </div>
            <?php endif; ?>
            <Forms.Label class="sr-only" for="chapters_file" isOptional="true"><?= lang('Episode.form.chapters_file') ?></Forms.Label>
            <?= form_input([
                'id' => 'chapters_file',
                'name' => 'chapters_file',
                'class' => 'form-input',
                'type' => 'file',
                'accept' => '.json',
            ]) ?>
        </section>
        <section id="chapters-file-remote-url" class="tab-panel">
            <Forms.Label class="sr-only" for="chapters_file_remote_url" isOptional="true"><?= lang('Episode.form.chapters_file_remote_url') ?></Forms.Label>
            <?= form_input([
                'id' => 'chapters_file_remote_url',
                'name' => 'chapters_file_remote_url',
                'class' => 'form-input w-full',
                'type' => 'url',
                'placeholder' => 'https://...',
                'value' => old(
                    'chapters_file_remote_url',
                    $episode->chapters_file_remote_url,
                ),
            ]) ?>
        </section>
    </div>
</div>
<?= form_fieldset_close() ?>

<?= form_section_close() ?>

<?= form_section(
    lang('Episode.form.advanced_section_title'),
    lang('Episode.form.advanced_section_subtitle'),
) ?>
<Forms.Label for="custom_rss" hint="<?= lang('Episode.form.custom_rss_hint') ?>" isOptional="true"><?= lang('Episode.form.custom_rss') ?></Forms.Label>
<Forms.XMLEditor id="custom_rss" name="custom_rss"><?= old('custom_rss', $episode->custom_rss_string, false) ?></Forms.XMLEditor>

<?= form_section_close() ?>

<Forms.Toggler id="block" name="block" value="yes" checked="<?= old('block', $episode->is_blocked) ?>" hint="<?= lang('Episode.form.block_hint') ?>"><?= lang('Episode.form.block') ?></Forms.Toggler>

<?= button(
    lang('Episode.form.submit_edit'),
    '',
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>


<?= $this->endSection() ?>
