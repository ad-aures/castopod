<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Plugins.settings', [
    'pluginName' => $plugin->getName(),
    'type'       => $type,
]) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Plugins.settings', [
    'pluginName' => $plugin->getName(),
    'type'       => $type,
]) ?>
<?= $this->endSection() ?>

<?php
    $params = [
        $plugin->getVendor(),
        $plugin->getPackage(),
    ];

if (isset($podcast)) {
    $params[] = $podcast->id;
}

if (isset($episode)) {
    $params[] = $episode->id;
}
?>

<?= $this->section('content') ?>
<?= view('plugins/_settings', [
    'plugin'  => $plugin,
    'action'  => route_to(sprintf('plugins-settings-%s-action', $type), ...$params),
    'type'    => $type,
    'context' => $context,
]) ?>
<?= $this->endSection() ?>
