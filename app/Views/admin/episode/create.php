<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.create') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open_multipart(route_to('episode-create', $podcast->id), [
    'method' => 'post',
    'class' => 'flex flex-col',
]) ?>
<?= csrf_field() ?>
<?= form_hidden('client_timezone', 'UTC') ?>

<div class="inline-flex w-full p-2 mb-4 text-sm font-semibold text-yellow-800 bg-red-100 border border-red-300 rounded" role="alert">
  <?= icon('alert', 'mr-2 text-lg flex-shrink-0') .
      lang('Episode.form.warning') ?>
</div>

<?= form_section(
    lang('Episode.form.info_section_title'),
    lang('Episode.form.info_section_subtitle'),
) ?>

<?= form_label(
    lang('Episode.form.audio_file'),
    'audio_file',
    [],
    lang('Episode.form.audio_file_hint'),
) ?>
<?= form_input([
    'id' => 'audio_file',
    'name' => 'audio_file',
    'class' => 'form-input mb-4',
    'required' => 'required',
    'type' => 'file',
    'accept' => '.mp3,.m4a',
]) ?>

<?= form_label(
    lang('Episode.form.image'),
    'image',
    [],
    lang('Episode.form.image_hint'),
    true,
) ?>
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

<?= form_label(
    lang('Episode.form.title'),
    'title',
    [],
    lang('Episode.form.title_hint'),
) ?>
<?= form_input([
    'id' => 'title',
    'name' => 'title',
    'class' => 'form-input mb-4',
    'value' => old('title'),
    'required' => 'required',
    'data-slugify' => 'title',
]) ?>

<?= form_label(
    lang('Episode.form.slug'),
    'slug',
    [],
    lang('Episode.form.slug_hint'),
) ?>
<?= form_input([
    'id' => 'slug',
    'name' => 'slug',
    'class' => 'form-input mb-4',
    'value' => old('slug'),
    'required' => 'required',
    'data-slugify' => 'slug',
]) ?>

<div class="flex flex-col mb-4 gap-x-2 gap-y-4 md:flex-row">
    <div class="flex flex-col flex-1">
        <?= form_label(lang('Episode.form.season_number'), 'season_number') ?>
        <?= form_input([
            'id' => 'season_number',
            'name' => 'season_number',
            'class' => 'form-input w-full',
            'value' => old('season_number'),
            'type' => 'number',
        ]) ?>
    </div>
    <div class="flex flex-col flex-1">
        <?= form_label(lang('Episode.form.episode_number'), 'episode_number') ?>
        <?= form_input([
            'id' => 'episode_number',
            'name' => 'episode_number',
            'class' => 'form-input w-full',
            'value' => old('episode_number'),
            'type' => 'number',
        ]) ?>
    </div>
</div>


<?= form_fieldset('', ['class' => 'mb-4']) ?>
    <legend>
    <?= lang('Episode.form.type.label') .
        hint_tooltip(lang('Episode.form.type.hint'), 'ml-1') ?>
    </legend>
    <?= form_radio(
        ['id' => 'full', 'name' => 'type', 'class' => 'form-radio-btn'],
        'full',
        old('type') ? old('type') == 'full' : true,
    ) ?>
    <label for="full" class="inline-flex items-center">
        <?= lang('Episode.form.type.full') ?>
    </label>
    <?= form_radio(
        ['id' => 'trailer', 'name' => 'type', 'class' => 'form-radio-btn'],
        'trailer',
        old('type') && old('type') == 'trailer',
    ) ?>
    <label for="trailer" class="inline-flex items-center">
        <?= lang('Episode.form.type.trailer') ?>
    </label>
    <?= form_radio(
        ['id' => 'bonus', 'name' => 'type', 'class' => 'form-radio-btn'],
        'bonus',
        old('type') && old('type') == 'bonus',
    ) ?>
    <label for="bonus" class="inline-flex items-center">
        <?= lang('Episode.form.type.bonus') ?>
    </label>
<?= form_fieldset_close() ?>

<?= form_fieldset('', ['class' => 'flex mb-6 gap-1']) ?>
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
            : true,
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
        old('parental_advisory') && old('parental_advisory') === 'clean',
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
        old('parental_advisory') && old('parental_advisory') === 'explicit',
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
    <?= form_label(lang('Episode.form.description'), 'description') ?>
    <?= form_textarea(
        [
            'id' => 'description',
            'name' => 'description',
            'class' => 'form-textarea',
            'required' => 'required',
        ],
        old('description', '', false),
        'data-editor="markdown"',
    ) ?>
</div>

<div class="mb-4">
    <?= form_label(
        lang('Episode.form.description_footer'),
        'description_footer',
        [],
        lang('Episode.form.description_footer_hint'),
    ) ?>
    <?= form_textarea(
        [
            'id' => 'description_footer',
            'name' => 'description_footer',
            'class' => 'form-textarea',
        ],
        old(
            'description_footer',
            $podcast->episode_description_footer_markdown ?? '',
            false,
        ),
        'data-editor="markdown"',
    ) ?>
</div>

<?= form_section_close() ?>

<?= form_section(
    lang('Episode.form.location_section_title'),
    lang('Episode.form.location_section_subtitle'),
) ?>

<?= form_label(
    lang('Episode.form.location_name'),
    'location_name',
    [],
    lang('Episode.form.location_name_hint'),
    true,
) ?>
<?= form_input([
    'id' => 'location_name',
    'name' => 'location_name',
    'class' => 'form-input mb-4',
    'value' => old('location_name'),
]) ?>
<?= form_section_close() ?>

<?= form_section(
    lang('Episode.form.additional_files_section_title'),
    lang('Episode.form.additional_files_section_subtitle'),
) ?>

<?= form_fieldset('', ['class' => 'flex flex-col mb-4']) ?>
    <legend><?= lang('Episode.form.transcript') .
        '<small class="ml-1 lowercase">(' .
        lang('Common.optional') .
        ')</small>' .
        hint_tooltip(lang('Episode.form.transcript_hint'), 'ml-1') ?></legend>
    <div class="mb-4 form-input-tabs">
        <input type="radio" name="transcript-choice" id="transcript-file-upload-choice" aria-controls="transcript-file-upload-choice" value="upload-file" <?= old(
            'transcript-choice',
        ) !== 'remote-url'
            ? 'checked'
            : '' ?> />
        <label for="transcript-file-upload-choice"><?= lang(
            'Common.forms.upload_file',
        ) ?></label>

        <input type="radio" name="transcript-choice" id="transcript-file-remote-url-choice" aria-controls="transcript-file-remote-url-choice" value="remote-url" <?= old(
            'transcript-choice',
        ) === 'remote-url'
            ? 'checked'
            : '' ?> />
        <label for="transcript-file-remote-url-choice"><?= lang(
            'Common.forms.remote_url',
        ) ?></label>

        <div class="py-2 tab-panels">
            <section id="transcript-file-upload" class="flex items-center tab-panel">
            <?= form_label(
                lang('Episode.form.transcript_file'),
                'transcript_file',
                ['class' => 'sr-only'],
                lang('Episode.form.transcript_file'),
                true,
            ) ?>
            <?= form_input([
                'id' => 'transcript_file',
                'name' => 'transcript_file',
                'class' => 'form-input',
                'type' => 'file',
                'accept' => '.txt,.html,.srt,.json',
            ]) ?>
            </section>
            <section id="transcript-file-remote-url" class="tab-panel">
            <?= form_label(
                lang('Episode.form.transcript_file_remote_url'),
                'transcript_file_remote_url',
                ['class' => 'sr-only'],
                lang('Episode.form.transcript_file_remote_url'),
                true,
            ) ?>
            <?= form_input([
                'id' => 'transcript_file_remote_url',
                'name' => 'transcript_file_remote_url',
                'class' => 'form-input w-full',
                'type' => 'url',
                'placeholder' => 'https://...',
                'value' => old('transcript_file_remote_url'),
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
        <input type="radio" name="chapters-choice" id="chapters-file-upload-choice" aria-controls="chapters-file-upload-choice" value="upload-file" <?= old(
            'chapters-choice',
        ) !== 'remote-url'
            ? 'checked'
            : '' ?> />
        <label for="chapters-file-upload-choice"><?= lang(
            'Common.forms.upload_file',
        ) ?></label>

        <input type="radio" name="chapters-choice" id="chapters-file-remote-url-choice" aria-controls="chapters-file-remote-url-choice" value="remote-url" <?= old(
            'chapters-choice',
        ) === 'remote-url'
            ? 'checked'
            : '' ?> />
        <label for="chapters-file-remote-url-choice"><?= lang(
            'Common.forms.remote_url',
        ) ?></label>

        <div class="py-2 tab-panels">
            <section id="chapters-file-upload" class="flex items-center tab-panel">
            <?= form_label(
                lang('Episode.form.chapters_file'),
                'chapters_file',
                ['class' => 'sr-only'],
                lang('Episode.form.chapters_file'),
                true,
            ) ?>
            <?= form_input([
                'id' => 'chapters_file',
                'name' => 'chapters_file',
                'class' => 'form-input',
                'type' => 'file',
                'accept' => '.json',
            ]) ?>
            </section>
            <section id="chapters-file-remote-url" class="tab-panel">
            <?= form_label(
                lang('Episode.form.chapters_file_remote_url'),
                'chapters_file_remote_url',
                ['class' => 'sr-only'],
                lang('Episode.form.chapters_file_remote_url'),
                true,
            ) ?>
            <?= form_input([
                'id' => 'chapters_file_remote_url',
                'name' => 'chapters_file_remote_url',
                'class' => 'form-input w-full',
                'type' => 'url',
                'placeholder' => 'https://...',
                'value' => old('chapters_file_remote_url'),
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
<?= form_label(
    lang('Episode.form.custom_rss'),
    'custom_rss',
    [],
    lang('Episode.form.custom_rss_hint'),
    true,
) ?>
<?= form_textarea([
    'id' => 'custom_rss',
    'name' => 'custom_rss',
    'class' => 'form-textarea',
    'value' => old('custom_rss'),
]) ?>
<?= form_section_close() ?>

<?= form_switch(
    lang('Episode.form.block') .
        hint_tooltip(lang('Episode.form.block_hint'), 'ml-1'),
    ['id' => 'block', 'name' => 'block'],
    'yes',
    old('block', false),
) ?>

<?= button(
    lang('Episode.form.submit_create'),
    '',
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>


<?= $this->endSection() ?>
