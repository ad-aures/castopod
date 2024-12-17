<?= $this->extend('../cp_admin/_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Subscription.edit', [esc($podcast->title)]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form method="POST" action="<?= route_to('subscription-edit', $podcast->id, $subscription->id) ?>" class="flex flex-col max-w-sm gap-y-4">
<?= csrf_field() ?>
<input type="hidden" name="client_timezone" value="UTC" />

<div class="px-4 py-5 bg-base sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium leading-5 text-skin-muted">
    <?= lang('Subscription.list.email') ?>
    </dt>
    <dd class="mt-1 text-sm leading-5 sm:mt-0 sm:col-span-2">
    <?= esc($subscription->email) ?>
    </dd>
</div>

<x-Forms.Field
    as="DatetimePicker"
    name="expiration_date"
    label="<?= esc(lang('Subscription.form.expiration_date')) ?>"
    hint="<?= esc(lang('Subscription.form.expiration_date_hint')) ?>"
    value="<?= $subscription->expires_at ?>"
/>

<x-Button type="submit" class="self-end" variant="primary"><?= lang('Subscription.form.submit_edit') ?></x-Button>

</form>

<?= $this->endSection() ?>
