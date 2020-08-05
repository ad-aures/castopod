<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= $episode->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<img src="<?= $episode->image_url ?>" alt="Episode cover"  class="object-cover w-40 h-40 mb-6" />
<audio controls preload="none" class="mb-12">
  <source src="<?= $episode->enclosure_url ?>" type="<?= $episode->enclosure_type ?>">
  Your browser does not support the audio tag.
</audio>

<a class="inline-flex px-4 py-2 text-white bg-teal-700 hover:bg-teal-800" href="<?= route_to(
    'episode_edit',
    $episode->podcast->id,
    $episode->id
) ?>"><?= lang('Episode.edit') ?></a>
    <a href="<?= route_to(
        'episode',
        $episode->podcast->name,
        $episode->slug
    ) ?>" class="inline-flex px-4 py-2 text-white bg-gray-700 hover:bg-gray-800"><?= lang(
    'Episode.go_to_page'
) ?></a>
    <a href="<?= route_to(
        'episode_delete',
        $episode->podcast->id,
        $episode->id
    ) ?>" class="inline-flex px-4 py-2 text-white bg-red-700 hover:bg-red-800"><?= lang(
    'Episode.delete'
) ?></a>

<section class="prose">
<?= $episode->description_html ?>
</section>

<?= $this->endSection() ?>
