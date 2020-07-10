<?= $this->extend('admin/_layout') ?>

<?= $this->section('content') ?>

<h1 class="mb-6 text-xl"><?= lang('MyAccount.changePassword') ?></h1>

<form action="<?= route_to(
    'myAccount_changePassword'
) ?>" method="post" class="flex flex-col max-w-lg">
    <?= csrf_field() ?>

    <input type="hidden" name="email" value="<?= user()->email ?>">

    <label for="password"><?= lang('User.form.password') ?></label>
    <input type="password" name="password" class="mb-4 form-input" id="password" autocomplete="off">

    <label for="new_password"><?= lang('User.form.new_password') ?></label>
    <input type="password" name="new_password" class="mb-4 form-input" id="new_password" autocomplete="off">

    <label for="pass_confirm"><?= lang(
        'User.form.repeat_new_password'
    ) ?></label>
    <input type="password" name="new_pass_confirm" class="mb-6 form-input" id="new_pass_confirm" autocomplete="off">

    <button type="submit" class="px-4 py-2 ml-auto border">
        <?= lang('User.form.submit_edit') ?>
    </button>
</form>

<?= $this->endSection()
?>
