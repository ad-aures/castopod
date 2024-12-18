<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Page.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('page-create') ?>" method="POST" class="flex flex-col max-w-3xl gap-y-4">
<?= csrf_field() ?>

<x-Forms.Field
    name="title"
    label="<?= esc(lang('Page.form.title')) ?>"
    isRequired="true"
    data-slugify="title"
    class="max-w-sm" />

<x-Forms.PermalinkEditor
    name="slug"
    label="<?= lang('Page.form.permalink') ?>"
    prefix="…/pages/"
    data-slugify="slug"
    permalinkBase="<?= base_url('pages') ?>"
/>

<x-Forms.Field
    as="MarkdownEditor"
    name="content"
    label="<?= esc(lang('Page.form.content')) ?>"
    isRequired="true"
    rows="20" />

<x-Button variant="primary" type="submit" class="self-end"><?= lang('Page.form.submit_create') ?></x-Button>

</form>

<?= $this->endSection() ?>
