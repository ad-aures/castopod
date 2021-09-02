<?= $this->extend('_layout') ?>

<?= $this->section('content') ?>

<h1 class="mb-2 text-xl font-bold font-display"><?= lang(
    'Install.manual_config',
) ?></h1>
<div class="inline-flex items-baseline max-w-2xl px-4 py-2 mb-4 font-semibold text-red-900 bg-red-200 border border-red-700">
<?= icon('alert', 'mr-2 flex-shrink-0') . lang('Install.messages.writeError') ?>
</div>
<p class="mb-4 font-semibold text-gray-600"><?= lang(
    'Install.manual_config_subtitle',
) ?></p>

<?= $this->endSection()
?>
