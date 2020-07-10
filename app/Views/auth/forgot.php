<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
	<?= lang('Auth.forgotPassword') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<p class="mb-4"><?= lang('Auth.enterEmailForInstructions') ?></p>

<form action="<?= route_to('forgot') ?>" method="post" class="flex flex-col">
    <?= csrf_field() ?>

    <label for="email"><?= lang('Auth.emailAddress') ?></label>
    <input type="email" class="mb-6 form-input" name="email" placeholder="<?= lang(
        'Auth.email'
    ) ?>">

    <button type="submit" class="px-4 py-2 ml-auto border">
        <?= lang('Auth.sendInstructions') ?>
    </button>
</form>

<?= $this->endSection() ?>
