<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Person.edit') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open_multipart(route_to('person-edit', $person->id), [
    'method' => 'post',
    'class' => 'flex flex-col',
]) ?>
<?= csrf_field() ?>

<?= form_section(
    lang('Person.form.identity_section_title'),
    lang('Person.form.identity_section_subtitle') .
        "<img src=\"{$person->image->thumbnail_url}\" alt=\"{$person->full_name}\" class=\"object-cover w-32 h-32 mt-3 rounded\" />",
) ?>

<?= form_label(
    lang('Person.form.full_name'),
    'full_name',
    [],
    lang('Person.form.full_name_hint'),
) ?>
<?= form_input([
    'id' => 'full_name',
    'name' => 'full_name',
    'class' => 'form-input mb-4',
    'value' => old('full_name', $person->full_name),
    'required' => 'required',
    'data-slugify' => 'title',
]) ?>

<?= form_label(
    lang('Person.form.unique_name'),
    'unique_name',
    [],
    lang('Person.form.unique_name_hint'),
) ?>
<?= form_input([
    'id' => 'unique_name',
    'name' => 'unique_name',
    'class' => 'form-input mb-4',
    'value' => old('unique_name', $person->unique_name),
    'required' => 'required',
    'data-slugify' => 'slug',
]) ?>

<?= form_label(
    lang('Person.form.information_url'),
    'information_url',
    [],
    lang('Person.form.information_url_hint'),
    true,
) ?>
<?= form_input([
    'id' => 'information_url',
    'name' => 'information_url',
    'class' => 'form-input mb-4',
    'value' => old('information_url', $person->information_url),
]) ?>

<?= form_label(lang('Person.form.image'), 'image') ?>
<?= form_input([
    'id' => 'image',
    'name' => 'image',
    'class' => 'form-input',
    'type' => 'file',
    'accept' => '.jpg,.jpeg,.png',
]) ?>
<small class="mb-4 text-gray-600"><?= lang(
    'Person.form.image_size_hint',
) ?></small>

<?= form_section_close() ?>

<?= button(
    lang('Person.form.submit_edit'),
    '',
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>


<?= form_close() ?>


<?= $this->endSection() ?>
