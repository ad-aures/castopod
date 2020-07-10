<?= $this->extend('admin/_layout') ?>

<?= $this->section('content') ?>

<div class="flex flex-col py-4">
    <h1 class="mb-4 text-xl"><?= lang(
        'Episode.all_podcast_episodes'
    ) ?> (<?= count($all_podcast_episodes) ?>)</h1>
    <?php if ($all_podcast_episodes): ?>
        <?php foreach ($all_podcast_episodes as $episode): ?>
            <article class="flex-col w-full max-w-lg p-4 mb-4 border shadow">
                <div class="flex mb-2">
                    <img src="<?= $episode->image_url ?>" alt="<?= $episode->title ?>" class="object-cover w-32 h-32 mr-4" />
                    <div class="flex flex-col flex-1">
                        <a href="<?= route_to(
                            'episode_edit',
                            $podcast->name,
                            $episode->slug
                        ) ?>">
                            <h3 class="text-xl font-semibold">
                                <span class="mr-1 underline hover:no-underline"><?= $episode->title ?></span>
                                <span class="text-base font-bold text-gray-600">#<?= $episode->number ?></span>
                            </h3>
                            <p><?= $episode->description ?></p>
                        </a>
                        <audio controls class="mt-auto" preload="none">
                            <source src="<?= $episode->enclosure_url ?>" type="<?= $episode->enclosure_type ?>">
                            Your browser does not support the audio tag.
                        </audio>
                    </div>
                </div>
                <a class="inline-flex px-4 py-2 text-white bg-teal-700 hover:bg-teal-800" href="<?= route_to(
                    'episode_edit',
                    $podcast->name,
                    $episode->slug
                ) ?>"><?= lang('Episode.edit') ?></a>
                <a href="<?= route_to(
                    'episode',
                    $podcast->name,
                    $episode->slug
                ) ?>" class="inline-flex px-4 py-2 text-white bg-gray-700 hover:bg-gray-800"><?= lang(
    'Episode.goto_page'
) ?></a>
                <a href="<?= route_to(
                    'episode_delete',
                    $podcast->name,
                    $episode->slug
                ) ?>" class="inline-flex px-4 py-2 text-white bg-red-700 hover:bg-red-800"><?= lang(
    'Episode.delete'
) ?></a>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="flex items-center">
            <p class="mr-4 italic"><?= lang('Podcast.no_episode') ?></p>
            <a class="self-start px-4 py-2 border hover:bg-gray-100" href="<?= route_to(
                'episode_create',
                $podcast->name
            ) ?>"><?= lang('Episode.create_one') ?></a>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection()
?>
