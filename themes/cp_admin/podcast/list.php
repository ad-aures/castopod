<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.all_podcasts') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.all_podcasts') ?> (<?= count($podcasts) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button uri="<?= route_to('podcast-import') ?>" variant="secondary" iconLeft="download"><?= lang('Podcast.import') ?></Button>
<Button uri="<?= route_to('podcast-create') ?>" variant="primary" iconLeft="add"><?= lang('Podcast.create') ?></Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="grid gap-4 grid-cols-podcasts">
    <?php if ($podcasts !== null): ?>
        <?php foreach ($podcasts as $podcast): ?>
            <article class="relative h-full overflow-hidden transition bg-white shadow border-3 border-pine-100 rounded-xl group hover:shadow-xl focus-within:ring-castopod">
                <div class="w-full h-full overflow-hidden">
                    <img
                    alt="<?= $podcast->title ?>"
                    src="<?= $podcast->image->medium_url ?>" class="object-cover w-full h-full transition duration-200 ease-in-out transform group-hover:scale-105" />
                </div>
                <a href="<?= route_to(
    'podcast-view',
    $podcast->id,
) ?>" class="absolute bottom-0 left-0 flex flex-col justify-end w-full h-full text-white" style="
                    background-image: linear-gradient(180deg,
                        hsla(0, 0%, 35.29%, 0) 0%,hsla(0, 0%, 34.53%, 0.034375) 16.36%,
                        hsla(0, 0%, 32.42%, 0.125) 33.34%,
                        hsla(0, 0%, 29.18%, 0.253125) 50.1%,
                        hsla(0, 0%, 24.96%, 0.4) 65.75%,
                        hsla(0, 0%, 19.85%, 0.546875) 79.43%,
                        hsla(0, 0%, 13.95%, 0.675) 90.28%,
                        hsla(0, 0%, 7.32%, 0.765625) 97.43%,
                      hsla(0, 0%, 0%, 0.8) 100%
                    );
                ">
                    <div class="px-4 pb-4 transition duration-75 ease-out translate-y-6 group-hover:translate-y-0">
                        <h2 class="font-bold leading-none truncate font-display"><?= $podcast->title ?></h2>
                        <p class="text-sm transition duration-150 opacity-0 group-hover:opacity-75">@<?= $podcast->handle ?></p>
                    </div>
                </a>
                <button class="absolute top-0 right-0 p-2 mt-2 mr-2 text-white transition -translate-y-12 rounded-full opacity-0 group-hover:translate-y-0 bg-black/25 group-hover:opacity-100" id="more-dropdown-<?= $podcast->id ?>" data-dropdown="button" data-dropdown-target="more-dropdown-<?= $podcast->id ?>-menu" aria-haspopup="true" aria-expanded="false" title="<?= lang('Common.more') ?>"><?= icon('more') ?></button>
                <DropdownMenu id="more-dropdown-<?= $podcast->id ?>-menu" labelledby="more-dropdown-<?= $podcast->id ?>" items="<?= esc(json_encode([
                    [
                        'type' => 'link',
                        'title' => lang('Podcast.view'),
                        'uri' => route_to('podcast-view', $podcast->id),
                    ],
                    [
                        'type' => 'link',
                        'title' => lang('Podcast.edit'),
                        'uri' => route_to('podcast-edit', $podcast->id),
                    ],
                ])) ?>" />
        </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="italic"><?= lang('Podcast.no_podcast') ?></p>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
