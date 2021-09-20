<?= helper('form') ?>
<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
    <?= lang('Auth.loginTitle') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form actions="<?= route_to('login') ?>" method="POST" class="flex flex-col">
    <?= csrf_field() ?>

    <Forms.Field
        name="login"
        label="<?= lang('Auth.emailOrUsername') ?>"
        required="true" />

    <Forms.Field
        name="password"
        label="<?= lang('Auth.password') ?>"
        type="password"
        required="true" />

    <Button variant="primary" type="submit" class="self-end"><?= lang('Auth.loginAction') ?></Button>
</form>

<?= $this->endSection() ?>


<?= $this->section('footer') ?>

<div class="flex flex-col items-center py-4 text-sm text-center">
    <?php if ($config->allowRegistration): ?>
        <a class="underline hover:no-underline" href="<?= route_to(
    'register',
) ?>"><?= lang('Auth.needAnAccount') ?></a>
    <?php endif; ?>
    <a class="underline hover:no-underline" href="<?= route_to(
    'forgot',
) ?>"><?= lang('Auth.forgotYourPassword') ?></a>
</div>

<?= $this->endSection() ?>
