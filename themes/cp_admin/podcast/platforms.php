<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang("Platforms.title.{$platformType}") ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<x-Button form="platforms-form" variant="primary" type="submit" class="self-end"><?= lang('Platforms.submit') ?></x-Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form id="platforms-form" action="<?= route_to('platforms-save', $podcast->id, $platformType) ?>" method="POST" class="grid w-full gap-4 lg:gap-8 grid-cols-platforms">
<?= csrf_field() ?>


<?php foreach ($platforms as $platform) {
    echo view('podcast/_platform', [
        'platform' => $platform,
    ]);
} ?>

</form>

<?= $this->endSection() ?>
