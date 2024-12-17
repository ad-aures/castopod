<?= helper('form') ?>
<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('pageTitle') ?><?= lang('Auth.emailActivateTitle') ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<p><?= lang('Auth.emailActivateBody') ?></p>

<form action="<?= site_url('auth/a/verify') ?>" method="POST" class="flex flex-col w-full gap-y-4">
    <?= csrf_field() ?>

    <!-- Code -->
    <x-Forms.Field
        name="token"
        label="<?= esc(lang('Auth.token')) ?>"
        isRequired="true"
        inputmode="numeric"
        pattern="[0-9]*"
        autocomplete="one-time-code"
        autofocus="autofocus"
        placeholder="000000"
    />

    <x-Button variant="primary" type="submit" class="self-end"><?= lang('Auth.send') ?></x-Button>
</form>

<?= $this->endSection() ?>
