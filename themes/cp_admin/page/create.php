<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Page.create') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Page.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('page-create') ?>" method="POST" class="flex flex-col max-w-3xl gap-y-4">
<?= csrf_field() ?>

<Forms.Field
    name="title"
    label="<?= lang('Page.form.title') ?>"
    required="true"
    data-slugify="title"
    class="max-w-sm" />

<div class="flex flex-col max-w-sm">
    <Forms.Label for="slug"><?= lang('Page.form.permalink') ?></Forms.Label>
    <permalink-edit class="inline-flex items-center text-xs" edit-label="<?= lang('Common.edit') ?>" copy-label="<?= lang('Common.copy') ?>" copied-label="<?= lang('Common.copied') ?>">
        <span slot="domain" class="flex-shrink-0"><?= base_url('pages') . '/' ?></span>
        <Forms.Input name="slug" required="true" data-slugify="slug" slot="slug-input" class="flex-1 text-xs" />
    </permalink-edit>
</div>

<Forms.Field
    as="MarkdownEditor"
    name="content"
    label="<?= lang('Page.form.content') ?>"
    required="true"
    rows="20" />

<Button variant="primary" type="submit" class="self-end"><?= lang('Page.form.submit_create') ?></Button>

</form>

<?= $this->endSection() ?>
