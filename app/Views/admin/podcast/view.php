<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= $podcast->title ?>
<a class="inline-flex items-center px-2 py-1 mb-2 ml-4 text-sm text-white bg-teal-500 rounded shadow-xs outline-none hover:bg-teal-600 focus:shadow-outline" href="<?= route_to(
    'podcast-edit',
    $podcast->id
) ?>">
<?= icon('edit', 'mr-2') ?>
<?= lang('Podcast.edit') ?>
</a>
<a class="inline-flex items-center px-2 py-1 mb-2 ml-2 text-sm text-white bg-green-500 rounded shadow-xs outline-none hover:bg-green-600 focus:shadow-outline" href="<?= route_to(
    'episode-create',
    $podcast->id
) ?>">
<?= icon('add', 'mr-2') ?>
<?= lang('Episode.create') ?></a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <img class="w-64 mb-4" src="<?= $podcast->image_url ?>" alt="<?= $podcast->title ?>" />
    <a class="inline-flex px-2 py-1 mb-2 text-white bg-yellow-700 hover:bg-yellow-800" href="<?= route_to(
        'contributor-list',
        $podcast->id
    ) ?>"><?= lang('Podcast.see_contributors') ?></a>
    <a class="inline-flex px-2 py-1 mb-2 text-white bg-indigo-700 hover:bg-indigo-800" href="<?= route_to(
        'platforms',
        $podcast->id
    ) ?>"><?= lang('Platforms.title') ?></a>
    <a class="inline-flex px-2 py-1 text-white bg-gray-700 hover:bg-gray-800" href="<?= route_to(
        'podcast',
        $podcast->name
    ) ?>"><?= lang('Podcast.go_to_page') ?></a>
    <a class="inline-flex px-2 py-1 text-white bg-red-700 hover:bg-red-800" href="<?= route_to(
        'podcast-delete',
        $podcast->id
    ) ?>"><?= lang('Podcast.delete') ?></a>

    <?= view('admin/_partials/_episode-list.php', [
        'episodes' => $podcast->episodes,
    ]) ?>
<?= $this->endSection() ?>
