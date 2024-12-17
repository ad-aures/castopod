<?= helper('form') ?>
<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('pageTitle') ?>
	<?= lang('Auth.set_password') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= url_to('magic-link-set-password') ?>" method="POST" class="flex flex-col w-full gap-y-4">
<?= csrf_field() ?>

<x-Forms.Field
    name="new_password"
    label="<?= esc(lang('Auth.password')) ?>"
    type="password"
    isRequired="true"
    inputmode="text"
    autocomplete="new-password" />

<x-Button variant="primary" type="submit" class="self-end"><?= lang('Auth.set_password') ?></x-Button>

</form>

<?= $this->endSection() ?>
