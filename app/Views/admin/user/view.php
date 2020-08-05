<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.view', ['username' => $user->username]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= view('admin/_partials/_user_info.php', ['user' => $user]) ?>

<?= $this->endSection() ?>
