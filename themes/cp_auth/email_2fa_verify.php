<?php declare(strict_types=1);

?>
<?= helper('form') ?>
<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.emailEnterCode') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= url_to('auth-action-verify') ?>" method="POST" class="flex flex-col w-full gap-y-4">
    <?= csrf_field() ?>

    <Forms.Field
        name="token"
        label="<?= esc(lang('Auth.code')) ?>"
        helper="<?= esc(lang('Auth.emailConfirmCode')) ?>"
        pattern="[0-9]*"
        placeholder="000000"
        required="true"
        type="number"
        inputmode="numeric"
        autocomplete="one-time-code"
    />

    <Button variant="primary" type="submit" class="self-end"><?= lang('Auth.confirm') ?></Button>
</form>

<?= $this->endSection() ?>
