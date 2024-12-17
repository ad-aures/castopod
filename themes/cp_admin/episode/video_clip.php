<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('VideoClip.title', [
    'videoClipLabel' => esc($videoClip->title),
]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if ($videoClip->media): ?>
    <video controls class="bg-black h-80 aspect-video">
    <source src="<?= $videoClip->media->file_url ?>" type="<?= $videoClip->media->file_mimetype ?>">
        Your browser does not support the video tag.
    </video>
<?php endif; ?>

<?php if ($videoClip->logs): ?>
<details class="w-full mt-8 overflow-hidden text-white bg-black border rounded shadow-sm">
    <summary class="px-4 py-2 font-semibold text-black bg-white"><?= lang('VideoClip.logs') ?></summary>
    <pre class="p-4 text-sm whitespace-pre-wrap"><?= $videoClip->logs ?></pre>
</details>
<?php endif; ?>

<?= $this->endSection() ?>
