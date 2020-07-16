<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.all_podcasts') ?> (<?= count($all_podcasts) ?>)
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<a class="inline-block px-4 py-2 mb-2 border hover:bg-gray-100" href="<?= route_to(
    'podcast_create'
) ?>"><?= lang('Podcast.create') ?></a>
<div class="flex flex-wrap">
    <?php if ($all_podcasts): ?>
        <?php foreach ($all_podcasts as $podcast): ?>
            <article class="w-48 h-full p-2 mb-4 mr-4 border shadow-sm hover:bg-gray-100 hover:shadow">
                <img alt="<?= $podcast->title ?>" src="<?= $podcast->image_url ?>" class="object-cover w-full h-40 mb-2" />
                <a href="<?= route_to(
                    'episode_list',
                    $podcast->id
                ) ?>" class="hover:underline">
                    <h2 class="font-semibold leading-tight"><?= $podcast->title ?></h2>
                </a>
                <p class="mb-4 text-gray-600">@<?= $podcast->name ?></p>
                <a class="inline-flex px-2 py-1 mb-2 text-white bg-teal-700 hover:bg-teal-800" href="<?= route_to(
                    'podcast_edit',
                    $podcast->id
                ) ?>"><?= lang('Podcast.edit') ?></a>
                <a class="inline-flex px-2 py-1 mb-2 text-white bg-indigo-700 hover:bg-indigo-800" href="<?= route_to(
                    'episode_list',
                    $podcast->id
                ) ?>"><?= lang('Podcast.see_episodes') ?></a>
                <a class="inline-flex px-2 py-1 mb-2 text-white bg-yellow-700 hover:bg-yellow-800" href="<?= route_to(
                    'contributor_list',
                    $podcast->id
                ) ?>"><?= lang('Podcast.see_contributors') ?></a>
                <a class="inline-flex px-2 py-1 text-white bg-gray-700 hover:bg-gray-800" href="<?= route_to(
                    'podcast',
                    $podcast->name
                ) ?>"><?= lang('Podcast.goto_page') ?></a>
                <a class="inline-flex px-2 py-1 text-white bg-red-700 hover:bg-red-800" href="<?= route_to(
                    'podcast_delete',
                    $podcast->id
                ) ?>"><?= lang('Podcast.delete') ?></a>

            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="italic"><?= lang('Podcast.no_podcast') ?></p>
    <?php endif; ?>
</div>

<?= $this->endSection()
?>
