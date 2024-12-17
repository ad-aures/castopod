<?= helper('form') ?>
<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('pageTitle') ?><?= lang('Auth.login') ?><?= $this->endSection() ?>


<?= $this->section('content') ?>

<form actions="<?= url_to('login') ?>" method="POST" class="flex flex-col w-full gap-y-4">
    <?= csrf_field() ?>

    <x-Forms.Field
        name="email"
        label="<?= esc(lang('Auth.email')) ?>"
        isRequired="true"
        type="email"
        inputmode="email"
        autocomplete="username"
        autofocus="autofocus"
    />

    <x-Forms.Field
        name="password"
        label="<?= esc(lang('Auth.password')) ?>"
        type="password"
        inputmode="text"
        autocomplete="current-password"
        isRequired="true" />

    <!-- Remember me -->
    <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
        <x-Forms.Checkbox name="remember" isChecked="<?= old('remember') ?>" size="small"><?= lang('Auth.rememberMe') ?></x-Forms.Checkbox>
    <?php endif; ?>

    <x-Button variant="primary" type="submit" class="self-end"><?= lang('Auth.login') ?></x-Button>
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
