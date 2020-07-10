<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
	<?= lang('Auth.register') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('register') ?>" method="post" class="flex flex-col">
    <?= csrf_field() ?>

    <label for="email"><?= lang('Auth.email') ?></label>
    <input type="email" class="mb-4 form-input" name="email" aria-describedby="emailHelp" placeholder="<?= lang(
        'Auth.email'
    ) ?>" value="<?= old('email') ?>">
    <small id="emailHelp" class="mb-4">
        <?= lang('Auth.weNeverShare') ?>
    </small>

    <label for="username"><?= lang('Auth.username') ?></label>
    <input type="text" class="mb-4 form-input" name="username" placeholder="<?= lang(
        'Auth.username'
    ) ?>" value="<?= old('username') ?>">

    <label for="password"><?= lang('Auth.password') ?></label>
    <input type="password" name="password" class="mb-4 form-input" placeholder="<?= lang(
        'Auth.password'
    ) ?>" autocomplete="off">

    <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
    <input type="password" name="pass_confirm" class="mb-6 form-input" placeholder="<?= lang(
        'Auth.repeatPassword'
    ) ?>" autocomplete="off">

    <button type="submit" class="px-4 py-2 ml-auto border">
        <?= lang('Auth.register') ?>
    </button>
</form>

<?= $this->endSection() ?>


<?= $this->section('footer') ?>

<p class="py-4 text-sm text-center">
    <?= lang(
        'Auth.alreadyRegistered'
    ) ?> <a class="underline hover:no-underline" href="<?= route_to(
     'login'
 ) ?>"><?= lang('Auth.signIn') ?></a>
</p>

<?= $this->endSection() ?>
