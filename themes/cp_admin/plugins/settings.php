<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Plugins.settingsTitle', [
    'pluginTitle' => $plugin->getTitle(),
    'type'        => $type,
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
<?= view('plugins/_settings_form', [
    'plugin'  => $plugin,
    'action'  => route_to(sprintf('plugins-settings-%s-action', $type), ...$params),
    'fields'  => $fields,
    'type'    => $type,
    'context' => $context,
]) ?>
<?= $this->endSection() ?>
