<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('VideoClip.form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('VideoClip.form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex flex-col gap-6">
<div class="flex flex-col items-start">
    <x-Heading class="flex items-center gap-x-2"><?= icon('alert-fill', [
        'class' => 'flex-shrink-0 text-xl text-orange-600',
    ]) ?><?= lang('VideoClip.requirements.title') ?></x-Heading>
    <p class="max-w-sm font-semibold text-gray-500"><?= lang('VideoClip.requirements.missing') ?></p>
    <div class="flex flex-col mt-4">
    <?php foreach ($checks as $requirement => $value): ?>
        <?php if ($value): ?>
            <div class="inline-flex items-center"><?= icon('check-fill', [
                'class' => 'mr-1 text-white rounded-full bg-pine-500',
            ]) ?><?= lang('VideoClip.requirements.' . $requirement) ?></div>
        <?php else: ?>
            <div class="inline-flex items-center"><?= icon('close-fill', [
                'class' => 'mr-1 text-white bg-red-500 rounded-full',
            ]) ?><?= lang('VideoClip.requirements.' . $requirement) ?></div>
        <?php endif; ?>
    <?php endforeach; ?>
    </div>

</div>

<?= $this->endSection() ?>
