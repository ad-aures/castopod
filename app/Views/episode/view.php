<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<a class="underline hover:no-underline" href="<?= route_to(
    'podcast_view',
    $podcast->name
) ?>">< <?= lang('Episode.back_to_podcast') ?></a>
<h1 class="text-2xl font-semibold"><?= $episode->title ?></h1>
<img src="<?= $episode->image_url ?>" alt="Episode cover"  class="object-cover w-40 h-40 mb-6" />
<audio controls preload="none" class="mb-12">
  <source src="<?= $episode->enclosure_url ?>" type="<?= $episode->enclosure_type ?>">
  Your browser does not support the audio tag.
</audio>

<a class="inline-flex px-4 py-2 text-white bg-teal-700 hover:bg-teal-800" href="<?= route_to(
    'episode_edit',
    $podcast->name,
    $episode->slug
) ?>"><?= lang('Episode.edit') ?></a>
<a href="<?= route_to(
    'episode_delete',
    $podcast->name,
    $episode->slug
) ?>" class="inline-flex px-4 py-2 text-white bg-red-700 hover:bg-red-800"><?= lang(
    'Episode.delete'
) ?></a>


<?= $this->endSection() ?>
