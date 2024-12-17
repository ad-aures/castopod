<?= helper('form') ?>
<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('pageTitle') ?><?= lang('Auth.email2FATitle') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= url_to('auth-action-handle') ?>" method="POST" class="flex flex-col w-full gap-y-4">
    <?= csrf_field() ?>

    <x-Forms.Field
        name="email"
        label="<?= esc(lang('Auth.email')) ?>"
        helper="<?= esc(lang('Auth.confirmEmailAddress')) ?>"
        isRequired="true"
        type="email"
        inputmode="email"
        autocomplete="email"
        value="<?= $user->email ?>"
    />

    <x-Button variant="primary" type="submit" class="self-end"><?= lang('Auth.send') ?></x-Button>
</form>


<?= $this->endSection() ?>
