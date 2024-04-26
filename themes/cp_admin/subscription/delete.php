<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Subscription.delete') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Subscription.delete') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('subscription-delete', $podcast->id, $subscription->id) ?>" method="POST" class="flex flex-col w-full max-w-xl mx-auto">
<?= csrf_field() ?>

<Alert variant="danger" class="font-semibold"><?= lang('Subscription.delete_form.disclaimer', [
    'subscriber' => $subscription->email,
]) ?></Alert>

<Forms.Checkbox class="mt-2" name="understand" required="true" isChecked="false"><?= lang('Subscription.delete_form.understand') ?></Forms.Checkbox>

<div class="flex items-center self-end mt-4 gap-x-2">
    <Button uri="<?= route_to('subscription-list', $podcast->id) ?>"><?= lang('Common.cancel') ?></Button>
    <Button type="submit" variant="danger"><?= lang('Subscription.delete_form.submit') ?></Button>
</div>

</form>

<?= $this->endSection() ?>
