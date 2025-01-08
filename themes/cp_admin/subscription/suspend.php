<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Subscription.suspend') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Subscription.suspend') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('subscription-suspend', $podcast->id, $subscription->id) ?>" method="POST" class="flex flex-col w-full max-w-xl mx-auto">
<?= csrf_field() ?>

<Alert variant="warning" class="font-semibold"><?= lang('Subscription.suspend_form.disclaimer', [
    'email' => $subscription->email,
]) ?></Alert>

<Forms.Field
    as="Textarea"
    name="reason"
    label="<?= esc(lang('Subscription.suspend_form.reason')) ?>"
    placeholder="<?= lang('Subscription.suspend_form.reason_placeholder') ?>"
    rows="4"
    class="mt-4"
/>

<div class="flex items-center self-end mt-4 gap-x-2">
    <Button uri="<?= route_to('subscription-list', $podcast->id) ?>"><?= lang('Common.cancel') ?></Button>
    <?php // @icon("pause-fill")?>
    <Button type="submit" variant="warning" iconLeft="pause-fill"><?= lang('Subscription.suspend_form.submit') ?></Button>
</div>

</form>

<?= $this->endSection() ?>
