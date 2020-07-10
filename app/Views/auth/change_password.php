<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
	<?= lang('Auth.resetYourPassword') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to(
    'change-password'
) ?>" method="post" class="flex flex-col">
    <?= csrf_field() ?>

    <input type="hidden" name="token" value="<?= $token ?>">
    <input type="hidden" name="email" value="<?= $email ?>">

    <label for="password"><?= lang('Auth.newPassword') ?></label>
    <input type="password" class="mb-4 form-input" name="password">

    <label for="pass_confirm"><?= lang('Auth.newPasswordRepeat') ?></label>
    <input type="password" class="mb-6 form-input" name="pass_confirm">

    <button type="submit" class="px-4 py-2 ml-auto border">
        <?= lang('Auth.resetPassword') ?>
    </button>
</form>

<?= $this->endSection() ?>
