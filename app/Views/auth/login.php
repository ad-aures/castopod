<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
    <?= lang('Auth.loginTitle') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('login') ?>" method="post" class="flex flex-col">
    <?= csrf_field() ?>

    <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
    <input type="text" name="login" class="mb-4 form-input" placeholder="<?= lang(
        'Auth.emailOrUsername'
    ) ?>">

    <label for="password"><?= lang('Auth.password') ?></label>
    <input type="password" name="password" class="mb-6 form-input" placeholder="<?= lang(
        'Auth.password'
    ) ?>">

    <button type="submit" class="px-4 py-2 ml-auto border">
        <?= lang('Auth.loginAction') ?>
    </button>
</form>

<?= $this->endSection() ?>


<?= $this->section('footer') ?>

<div class="flex flex-col items-center py-4 text-sm text-center">
    <?php if ($config->allowRegistration): ?>
        <a class="underline hover:no-underline" href="<?= route_to(
            'register'
        ) ?>"><?= lang('Auth.needAnAccount') ?></a>
    <?php endif; ?>
    <a class="underline hover:no-underline" href="<?= route_to(
        'forgot'
    ) ?>"><?= lang('Auth.forgotYourPassword') ?></a>
</div>

<?= $this->endSection() ?>
