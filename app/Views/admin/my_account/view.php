<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('MyAccount.info') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('MyAccount.info') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= view('admin/_partials/_user_info.php', ['user' => user()]) ?>

<?= $this->endSection()
?>
