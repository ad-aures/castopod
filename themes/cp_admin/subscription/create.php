<?= $this->extend('../cp_admin/_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Subscription.add', [esc($podcast->title)]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form method="POST" action="<?= route_to('subscription-create', $podcast->id) ?>" class="flex flex-col max-w-sm gap-y-4">
<?= csrf_field() ?>
<input type="hidden" name="client_timezone" value="UTC" />

<x-Forms.Field
    name="email"
    type="email"
    label="<?= esc(lang('Subscription.form.email')) ?>"
    isRequired="true" />

<x-Forms.Field
    as="DatetimePicker"
    name="expiration_date"
    label="<?= esc(lang('Subscription.form.expiration_date')) ?>"
    hint="<?= esc(lang('Subscription.form.expiration_date_hint')) ?>"
/>

<x-Button type="submit" class="self-end" variant="primary"><?= lang('Subscription.form.submit_create') ?></x-Button>

</form>

<?= $this->endSection() ?>
