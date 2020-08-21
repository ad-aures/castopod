<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.import') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open_multipart(route_to('podcast_import'), [
    'method' => 'post',
    'class' => 'flex flex-col max-w-md',
]) ?>
<?= csrf_field() ?>


<div class="flex flex-col mb-4">
    <label for="name"><?= lang('Podcast.form_import.name') ?></label>
    <input type="text" class="form-input" id="name" name="name" value="<?= old(
        'name'
    ) ?>" required />
</div>

<div class="flex flex-col mb-4">
    <label for="name"><?= lang(
        'Podcast.form_import.imported_feed_url'
    ) ?></label>
    <input type="text" class="form-input" id="imported_feed_url" name="imported_feed_url" value="<?= old(
        'imported_feed_url'
    ) ?>" required />
</div>

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

<?= form_fieldset(lang('Podcast.form_import.slug_field.label'), [
    'class' => 'flex flex-col mb-4',
]) ?>
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

<?= form_fieldset(lang('Podcast.form_import.description_field.label'), [
    'class' => 'flex flex-col mb-4',
]) ?>
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
    <label for="subtitle_summary" class="inline-flex items-center">
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

<div class="flex flex-col mb-4">
    <label for="name"><?= lang('Podcast.form_import.season_number') ?></label>
    <input type="text" class="form-input" id="season_number" name="season_number" value="<?= old(
        'season_number'
    ) ?>" />
</div>

<div class="flex flex-col mb-4">
    <label for="max_episodes"><?= lang(
        'Podcast.form_import.max_episodes'
    ) ?></label>
    <input type="text" class="form-input" id="max_episodes" name="max_episodes" value="<?= old(
        'max_episodes'
    ) ?>" />
</div>

<button type="submit" name="submit"  onsubmit="this.disabled=true; this.value='<?= lang(
    'Podcast.form_import.submit_importing'
) ?>';" class="self-end px-4 py-2 bg-gray-200"><?= lang(
    'Podcast.form_import.submit_import'
) ?></button>
<?= form_close() ?>


<?= $this->endSection() ?>
