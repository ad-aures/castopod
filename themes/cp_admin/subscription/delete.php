<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Subscription.delete') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('subscription-delete', $podcast->id, $subscription->id) ?>" method="POST" class="flex flex-col w-full max-w-xl mx-auto">
<?= csrf_field() ?>

<x-Alert variant="danger" class="font-semibold"><?= lang('Subscription.delete_form.disclaimer', [
    'subscriber' => $subscription->email,
]) ?></x-Alert>

<x-Forms.Checkbox class="mt-2" name="understand" isRequired="true"><?= lang('Subscription.delete_form.understand') ?></x-Forms.Checkbox>

<div class="flex items-center self-end mt-4 gap-x-2">
    <x-Button uri="<?= route_to('subscription-list', $podcast->id) ?>"><?= lang('Common.cancel') ?></x-Button>
    <x-Button type="submit" variant="danger"><?= lang('Subscription.delete_form.submit') ?></x-Button>
</div>

</form>

<?= $this->endSection() ?>
