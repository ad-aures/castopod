<?= helper('form') ?>
<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?>
	<?= lang('Auth.set_password') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= url_to('magic-link-set-password') ?>" method="POST" class="flex flex-col w-full gap-y-4">
<?= csrf_field() ?>

<Forms.Field
    name="new_password"
    label="<?= lang('Auth.password') ?>"
    type="password"
    required="true"
    inputmode="text"
    autocomplete="new-password" />

<Button variant="primary" type="submit" class="self-end"><?= lang('Auth.set_password') ?></Button>

</form>

<?= $this->endSection() ?>
