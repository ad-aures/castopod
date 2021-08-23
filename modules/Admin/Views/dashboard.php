<?= helper('components') ?>
<?= $this->extend('Modules\Admin\Views\_layout') ?>

<?= $this->section('title') ?>
<?= lang('Admin.dashboard') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Admin.dashboard') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= lang('Admin.welcome_message') ?>
<?= $this->endsection() ?>
