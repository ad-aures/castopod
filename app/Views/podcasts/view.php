<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<h1 class="text-xl"><?= $podcast->title ?></h1>
<img src="<?= base_url($podcast->image) ?>" alt="Podcast cover" />

<?= $this->endSection() ?>