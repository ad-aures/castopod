<?= $this->extend('admin/_layout') ?>

<?= $this->section('content') ?>

<h1 class="mb-2 text-xl"><?= lang('Podcast.all_podcasts') ?> (<?= count(
     $all_podcasts
 ) ?>)</h1>
<div class="flex flex-wrap">
    <?php if ($all_podcasts): ?>
        <?php foreach ($all_podcasts as $podcast): ?>
            <article class="w-48 h-full p-2 mb-4 mr-4 border shadow-sm hover:bg-gray-100 hover:shadow">
                <img alt="<?= $podcast->title ?>" src="<?= $podcast->image_url ?>" class="object-cover w-full h-40 mb-2" />
                <a href="<?= route_to(
                    'episode_list',
                    $podcast->name
                ) ?>" class="hover:underline">
                    <h2 class="font-semibold leading-tight"><?= $podcast->title ?></h2>
                </a>
                <p class="mb-4 text-gray-600">@<?= $podcast->name ?></p>
                <a class="inline-flex px-2 py-1 mb-2 text-white bg-teal-700 hover:bg-teal-800" href="<?= route_to(
                    'podcast_edit',
                    $podcast->name
                ) ?>"><?= lang('Podcast.edit') ?></a>
                <a class="inline-flex px-2 py-1 mb-2 text-white bg-indigo-700 hover:bg-indigo-800" href="<?= route_to(
                    'episode_list',
                    $podcast->name
                ) ?>"><?= lang('Podcast.see_episodes') ?></a>
                <a class="inline-flex px-2 py-1 text-white bg-gray-700 hover:bg-gray-800" href="<?= route_to(
                    'podcast',
                    $podcast->name
                ) ?>"><?= lang('Podcast.goto_page') ?></a>
                <a class="inline-flex px-2 py-1 text-white bg-red-700 hover:bg-red-800" href="<?= route_to(
                    'podcast_delete',
                    $podcast->name
                ) ?>"><?= lang('Podcast.delete') ?></a>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="flex items-center">
            <p class="mr-4 italic"><?= lang('Podcast.no_podcast') ?></p>
            <a class="self-start px-4 py-2 border hover:bg-gray-100 " href="<?= route_to(
                'podcast_create'
            ) ?>"><?= lang('Podcast.create_one') ?></a>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection()
?>
