<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Plugins.view') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Plugins.view') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="prose">

    <?= $plugin->getReadmeHTML() ?>
</section>
<?= $this->endSection() ?>