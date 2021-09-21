<?= helper('form') ?>
<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
	<?= lang('Auth.forgotPassword') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<p class="mb-4 text-gray-600"><?= lang('Auth.enterEmailForInstructions') ?></p>

<form action="<?= route_to('forgot') ?>" method="POST" class="flex flex-col w-full gap-y-4">
    <?= csrf_field() ?>

    <Forms.Field
        name="email"
        label="<?= lang('Auth.emailAddress') ?>"
        type="email"
        required="true" />
    <Button variant="primary" type="submit" class="self-end"><?= lang('Auth.sendInstructions') ?></Button>
</form>

<?= $this->endSection() ?>
