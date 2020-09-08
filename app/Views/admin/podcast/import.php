<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.import') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open_multipart(route_to('rzqr'), [
    'method' => 'post',
    'class' => 'flex flex-col max-w-md',
]) ?>
<?= csrf_field() ?>

<?= form_label(lang('Podcast.form_import.name'), 'name') ?>
<?= form_input([
    'id' => 'name',
    'name' => 'name',
    'class' => 'form-input mb-4',
    'value' => old('name'),
    'required' => 'required',
]) ?>

<?= form_label(
    lang('Podcast.form_import.imported_feed_url'),
    'imported_feed_url'
) ?>
<?= form_input([
    'id' => 'imported_feed_url',
    'name' => 'imported_feed_url',
    'class' => 'form-input mb-4',
    'value' => old('imported_feed_url'),
    'type' => 'url',
    'required' => 'required',
]) ?>

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

<?= form_fieldset('', ['class' => 'flex flex-col mb-4']) ?>
    <legend><?= lang('Podcast.form_import.slug_field.label') ?></legend>
    <label for="link" class="inline-flex items-center">
        <?= form_radio(
            ['id' => 'link', 'name' => 'slug_field', 'class' => 'form-radio'],
            'link',
            old('slug_field') ? old('slug_field') == 'link' : true
        ) ?>
        <span class="ml-2"><?= lang(
            'Podcast.form_import.slug_field.link'
        ) ?></span>
    </label>
    <label for="title" class="inline-flex items-center">
        <?= form_radio(
            ['id' => 'title', 'name' => 'slug_field', 'class' => 'form-radio'],
            'title',
            old('slug_field') ? old('slug_field') == 'title' : false
        ) ?>
        <span class="ml-2"><?= lang(
            'Podcast.form_import.slug_field.title'
        ) ?></span>
    </label>
<?= form_fieldset_close() ?>

<?= form_fieldset('', ['class' => 'flex flex-col mb-4']) ?>
    <legend><?= lang('Podcast.form_import.description_field.label') ?></legend>
    <label for="description" class="inline-flex items-center">
        <?= form_radio(
            [
                'id' => 'description',
                'name' => 'description_field',
                'class' => 'form-radio',
            ],
            'description',
            old('description_field')
                ? old('description_field') == 'description'
                : true
        ) ?>
        <span class="ml-2"><?= lang(
            'Podcast.form_import.description_field.description'
        ) ?></span>
    </label>
    <label for="summary" class="inline-flex items-center">
        <?= form_radio(
            [
                'id' => 'summary',
                'name' => 'description_field',
                'class' => 'form-radio',
            ],
            'summary',
            old('description_field')
                ? old('description_field') == 'summary'
                : false
        ) ?>
        <span class="ml-2"><?= lang(
            'Podcast.form_import.description_field.summary'
        ) ?></span>
    </label>
    <label for="subtitle_summary" class="inline-flex items-center">
        <?= form_radio(
            [
                'id' => 'subtitle_summary',
                'name' => 'description_field',
                'class' => 'form-radio',
            ],
            'subtitle_summary',
            old('description_field')
                ? old('description_field') == 'subtitle_summary'
                : false
        ) ?>
        <span class="ml-2"><?= lang(
            'Podcast.form_import.description_field.subtitle_summary'
        ) ?></span>
    </label>
<?= form_fieldset_close() ?>


<label class="inline-flex items-center mb-4">
    <?= form_checkbox(
        [
            'id' => 'force_renumber',
            'name' => 'force_renumber',
            'class' => 'form-checkbox',
        ],
        'yes',
        old('force_renumber', false)
    ) ?>
    <span class="ml-2"><?= lang('Podcast.form_import.force_renumber') ?></span>
</label>

<?= form_label(lang('Podcast.form_import.season_number'), 'season_number') ?>
<?= form_input([
    'id' => 'season_number',
    'name' => 'season_number',
    'class' => 'form-input mb-4',
    'value' => old('season_number'),
    'type' => 'number',
]) ?>

<?= form_label(lang('Podcast.form_import.max_episodes'), 'max_episodes') ?>
<?= form_input([
    'id' => 'max_episodes',
    'name' => 'max_episodes',
    'class' => 'form-input mb-4',
    'value' => old('max_episodes'),
    'type' => 'number',
]) ?>

<?= form_button([
    'content' => lang('Podcast.form_import.submit_import'),
    'type' => 'submit',
    'class' => 'self-end px-4 py-2 bg-gray-200',
]) ?>

<?= form_close() ?>


<?= $this->endSection() ?>
