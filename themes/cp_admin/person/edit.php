<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Person.edit') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('person-edit', $person->id) ?>" method="POST" class="flex flex-col max-w-sm gap-y-4" enctype="multipart/form-data">
<?= csrf_field() ?>

<Forms.Field
    name="avatar"
    label="<?= lang('Person.form.avatar') ?>"
    helper="<?= lang('Person.form.avatar_size_hint') ?>"
    type="file"
    accept=".jpg,.jpeg,.png" />

<Forms.Field
    name="full_name"
    value="<?= esc($person->full_name) ?>"
    label="<?= lang('Person.form.full_name') ?>"
    hint="<?= lang('Person.form.full_name_hint') ?>"
    required="true"
    data-slugify="title" />

<Forms.Field
    name="unique_name"
    value="<?= esc($person->unique_name) ?>"
    label="<?= lang('Person.form.unique_name') ?>"
    hint="<?= lang('Person.form.unique_name_hint') ?>"
    required="true"
    data-slugify="slug" />

<Forms.Field
    name="information_url"
    label="<?= lang('Person.form.information_url') ?>"
    hint="<?= lang('Person.form.information_url_hint') ?>"
    value="<?= esc($person->information_url) ?>" />

<Button variant="primary" class="self-end" type="submit"><?= lang('Person.form.submit_edit') ?></Button>

</form>

<?= $this->endSection() ?>
