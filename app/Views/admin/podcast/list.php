<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.all_podcasts') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.all_podcasts') ?> (<?= count($podcasts) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= button(
    lang('Podcast.create'),
    route_to('podcast-create'),
    ['variant' => 'accent', 'iconLeft' => 'add'],
    ['class' => 'mr-2'],
) ?>
<?= button(lang('Podcast.import'), route_to('podcast-import'), [
    'variant' => 'primary',
    'iconLeft' => 'download',
]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="grid gap-4 grid-cols-podcasts">
    <?php if ($podcasts !== null): ?>
        <?php foreach ($podcasts as $podcast): ?>
            <article class="h-full overflow-hidden bg-white border shadow rounded-xl">
            <img
            alt="<?= $podcast->title ?>"
            src="<?= $podcast->image
                ->medium_url ?>" class="object-cover w-full h-48" />
            <a href="<?= route_to(
                'podcast-view',
                $podcast->id,
            ) ?>" class="flex flex-col p-2 hover:underline">
                <h2 class="font-semibold truncate"><?= $podcast->title ?></h2>
                <p class="text-gray-600">@<?= $podcast->name ?></p>
            </a>
            <footer class="flex items-center justify-end p-2">
                <a class="inline-flex p-2 mr-2 text-blue-700 bg-blue-100 rounded-full shadow-xs hover:bg-blue-200" href="<?= route_to(
                    'podcast-edit',
                    $podcast->id,
                ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?= lang(
    'Podcast.edit',
) ?>"><?= icon('edit') ?></a>
                <a class="inline-flex p-2 text-gray-700 bg-gray-100 rounded-full shadow-xs hover:bg-gray-200" href="<?= route_to(
                    'podcast-view',
                    $podcast->id,
                ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?= lang(
    'Podcast.view',
) ?>"><?= icon('eye') ?></a>
            </footer>
        </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="italic"><?= lang('Podcast.no_podcast') ?></p>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
