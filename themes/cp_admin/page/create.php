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

<div class="flex flex-col max-w-sm">
    <x-Forms.Label for="slug"><?= lang('Page.form.permalink') ?></x-Forms.Label>
    <permalink-edit class="inline-flex items-center w-full text-xs" edit-label="<?= lang('Common.edit') ?>" copy-label="<?= lang('Common.copy') ?>" copied-label="<?= lang('Common.copied') ?>" permalink-base="<?= base_url('pages') ?>">
        <span slot="domain" class="flex-shrink-0">…/pages/</span>
        <x-Forms.Input name="slug" isRequired="true" data-slugify="slug" slot="slug-input" class="flex-1 text-xs" />
    </permalink-edit>
</div>

<x-Forms.Field
    as="MarkdownEditor"
    name="content"
    label="<?= esc(lang('Page.form.content')) ?>"
    isRequired="true"
    rows="20" />

<x-Button variant="primary" type="submit" class="self-end"><?= lang('Page.form.submit_create') ?></x-Button>

</form>

<?= $this->endSection() ?>
