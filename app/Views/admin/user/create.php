<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to(
    'user_create'
) ?>" method="post" class="flex flex-col max-w-lg">
    <?= csrf_field() ?>

    <label for="email"><?= lang('User.form.email') ?></label>
    <input type="email" class="mb-4 form-input" name="email" id="email" value="<?= old(
        'email'
    ) ?>">

    <label for="username"><?= lang('User.form.username') ?></label>
    <input type="text" class="mb-4 form-input" name="username" id="username" value="<?= old(
        'username'
    ) ?>">

    <label for="password"><?= lang('User.form.password') ?></label>
    <input type="password" name="password" class="mb-4 form-input" id="password" autocomplete="off">

    <label for="pass_confirm"><?= lang('User.form.repeat_password') ?></label>
    <input type="password" name="pass_confirm" class="mb-6 form-input" id="pass_confirm" autocomplete="off">

    <button type="submit" class="px-4 py-2 ml-auto border">
        <?= lang('User.form.submit_create') ?>
    </button>
</form>

<?= $this->endSection()
?>
