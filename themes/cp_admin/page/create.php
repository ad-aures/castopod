<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Page.create') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Page.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open(route_to('page-create'), [
    'class' => 'flex flex-col max-w-3xl',
]) ?>
<form action="<?= route_to('page-create') ?>" method="POST" class="flex flex-col max-w-3xl">
<?= csrf_field() ?>

<Forms.Field
    name="title"
    label="<?= lang('Page.form.title') ?>"
    required="true"
    data-slugify="title" />

<div>
    <Forms.Label for="slug"><?= lang('Page.form.permalink') ?></Forms.Label>
    <permalink-edit class="inline-flex items-center text-xs" edit-label="<?= lang('Common.edit') ?>" copy-label="<?= lang('Common.copy') ?>" copied-label="<?= lang('Common.copied') ?>">
        <span slot="domain"><?= base_url('pages') . '/' ?></span>
        <Forms.Input name="slug" value="<?= $episode->slug ?>" required="true" data-slugify="slug" slot="slug-input" class="flex-1 text-xs" />
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
