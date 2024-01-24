<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('MyAccount.changePassword') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('MyAccount.changePassword') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('change-password') ?>" method="POST" class="flex flex-col max-w-sm gap-y-4">
    <?= csrf_field() ?>
    <Forms.Field
        name="password"
        label="<?= esc(lang('User.form.password')) ?>"
        required="true"
        type="password" />
    <Forms.Field
        name="new_password"
        label="<?= esc(lang('User.form.new_password')) ?>"
        required="true"
        type="password"
        autocomplete="new-password" />
    <Button variant="primary" class="self-end" type="submit"><?= lang('User.form.submit_password_change') ?></Button>
</form>

<?= $this->endSection() ?>
