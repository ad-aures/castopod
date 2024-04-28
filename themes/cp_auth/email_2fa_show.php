<?php declare(strict_types=1);

?>

<?= helper('form') ?>
<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.email2FATitle') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= url_to('auth-action-handle') ?>" method="POST" class="flex flex-col w-full gap-y-4">
    <?= csrf_field() ?>

    <Forms.Field
        name="email"
        label="<?= esc(lang('Auth.email')) ?>"
        helper="<?= esc(lang('Auth.confirmEmailAddress')) ?>"
        required="true"
        type="email"
        inputmode="email"
        autocomplete="email"
        value="<?= $user->email ?>"
    />

    <Button variant="primary" type="submit" class="self-end"><?= lang('Auth.send') ?></Button>
</form>


<?= $this->endSection() ?>
