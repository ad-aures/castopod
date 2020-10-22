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
    ['variant' => 'primary', 'iconLeft' => 'add'],
    ['class' => 'mr-2']
) ?>
<?= button(lang('Podcast.import'), route_to('podcast-import'), [
    'variant' => 'primary',
    'iconLeft' => 'download',
]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="flex flex-wrap">
    <?php if (!empty($podcasts)): ?>
        <?php foreach ($podcasts as $podcast): ?>
            <article class="w-48 h-full mb-4 mr-4 overflow-hidden bg-white border rounded shadow">
            <img
            alt="<?= $podcast->title ?>"
            src="<?= $podcast->image
                ->thumbnail_url ?>" class="object-cover w-full h-40" />
            <div class="p-2">
                <a href="<?= route_to(
                    'podcast-view',
                    $podcast->id
                ) ?>" class="hover:underline">
                    <h2 class="font-semibold"><?= $podcast->title ?></h2>
                </a>
                <p class="text-gray-600">@<?= $podcast->name ?></p>
            </div>
            <footer class="flex items-center justify-end p-2">
                <a class="inline-flex p-2 mr-2 text-teal-700 bg-teal-100 rounded-full shadow-xs hover:bg-teal-200" href="<?= route_to(
                    'podcast-edit',
                    $podcast->id
                ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?= lang(
    'Podcast.edit'
) ?>"><?= icon('edit') ?></a>
                <a class="inline-flex p-2 text-gray-700 bg-gray-100 rounded-full shadow-xs hover:bg-gray-200" href="<?= route_to(
                    'podcast-view',
                    $podcast->id
                ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?= lang(
    'Podcast.view'
) ?>"><?= icon('eye') ?></a>
            </footer>
        </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="italic"><?= lang('Podcast.no_podcast') ?></p>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
