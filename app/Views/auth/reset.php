<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
    <?= lang('Auth.resetYourPassword') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<p class="mb-4"><?= lang('Auth.enterCodeEmailPassword') ?></p>

<form action="<?= route_to(
    'reset-password'
) ?>" method="post" class="flex flex-col">
    <?= csrf_field() ?>

    <label for="token"><?= lang('Auth.token') ?></label>
    <input type="text" class="mb-4 form-input" name="token" placeholder="<?= lang(
        'Auth.token'
    ) ?>" value="<?= old('token', $token ?? '') ?>">

    <label for="email"><?= lang('Auth.email') ?></label>
    <input type="email" class="mb-4 form-input" name="email" placeholder="<?= lang(
        'Auth.email'
    ) ?>" value="<?= old('email') ?>">

    <label for="password"><?= lang('Auth.newPassword') ?></label>
    <input type="password" class="mb-4 form-input" name="password">

    <label for="pass_confirm"><?= lang('Auth.newPasswordRepeat') ?></label>
    <input type="password" class="mb-6 form-input" name="pass_confirm">

    <button type="submit" class="px-4 py-2 ml-auto border">
        <?= lang('Auth.resetPassword') ?>
    </button>
</form>

<?= $this->endSection() ?>
