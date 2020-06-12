<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<h1 class="text-2xl font-semibold"><?= $episode->title ?></h1>
<img src="<?= media_url(
    $episode->image ? $episode->image : $podcast->image
) ?>" alt="Episode cover"  class="object-cover w-40 h-40 mb-6" />
<audio controls>
  <source src="<?= media_url(
      $episode->enclosure_url
  ) ?>" type="<?= $episode->enclosure_type ?>">
  Your browser does not support the audio tag.
</audio>

<?= $this->endSection() ?>
