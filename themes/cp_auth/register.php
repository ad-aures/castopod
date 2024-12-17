<?= helper('form') ?>
<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('pageTitle') ?>
	<?= lang('Auth.register') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= url_to('register') ?>" method="POST" class="flex flex-col w-full gap-y-4">
<?= csrf_field() ?>

<x-Forms.Field
    name="username"
    label="<?= esc(lang('Auth.username')) ?>"
    autocomplete="username"
    inputmode="text"
    isRequired="true" />

<x-Forms.Field
    name="email"
    label="<?= esc(lang('Auth.email')) ?>"
    type="email"
    inputmode="email"
    autocomplete="email"
    isRequired="true" />

<x-Forms.Field
    name="password"
    label="<?= esc(lang('Auth.password')) ?>"
    type="password"
    isRequired="true"
    inputmode="text"
    autocomplete="new-password" />

<x-Forms.Field
    name="password_confirm"
    label="<?= esc(lang('Auth.passwordConfirm')) ?>"
    type="password"
    isRequired="true"
    inputmode="text"
    autocomplete="new-password" />

<x-Button variant="primary" type="submit" class="self-end"><?= lang('Auth.register') ?></x-Button>

</form>

<?= $this->endSection() ?>


<?= $this->section('footer') ?>

<p class="py-4 text-sm text-center">
    <?= lang(
        'Auth.haveAccount',
    ) ?> <a class="underline hover:no-underline" href="<?= route_to(
        'login',
    ) ?>"><?= lang('Auth.login') ?></a>
</p>

<?= $this->endSection() ?>
