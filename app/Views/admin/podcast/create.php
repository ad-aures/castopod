<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.create') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open_multipart(route_to('podcast-create'), [
    'method' => 'post',
    'class' => 'flex flex-col',
]) ?>
<?= csrf_field() ?>

<?= form_section(
    lang('Podcast.form.identity_section_title'),
    lang('Podcast.form.identity_section_subtitle')
) ?>

<?= form_label(lang('Podcast.form.image'), 'image') ?>
<?= form_input([
    'id' => 'image',
    'name' => 'image',
    'class' => 'form-input',
    'required' => 'required',
    'type' => 'file',
    'accept' => '.jpg,.jpeg,.png',
]) ?>
<small class="mb-4 text-gray-600"><?= lang(
    'Common.forms.image_size_hint'
) ?></small>

<?= form_label(lang('Podcast.form.title'), 'title') ?>
<?= form_input([
    'id' => 'title',
    'name' => 'title',
    'class' => 'form-input mb-4',
    'value' => old('title'),
    'required' => 'required',
]) ?>

<?= form_label(
    lang('Podcast.form.name'),
    'name',
    [],
    lang('Podcast.form.name_hint')
) ?>
<?= form_input([
    'id' => 'name',
    'name' => 'name',
    'class' => 'form-input mb-4',
    'value' => old('name'),
    'required' => 'required',
]) ?>

<?= form_fieldset('', [
    'class' => 'mb-4',
]) ?>
    <legend>
    <?= lang('Podcast.form.type.label') .
        hint_tooltip(lang('Podcast.form.type.hint'), 'ml-1') ?>
    </legend>
    <?= form_radio(
        ['id' => 'episodic', 'name' => 'type', 'class' => 'form-radio-btn'],
        'episodic',
        old('type') ? old('type') == 'episodic' : true
    ) ?>
    <label for="episodic"><?= lang('Podcast.form.type.episodic') ?></label>
    <?= form_radio(
        ['id' => 'serial', 'name' => 'type', 'class' => 'form-radio-btn'],
        'serial',
        old('type') ? old('type') == 'serial' : false
    ) ?>
    <label for="serial"><?= lang('Podcast.form.type.serial') ?></label>
<?= form_fieldset_close() ?>

<div class="mb-4">
    <?= form_label(lang('Podcast.form.description'), 'description') ?>
    <?= form_textarea(
        [
            'id' => 'description',
            'name' => 'description',
            'class' => 'form-textarea',
            'required' => 'required',
        ],
        old('description', '', false),
        'data-editor="markdown"'
    ) ?>
</div>

<?= form_section_close() ?>


<?= form_section(
    lang('Podcast.form.classification_section_title'),
    lang('Podcast.form.classification_section_subtitle')
) ?>

<?= form_label(lang('Podcast.form.language'), 'language') ?>
<?= form_dropdown('language', $languageOptions, old('language', $browserLang), [
    'id' => 'language',
    'class' => 'form-select mb-4',
    'required' => 'required',
]) ?>

<?= form_label(lang('Podcast.form.category'), 'category') ?>
<?= form_dropdown('category', $categoryOptions, old('category'), [
    'id' => 'category',
    'class' => 'form-select mb-4',
    'required' => 'required',
]) ?>

<?= form_label(
    lang('Podcast.form.other_categories'),
    'other_categories',
    [],
    '',
    true
) ?>
<?= form_multiselect(
    'other_categories[]',
    $categoryOptions,
    old('other_categories', []),
    [
        'id' => 'other_categories',
        'class' => 'mb-4',
        'data-max-item-count' => '2',
    ]
) ?>

<?= form_fieldset('', ['class' => 'mb-4']) ?>
    <legend>
    <?= lang('Podcast.form.parental_advisory.label') .
        hint_tooltip(lang('Podcast.form.parental_advisory.hint'), 'ml-1') ?>
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
            : true
    ) ?>
    <label for="undefined"><?= lang(
        'Podcast.form.parental_advisory.undefined'
    ) ?></label>
    <?= form_radio(
        [
            'id' => 'clean',
            'name' => 'parental_advisory',
            'class' => 'form-radio-btn',
        ],
        'clean',
        old('parental_advisory') ? old('parental_advisory') === 'clean' : false
    ) ?>
    <label for="clean"><?= lang(
        'Podcast.form.parental_advisory.clean'
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
            : false
    ) ?>
    <label for="explicit"><?= lang(
        'Podcast.form.parental_advisory.explicit'
    ) ?></label>
<?= form_fieldset_close() ?>

<?= form_section_close() ?>


<?= form_section(
    lang('Podcast.form.author_section_title'),
    lang('Podcast.form.author_section_subtitle')
) ?>

<?= form_label(
    lang('Podcast.form.owner_name'),
    'owner_name',
    [],
    lang('Podcast.form.owner_name_hint')
) ?>
<?= form_input([
    'id' => 'owner_name',
    'name' => 'owner_name',
    'class' => 'form-input mb-4',
    'value' => old('owner_name'),
    'required' => 'required',
]) ?>

<?= form_label(
    lang('Podcast.form.owner_email'),
    'owner_email',
    [],
    lang('Podcast.form.owner_email_hint')
) ?>
<?= form_input([
    'id' => 'owner_email',
    'name' => 'owner_email',
    'class' => 'form-input mb-4',
    'value' => old('owner_email'),
    'type' => 'email',
    'required' => 'required',
]) ?>

<?= form_label(
    lang('Podcast.form.publisher'),
    'publisher',
    [],
    lang('Podcast.form.publisher_hint'),
    true
) ?>
<?= form_input([
    'id' => 'publisher',
    'name' => 'publisher',
    'class' => 'form-input mb-4',
    'value' => old('publisher'),
]) ?>

<?= form_label(lang('Podcast.form.copyright'), 'copyright', [], '', true) ?>
<?= form_input([
    'id' => 'copyright',
    'name' => 'copyright',
    'class' => 'form-input mb-4',
    'value' => old('copyright'),
]) ?>

<?= form_section_close() ?>


<?= form_section(
    lang('Podcast.form.status_section_title'),
    lang('Podcast.form.status_section_subtitle')
) ?>

<?= form_switch(
    lang('Podcast.form.block'),
    [
        'id' => 'block',
        'name' => 'block',
    ],
    'yes',
    old('block', false),
    'mb-2'
) ?>

<?= form_switch(
    lang('Podcast.form.complete'),
    [
        'id' => 'complete',
        'name' => 'complete',
    ],
    'yes',
    old('complete', false),
    'mb-2'
) ?>

<?= form_switch(
    lang('Podcast.form.lock') .
        hint_tooltip(lang('Podcast.form.lock_hint'), 'ml-1'),
    ['id' => 'lock', 'name' => 'lock'],
    'yes',
    old('lock', true)
) ?>

<?= form_section_close() ?>


<?= button(
    lang('Podcast.form.submit_create'),
    null,
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end']
) ?>


<?= form_close() ?>


<?= $this->endSection() ?>
