<?php declare(strict_types=1);

use Modules\Auth\Config\Auth;

?>
<?= helper('form') ?>
<?= $this->extend(config(Auth::class)->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?><?= $this->endSection() ?>


<?= $this->section('content') ?>

<form actions="<?= url_to('login') ?>" method="POST" class="flex flex-col w-full gap-y-4">
    <?= csrf_field() ?>

    <Forms.Field
        name="email"
        label="<?= esc(lang('Auth.email')) ?>"
        required="true"
        type="email"
        inputmode="email"
        autocomplete="username"
        autofocus="autofocus"
    />

    <Forms.Field
        name="password"
        label="<?= esc(lang('Auth.password')) ?>"
        type="password"
        inputmode="text"
        autocomplete="current-password"
        required="true" />

    <!-- Remember me -->
    <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
        <Forms.Toggler name="remember" value="yes" checked="<?= old('remember') ?>" size="small"><?= lang('Auth.rememberMe') ?></Forms.Toggler>
    <?php endif; ?>

    <Button variant="primary" type="submit" class="self-end"><?= lang('Auth.login') ?></Button>
</form>

<?= $this->endSection() ?>


<?= $this->section('footer') ?>

<div class="flex flex-col items-center py-4 text-sm text-center">
    <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
            <p class="text-center"><?= lang('Auth.forgotPassword') ?> <a class="underline hover:no-underline" href="<?= url_to('magic-link') ?>"><?= lang('Auth.useMagicLink') ?></a></p>
    <?php endif ?>
    <?php if (setting('Auth.allowRegistration')) : ?>
        <p class="text-center"><?= lang('Auth.needAccount') ?> <a class="underline hover:no-underline" href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a></p>
    <?php endif ?>
</div>

<?= $this->endSection() ?>
