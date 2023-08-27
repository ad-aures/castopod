<?php declare(strict_types=1);

use Modules\Auth\Config\Auth;

?>
<?= helper('form') ?>
<?= $this->extend(config(Auth::class)->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.emailActivateTitle') ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<p><?= lang('Auth.emailActivateBody') ?></p>

<form action="<?= site_url('auth/a/verify') ?>" method="POST" class="flex flex-col w-full gap-y-4">
    <?= csrf_field() ?>

    <!-- Code -->
    <Forms.Field
        name="token"
        label="<?= lang('Auth.token') ?>"
        required="true"
        inputmode="numeric"
        pattern="[0-9]*"
        autocomplete="one-time-code"
        autofocus="autofocus"
        placeholder="000000"
    />

    <Button variant="primary" type="submit" class="self-end"><?= lang('Auth.send') ?></Button>
</form>

<?= $this->endSection() ?>
