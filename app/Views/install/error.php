<?= $this->extend('install/_layout') ?>

<?= $this->section('content') ?>

<div class="px-4 py-2 mb-4 font-semibold text-red-900 bg-red-200 border border-red-700">
    <?= lang('Install.messages.error', ['message' => $error]) ?>
</div>

<?= $this->endSection() ?>
