<?= $this->extend('../cp_admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Subscription.add', [esc($podcast->title)]) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Subscription.add', [esc($podcast->title)]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form method="POST" action="<?= route_to('subscription-add', $podcast->id) ?>" class="flex flex-col max-w-sm gap-y-4">
<?= csrf_field() ?>
<input type="hidden" name="client_timezone" value="UTC" />

<Forms.Field
    name="email"
    type="email"
    label="<?= lang('Subscription.form.email') ?>"
    required="true" />

<Forms.Field
    as="DatetimePicker"
    name="expiration_date"
    label="<?= lang('Subscription.form.expiration_date') ?>"
    hint="<?= lang('Subscription.form.expiration_date_hint') ?>"
/>

<Button type="submit" class="self-end" variant="primary"><?= lang('Subscription.form.submit_add') ?></Button>

</form>

<?= $this->endSection() ?>
