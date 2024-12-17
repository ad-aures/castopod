<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('MyAccount.changePassword') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('change-password') ?>" method="POST" class="flex flex-col max-w-sm gap-y-4">
    <?= csrf_field() ?>
    <x-Forms.Field
        name="password"
        label="<?= esc(lang('User.form.password')) ?>"
        isRequired="true"
        type="password" />
    <x-Forms.Field
        name="new_password"
        label="<?= esc(lang('User.form.new_password')) ?>"
        isRequired="true"
        type="password"
        autocomplete="new-password" />
    <x-Button variant="primary" class="self-end" type="submit"><?= lang('User.form.submit_password_change') ?></x-Button>
</form>

<?= $this->endSection() ?>
