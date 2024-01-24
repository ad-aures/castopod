<?php declare(strict_types=1);

use Modules\Auth\Config\Auth;

?>
<?= helper('form') ?>
<?= $this->extend(config(Auth::class)->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.useMagicLink') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<form actions="<?= url_to('magic-link') ?>" method="POST" class="flex flex-col w-full gap-y-4">
    <?= csrf_field() ?>

    <Forms.Field
        name="email"
        label="<?= esc(lang('Auth.email')) ?>"
        required="true"
        inputmode="email"
        autocomplete="email"
        autofocus="autofocus"
        value="<?= old('email', auth()->user()->email ?? null) ?>"
    />

    <Button variant="primary" type="submit" class="self-end"><?= lang('Auth.send') ?></Button>
</form>

<?= $this->endSection() ?>
