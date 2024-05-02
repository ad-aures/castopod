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
    'action'  => route_to('plugins-episode-settings-action', $podcast->id, $episode->id, $plugin->getKey()),
    'type'    => 'episode',
    'context' => ['episode', $episode->id],
]) ?>
<?= $this->endSection() ?>
