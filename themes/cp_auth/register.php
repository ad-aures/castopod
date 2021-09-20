<?= helper('form') ?>
<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
	<?= lang('Auth.register') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('register') ?>" method="POST" class="flex flex-col">
<?= csrf_field() ?>

<Forms.Field
    name="email"
    label="<?= lang('Auth.email') ?>"
    helper="<?= lang('Auth.weNeverShare') ?>"
    type="email"
    required="true" />

<Forms.Field
    name="username"
    label="<?= lang('Auth.username') ?>"
    required="true" />

<Forms.Field
    name="password"
    label="<?= lang('Auth.password') ?>"
    required="true"
    autocomplete="new-password" />

<Button variant="primary" type="submit" class="self-end"><?= lang('Auth.register') ?></Button>

</form>

<?= $this->endSection() ?>


<?= $this->section('footer') ?>

<p class="py-4 text-sm text-center">
    <?= lang(
    'Auth.alreadyRegistered',
) ?> <a class="underline hover:no-underline" href="<?= route_to(
    'login',
) ?>"><?= lang('Auth.signIn') ?></a>
</p>

<?= $this->endSection() ?>
