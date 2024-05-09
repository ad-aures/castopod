<?php declare(strict_types=1);

?>
<?= helper('form') ?>
<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.useMagicLink') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<form actions="<?= url_to('magic-link') ?>" method="POST" class="flex flex-col w-full gap-y-4">
    <?= csrf_field() ?>

    <x-Forms.Field
        name="email"
        label="<?= esc(lang('Auth.email')) ?>"
        isRequired="true"
        inputmode="email"
        autocomplete="email"
        autofocus="autofocus"
        value="<?= old('email', auth()->user()->email ?? null) ?>"
    />

    <x-Button variant="primary" type="submit" class="self-end"><?= lang('Auth.send') ?></x-Button>
</form>

<?= $this->endSection() ?>
