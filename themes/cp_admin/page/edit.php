<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Page.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Page.edit') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('page-edit', $page->id) ?>" method="POST" class="flex flex-col max-w-3xl gap-y-4">
<?= csrf_field() ?>

<x-Forms.Field
    name="title"
    label="<?= esc(lang('Page.form.title')) ?>"
    isRequired="true"
    data-slugify="title"
    value="<?= esc($page->title) ?>"
    slot="slug-input"
    class="max-w-sm" />

<div class="flex flex-col max-w-sm">
    <x-Forms.Label for="slug"><?= lang('Page.form.permalink') ?></x-Forms.Label>
    <permalink-edit class="inline-flex items-center text-xs" edit-label="<?= lang('Common.edit') ?>" copy-label="<?= lang('Common.copy') ?>" copied-label="<?= lang('Common.copied') ?>" permalink-base="<?= base_url('pages') ?>">
        <span slot="domain" class="flex-shrink-0">…/pages/<span>
        <x-Forms.Input name="slug" value="<?= esc($page->slug) ?>" isRequired="true" data-slugify="slug" slot="slug-input" class="flex-1 text-xs" value="<?= esc($page->slug) ?>"/>
    </permalink-edit>
</div>

<x-Forms.Field
    as="MarkdownEditor"
    name="content"
    label="<?= esc(lang('Page.form.content')) ?>"
    value="<?= esc($page->content_markdown) ?>"
    isRequired="true"
    rows="20" />

<x-Button variant="primary" type="submit" class="self-end"><?= lang('Page.form.submit_edit') ?></x-Button>

</form>

<?= $this->endSection() ?>
