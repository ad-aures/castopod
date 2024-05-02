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
    'action'  => route_to('plugins-podcast-settings-action', $podcast->id, $plugin->getKey()),
    'type'    => 'podcast',
    'context' => ['podcast', $podcast->id],
]) ?>
<?= $this->endSection() ?>
