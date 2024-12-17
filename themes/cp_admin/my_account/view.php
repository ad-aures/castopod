<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('MyAccount.info') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= view('_partials/_user_info.php', [
    'user' => auth()
        ->user(),
]) ?>

<?= $this->endSection() ?>
