<?= $this->extend('Modules\Admin\Views\_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.edit_role', [$user->username]) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Contributor.edit_role', [$user->username]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open(route_to('contributor-edit', $podcast->id, $user->id), [
    'class' => 'flex flex-col max-w-sm',
]) ?>
<?= csrf_field() ?>

<?= component('Forms/Label', ['text' => lang('Contributor.form.role')], ['for' => 'role']) ?>
<?= form_dropdown('role', $roleOptions, [old('role', $contributorGroupId)], [
    'id' => 'role',
    'class' => 'form-select mb-4',
    'required' => 'required',
]) ?>

<?= button(
    lang('Contributor.form.submit_edit'),
    '',
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
