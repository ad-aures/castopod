<?= $this->extend('_layout') ?>

<?= $this->section('content') ?>

<a class="underline hover:no-underline" href="<?= route_to(
    'podcast',
    $podcast->name
) ?>">< <?= lang('Episode.back_to_podcast') ?></a>
<h1 class="text-2xl font-semibold"><?= $episode->title ?></h1>
<img src="<?= $episode->image_url ?>" alt="Episode cover"  class="object-cover w-40 h-40 mb-6" />
<audio controls preload="none" class="mb-12">
  <source src="<?= $episode->enclosure_url ?>" type="<?= $episode->enclosure_type ?>">
  Your browser does not support the audio tag.
</audio>

<?= $this->endSection()
?>
