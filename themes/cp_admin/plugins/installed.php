<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Plugins.installed') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Plugins.installed') . ' (' . $total . ')' ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="grid gap-4 mb-4 grid-cols-plugins">
<?php foreach ($plugins as $plugin) {
    echo view('plugins/_plugin', [
        'plugin' => $plugin,
    ]);
} ?>
</div>
<?= $pager_links ?>
<?= $this->endSection() ?>
