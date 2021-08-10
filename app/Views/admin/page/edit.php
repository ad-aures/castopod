<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Page.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Page.edit') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open(route_to('page-edit', $page->id), [
    'class' => 'flex flex-col max-w-3xl',
]) ?>
<?= csrf_field() ?>

<?= form_label(lang('Page.form.title'), 'title', ['class' => 'max-w-sm']) ?>
<?= form_input([
    'id' => 'title',
    'name' => 'title',
    'class' => 'form-input mb-4 max-w-sm',
    'value' => old('title', $page->title),
    'required' => 'required',
    'data-slugify' => 'title',
    'slot' => 'slug-input',
]) ?>

<?= form_label(
    lang('Page.form.permalink'),
    'slug',
    [],
) ?>
<permalink-edit class="inline-flex items-center max-w-sm mb-4 text-xs" edit-label="<?= lang('Common.edit') ?>" copy-label="<?= lang('Common.copy') ?>" copied-label="<?= lang('Common.copied') ?>">
<span slot="domain" class="flex-shrink-0"><?= base_url('pages') . '/' ?></span>
<?= form_input([
    'id' => 'slug',
    'name' => 'slug',
    'class' => 'form-input flex-1 w-0 text-xs',
    'value' => old('slug', $page->slug),
    'required' => 'required',
    'data-slugify' => 'slug',
]) ?>
</permalink-edit>

<div class="mb-4">
    <?= form_label(lang('Page.form.content'), 'content') ?>
    <?= form_markdown_editor(
        [
            'id' => 'content',
            'name' => 'content',
            'required' => 'required',
        ],
        old('content', $page->content_markdown, false),
    ) ?>
</div>

<?= button(
    lang('Page.form.submit_edit'),
    '',
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
