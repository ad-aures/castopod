<?= $this->extend('Modules\Admin\Views\_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.view', ['username' => $user->username]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= view('Modules\Admin\Views\_partials/_user_info.php', ['user' => $user]) ?>

<?= $this->endSection() ?>
