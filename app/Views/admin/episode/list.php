<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>

<?= lang('Episode.all_podcast_episodes') ?> (<?= count($podcast->episodes) ?>)

<?= $this->endSection() ?>


<?= $this->section('content') ?>

<a class="inline-block px-4 py-2 mb-2 border hover:bg-gray-100" href="<?= route_to(
    'episode_create',
    $podcast->id
) ?>"><?= lang('Episode.create') ?></a>
<div class="flex flex-col py-4">
    <?php if ($podcast->episodes): ?>
        <?php foreach ($podcast->episodes as $episode): ?>
            <article class="flex-col w-full max-w-lg p-4 mb-4 border shadow">
                <div class="flex mb-2">
                    <img src="<?= $episode->image_url ?>" alt="<?= $episode->title ?>" class="object-cover w-32 h-32 mr-4" />
                    <div class="flex flex-col flex-1">
                        <a href="<?= route_to(
                            'episode_edit',
                            $podcast->id,
                            $episode->id
                        ) ?>">
                            <h3 class="text-xl font-semibold">
                                <span class="mr-1 underline hover:no-underline"><?= $episode->title ?></span>
                                <span class="text-base font-bold text-gray-600">#<?= $episode->number ?></span>
                            </h3>
                            <p><?= $episode->description ?></p>
                        </a>
                        <audio controls class="mt-auto" preload="none">
                            <source src="<?= $episode->enclosure_media_path ?>" type="<?= $episode->enclosure_type ?>">
                            Your browser does not support the audio tag.
                        </audio>
                    </div>
                </div>
                <a class="inline-flex px-4 py-2 text-white bg-teal-700 hover:bg-teal-800" href="<?= route_to(
                    'episode_edit',
                    $podcast->id,
                    $episode->id
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
                    $podcast->id,
                    $episode->id
                ) ?>" class="inline-flex px-4 py-2 text-white bg-red-700 hover:bg-red-800"><?= lang(
    'Episode.delete'
) ?></a>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="italic"><?= lang('Podcast.no_episode') ?></p>
    <?php endif; ?>
</div>

<?= $this->endSection()
?>
