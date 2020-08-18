<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open_multipart(route_to('podcast-create'), [
    'method' => 'post',
    'class' => 'flex flex-col max-w-md',
]) ?>
<?= csrf_field() ?>

<?= form_label(lang('Podcast.form.title'), 'title') ?>
<?= form_input([
    'id' => 'title',
    'name' => 'title',
    'class' => 'form-input mb-4',
    'value' => old('title'),
    'required' => 'required',
]) ?>

<?= form_label(lang('Podcast.form.name'), 'name') ?>
<?= form_input([
    'id' => 'name',
    'name' => 'name',
    'class' => 'form-input mb-4',
    'value' => old('name'),
    'required' => 'required',
]) ?>

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

<div class="mb-4">
    <?= form_label(
        lang('Podcast.form.episode_description_footer'),
        'episode_description_footer'
    ) ?>
    <?= form_textarea(
        [
            'id' => 'episode_description_footer',
            'name' => 'episode_description_footer',

            'class' => 'form-textarea',
        ],
        old('episode_description_footer', '', false),
        'data-editor="markdown"'
    ) ?>
</div>

<?= form_label(lang('Podcast.form.image'), 'image') ?>
<?= form_input([
    'id' => 'image',
    'name' => 'image',
    'class' => 'form-input mb-4',
    'required' => 'required',
    'type' => 'file',
    'accept' => '.jpg,.jpeg,.png',
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

<label class="inline-flex items-center mb-4">
    <?= form_checkbox(
        ['id' => 'explicit', 'name' => 'explicit', 'class' => 'form-checkbox'],
        'yes',
        old('explicit', false)
    ) ?>
    <span class="ml-2"><?= lang('Podcast.form.explicit') ?></span>
</label>

<?= form_label(lang('Podcast.form.owner_name'), 'owner_name') ?>
<?= form_input([
    'id' => 'owner_name',
    'name' => 'owner_name',
    'class' => 'form-input mb-4',
    'value' => old('owner_name'),
    'required' => 'required',
]) ?>

<?= form_label(lang('Podcast.form.owner_email'), 'owner_email') ?>
<?= form_input([
    'id' => 'owner_email',
    'name' => 'owner_email',
    'class' => 'form-input mb-4',
    'value' => old('owner_email'),
    'type' => 'email',
    'required' => 'required',
]) ?>

<?= form_label(lang('Podcast.form.author'), 'author') ?>
<?= form_input([
    'id' => 'author',
    'name' => 'author',
    'class' => 'form-input mb-4',
    'value' => old('author'),
]) ?>

<?= form_fieldset('', ['class' => 'flex flex-col mb-4']) ?>
    <legend><?= lang('Podcast.form.type.label') ?></legend>
    <label for="episodic" class="inline-flex items-center">
        <?= form_radio(
            ['id' => 'episodic', 'name' => 'type', 'class' => 'form-radio'],
            'episodic',
            old('type') ? old('type') == 'episodic' : true
        ) ?>
        <span class="ml-2"><?= lang('Podcast.form.type.episodic') ?></span>
    </label>
    <label for="serial" class="inline-flex items-center">
        <?= form_radio(
            ['id' => 'serial', 'name' => 'type', 'class' => 'form-radio'],
            'serial',
            old('type') ? old('type') == 'serial' : false
        ) ?>
        <span class="ml-2"><?= lang('Podcast.form.type.serial') ?></span>
    </label>
<?= form_fieldset_close() ?>

<?= form_label(lang('Podcast.form.copyright'), 'copyright') ?>
<?= form_input([
    'id' => 'copyright',
    'name' => 'copyright',
    'class' => 'form-input mb-4',
    'value' => old('copyright'),
]) ?>

<label class="inline-flex items-center mb-4">
    <?= form_checkbox(
        ['id' => 'block', 'name' => 'block', 'class' => 'form-checkbox'],
        'yes',
        old('block', false)
    ) ?>
    <span class="ml-2"><?= lang('Podcast.form.block') ?></span>
</label>

<label class="inline-flex items-center mb-4">
    <?= form_checkbox(
        ['id' => 'complete', 'name' => 'complete', 'class' => 'form-checkbox'],
        'yes',
        old('complete', false)
    ) ?>
    <span class="ml-2"><?= lang('Podcast.form.complete') ?></span>
</label>

<div class="mb-4">
    <?= form_label(lang('Podcast.form.custom_html_head'), 'custom_html_head') ?>
    <?= form_textarea(
        [
            'id' => 'custom_html_head',
            'name' => 'custom_html_head',
            'class' => 'form-textarea',
        ],
        old('custom_html_head', '', false),
        'data-editor="html"'
    ) ?>
</div>

<?= form_button([
    'content' => lang('Podcast.form.submit_create'),
    'type' => 'submit',
    'class' => 'self-end px-4 py-2 bg-gray-200',
]) ?>

<?= form_close() ?>


<?= $this->endSection() ?>
