<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Person.edit') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('person-edit', $person->id) ?>" method="POST" class="flex flex-col" enctype="multipart/form-data">
<?= csrf_field() ?>

<img src="<?= $person->image->thumbnail_url ?>" alt="<?= $person->full_name ?>" class="object-cover w-32 h-32 mt-3 rounded" />

<Forms.Field
    name="image"
    label="<?= lang('Person.form.image') ?>"
    helperText="<?= lang('Person.form.image_size_hint') ?>"
    type="file"
    accept=".jpg,.jpeg,.png" />

<Forms.Field
    name="full_name"
    value="<?= $person->full_name ?>"
    label="<?= lang('Person.form.full_name') ?>"
    hintText="<?= lang('Person.form.full_name_hint') ?>"
    required="true"
    data-slugify="title" />

<Forms.Field
    name="unique_name"
    value="<?= $person->unique_name ?>"
    label="<?= lang('Person.form.unique_name') ?>"
    hintText="<?= lang('Person.form.unique_name_hint') ?>"
    required="true" />
<Forms.Field
    name="information_url"
    label="<?= lang('Person.form.information_url') ?>"
    hintText="<?= lang('Person.form.information_url_hint') ?>"
    value="<?= $person->information_url ?>" />

<Button variant="primary" class="self-end" type="submit"><?= lang('Person.form.submit_edit') ?></Button>

</form>

<?= $this->endSection() ?>
