<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Plugins.settings', [
    'pluginName' => $plugin->getName(),
]) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Plugins.settings', [
    'pluginName' => $plugin->getName(),
]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= view('plugins/_settings', [
    'plugin'  => $plugin,
    'action'  => route_to('plugins-general-settings-action', $plugin->getKey()),
    'type'    => 'general',
    'context' => null,
]) ?>
<?= $this->endSection() ?>
