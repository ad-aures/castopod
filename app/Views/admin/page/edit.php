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
]) ?>

<?= form_label(lang('Page.form.slug'), 'slug', ['class' => 'max-w-sm']) ?>
<?= form_input([
    'id' => 'slug',
    'name' => 'slug',
    'class' => 'form-input mb-4 max-w-sm',
    'value' => old('slug', $page->slug),
    'required' => 'required',
    'data-slugify' => 'slug',
]) ?>

<div class="mb-4">
    <?= form_label(lang('Page.form.content'), 'content') ?>
    <?= form_textarea(
        [
            'id' => 'content',
            'name' => 'content',
            'class' => 'form-textarea',
            'required' => 'required',
        ],
        old('content', $page->content, false),
        'data-editor="markdown"'
    ) ?>
</div>

<?= button(
    lang('Page.form.submit_edit'),
    null,
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end']
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
