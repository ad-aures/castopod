<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('User.delete_form.title', [
    'user' => $user->username,
]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('user-delete', $user->id) ?>" method="POST" class="flex flex-col w-full max-w-xl mx-auto">
<?= csrf_field() ?>

<x-Alert variant="danger" class="font-semibold"><?= lang('User.delete_form.disclaimer', [
    'user' => $user->username,
]) ?></x-Alert>

<x-Forms.Checkbox class="mt-2" name="understand" isRequired="true" isChecked="false"><?= lang('User.delete_form.understand', [
    'user' => $user->username,
]) ?></x-Forms.Checkbox>

<div class="self-end mt-4">
    <x-Button uri="<?= route_to('user-view', $user->id) ?>"><?= lang('Common.cancel') ?></x-Button>
    <x-Button type="submit" variant="danger"><?= lang('User.delete_form.submit') ?></x-Button>
</div>

</form>

<?= $this->endSection() ?>
