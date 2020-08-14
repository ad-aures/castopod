<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.edit') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open_multipart(
    route_to('episode-edit', $episode->podcast->id, $episode->id),
    ['method' => 'post', 'class' => 'flex flex-col max-w-md']
) ?>
<?= csrf_field() ?>

<?= form_label(lang('Episode.form.enclosure'), 'enclosure') ?>
<?= form_input([
    'id' => 'enclosure',
    'name' => 'enclosure',
    'class' => 'form-input mb-4',
    'type' => 'file',
    'accept' => '.mp3,.m4a',
]) ?>

<?= form_label(lang('Episode.form.title'), 'title') ?>
<?= form_input([
    'id' => 'title',
    'name' => 'title',
    'class' => 'form-input mb-4',
    'value' => old('title', $episode->title),
    'required' => 'required',
    'data-slugify' => 'title',
]) ?>

<?= form_label(lang('Episode.form.slug'), 'slug') ?>
<?= form_input([
    'id' => 'slug',
    'name' => 'slug',
    'class' => 'form-input mb-4',
    'value' => old('slug', $episode->slug),
    'required' => 'required',
    'data-slugify' => 'slug',
]) ?>

<div class="mb-4">
    <?= form_label(lang('Episode.form.description'), 'description') ?>
    <?= form_textarea(
        [
            'id' => 'description',
            'name' => 'description',
            'class' => 'form-textarea',
            'required' => 'required',
        ],
        old('description', $episode->description, false),
        'data-editor="markdown"'
    ) ?>
</div>

<?= form_fieldset('', ['class' => 'flex mb-4']) ?>
<legend><?= lang('Episode.form.published_at.label') ?></legend>
<div class="flex flex-col flex-1">
    <?= form_label(lang('Episode.form.publication_date'), 'publication_date', [
        'class' => 'sr-only',
    ]) ?>
    <?= form_input([
        'id' => 'publication_date',
        'name' => 'publication_date',
        'class' => 'form-input',
        'value' => old(
            'publication_date',
            $episode->published_at
                ? $episode->published_at->format('Y-m-d')
                : ''
        ),
        'type' => 'date',
    ]) ?>
</div>

<div class="flex flex-col flex-1">
    <?= form_label(lang('Episode.form.publication_time'), 'publication_time', [
        'class' => 'sr-only',
    ]) ?>
    <?= form_input([
        'id' => 'publication_time',
        'name' => 'publication_time',
        'class' => 'form-input',
        'value' => old(
            'publication_time',
            $episode->published_at ? $episode->published_at->format('H:i') : ''
        ),
        'placeholder' => '--:--',
        'type' => 'time',
    ]) ?>
</div>
<?= form_fieldset_close() ?>

<?= form_label(lang('Episode.form.image'), 'image') ?>
<img src="<?= $episode->image_url ?>" alt="<?= $episode->title ?>" class="object-cover w-32 h-32" />
<?= form_input([
    'id' => 'image',
    'name' => 'image',
    'class' => 'form-input mb-4',
    'type' => 'file',
    'accept' => '.jpg,.jpeg,.png',
]) ?>

<?= form_label(lang('Episode.form.season_number'), 'season_number') ?>
<?= form_input([
    'id' => 'season_number',
    'name' => 'season_number',
    'class' => 'form-input mb-4',
    'value' => old('season_number', $episode->season_number),
    'type' => 'number',
]) ?>

<?= form_label(lang('Episode.form.episode_number'), 'episode_number') ?>
<?= form_input([
    'id' => 'episode_number',
    'name' => 'episode_number',
    'class' => 'form-input mb-4',
    'value' => old('episode_number', $episode->number),
    'required' => 'required',
    'type' => 'number',
]) ?>

<label class="inline-flex items-center mb-4">
    <?= form_checkbox(
        ['id' => 'explicit', 'name' => 'explicit', 'class' => 'form-checkbox'],
        'yes',
        old('explicit', $episode->explicit)
    ) ?>
    <span class="ml-2"><?= lang('Episode.form.explicit') ?></span>
</label>

<?= form_fieldset('', ['class' => 'flex flex-col mb-4']) ?>
    <legend><?= lang('Episode.form.type.label') ?></legend>
    <label for="full" class="inline-flex items-center">
        <?= form_radio(
            ['id' => 'full', 'name' => 'type', 'class' => 'form-radio'],
            'full',
            old('type') ? old('type') == 'full' : $episode->type == 'full'
        ) ?>
        <span class="ml-2"><?= lang('Episode.form.type.full') ?></span>
    </label>
    <label for="trailer" class="inline-flex items-center">
        <?= form_radio(
            ['id' => 'trailer', 'name' => 'type', 'class' => 'form-radio'],
            'trailer',
            old('type') ? old('type') == 'trailer' : $episode->type == 'trailer'
        ) ?>
        <span class="ml-2"><?= lang('Episode.form.type.trailer') ?></span>
    </label>
    <label for="bonus" class="inline-flex items-center">
        <?= form_radio(
            ['id' => 'bonus', 'name' => 'type', 'class' => 'form-radio'],
            'bonus',
            old('type') ? old('type') == 'bonus' : $episode->type == 'bonus'
        ) ?>
        <span class="ml-2"><?= lang('Episode.form.type.bonus') ?></span>
    </label>
<?= form_fieldset_close() ?>

<label class="inline-flex items-center mb-4">
    <?= form_checkbox(
        ['id' => 'block', 'name' => 'block', 'class' => 'form-checkbox'],
        'yes',
        old('block', $episode->block)
    ) ?>
    <span class="ml-2"><?= lang('Episode.form.block') ?></span>
</label>

<?= form_button([
    'content' => lang('Episode.form.submit_edit'),
    'type' => 'submit',
    'class' => 'self-end px-4 py-2 bg-gray-200',
]) ?>

<?= form_close() ?>


<?= $this->endSection() ?>
