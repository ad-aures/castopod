<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<h1 class="mb-2 text-xl"><?= lang('Home.all_podcasts') ?> (<?= count(
     $podcasts
 ) ?>)</h1>
<section class="flex flex-wrap">
    <?php if ($podcasts): ?>
        <?php foreach ($podcasts as $podcast): ?>
            <a href="<?= route_to('podcast_view', $podcast->name) ?>">
                <article class="w-48 h-full p-2 mb-4 mr-4 border shadow-sm hover:bg-gray-100 hover:shadow">
                    <img alt="<?= $podcast->title ?>" src="<?= $podcast->image_url ?>" class="object-cover w-full h-40 mb-2" />
                    <h2 class="font-semibold leading-tight"><?= $podcast->title ?></h2>
                    <p class="text-gray-600">@<?= $podcast->name ?></p>
                </article>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="italic"><?= lang('Home.no_podcast') ?></p>
    <?php endif; ?>
</section>

<?= $this->endSection() ?>
