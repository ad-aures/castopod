<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<header class="py-4 border-b">
    <h1 class="text-2xl"><?= $podcast->title ?></h1>
    <img src="<?= $podcast->image_url ?>" alt="Podcast cover" class="object-cover w-40 h-40 mb-6" />
    <a class="inline-flex px-4 py-2 bg-orange-500 hover:bg-orange-600" href="<?= route_to(
        'podcast_feed',
        $podcast->name
    ) ?>"><?= lang('Podcast.feed') ?></a>
</header>

<section class="flex flex-col py-4">
    <h2 class="mb-4 text-xl"><?= lang('Podcast.list_of_episodes') ?> (<?= count(
     $episodes
 ) ?>)</h2>
    <?php if ($episodes): ?>
        <?php foreach ($episodes as $episode): ?>
            <article class="flex w-full max-w-lg p-4 mb-4 border shadow">
                <img src="<?= $episode->image_url ?>" alt="<?= $episode->title ?>" class="object-cover w-32 h-32 mr-4" />
                <div class="flex flex-col flex-1">
                    <a href="<?= $episode->link ?>">
                        <h3 class="text-xl font-semibold">
                            <span class="mr-1 underline hover:no-underline"><?= $episode->title ?></span>
                            <span class="text-base font-bold text-gray-600">#<?= $episode->number ?></span>
                        </h3>
                    </a>
                    <audio controls class="mt-auto" preload="none">
                        <source src="<?= $episode->enclosure_url ?>" type="<?= $episode->enclosure_type ?>">
                        Your browser does not support the audio tag.
                    </audio>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="italic"><?= lang('Podcast.no_episode') ?></p>
    <?php endif; ?>
</section>


<?= $this->endSection()
?>
