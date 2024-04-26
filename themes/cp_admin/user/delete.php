<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.delete_form.title', [
    'user' => $user->username,
]) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('User.delete_form.title', [
    'user' => $user->username,
]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('user-delete', $user->id) ?>" method="POST" class="flex flex-col w-full max-w-xl mx-auto">
<?= csrf_field() ?>

<Alert variant="danger" class="font-semibold"><?= lang('User.delete_form.disclaimer', [
    'user' => $user->username,
]) ?></Alert>

<Forms.Checkbox class="mt-2" name="understand" required="true" isChecked="false"><?= lang('User.delete_form.understand', [
    'user' => $user->username,
]) ?></Forms.Checkbox>

<div class="self-end mt-4">
    <Button uri="<?= route_to('user-view', $user->id) ?>"><?= lang('Common.cancel') ?></Button>
    <Button type="submit" variant="danger"><?= lang('User.delete_form.submit') ?></Button>
</div>

</form>

<?= $this->endSection() ?>
