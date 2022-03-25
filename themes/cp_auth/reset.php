<?= helper('form') ?>
<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
    <?= lang('Auth.resetYourPassword') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<p class="mb-4"><?= lang('Auth.enterCodeEmailPassword') ?></p>

<form action="<?= route_to('reset-password') ?>" method="POST" class="flex flex-col w-full">
<?= csrf_field() ?>

<Forms.Field
    name="token"
    label="<?= lang('Auth.token') ?>"
    value="<?= esc($token) ?? '' ?>"
    required="true" />
    
<Forms.Field
    name="email"
    label="<?= lang('Auth.email') ?>"
    type="email"
    required="true" />

<Forms.Field
    name="password"
    label="<?= lang('Auth.newPassword') ?>"
    type="password"
    required="true"
    autocomplete="new-password" />

<Button variant="primary" type="submit" class="self-end"><?= lang('Auth.resetPassword') ?></Button>

</form>

<?= $this->endSection() ?>
