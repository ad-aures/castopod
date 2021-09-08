<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('MyAccount.info') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('MyAccount.info') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= view('_partials/_user_info.php', [
    'user' => user(),
]) ?>

<?= $this->endSection() ?>
