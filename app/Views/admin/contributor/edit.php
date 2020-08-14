<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.edit_role', [$user->username]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open(route_to('contributor-edit', $podcast->id, $user->id), [
    'class' => 'flex flex-col max-w-sm',
]) ?>
<?= csrf_field() ?>

<?= form_label(lang('Contributor.form.role'), 'role') ?>
<?= form_dropdown('role', $roleOptions, old('role', $contributorGroupId), [
    'id' => 'role',
    'class' => 'form-select mb-4',
    'required' => 'required',
]) ?>

<?= form_button([
    'content' => lang('Contributor.form.submit_edit'),
    'type' => 'submit',
    'class' => 'self-end px-4 py-2 bg-gray-200',
]) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
