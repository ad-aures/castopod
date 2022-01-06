<?= $this->extend('podcast/_layout') ?>

<?= $this->section('content') ?>

<div class="px-2 sm:px-4">
    <div class="mb-2"><?= $podcast->description_html ?></div>
    <div class="flex gap-x-4 gap-y-2">
        <span class="px-2 py-1 text-sm font-semibold border rounded-sm border-subtle bg-highlight">
            <?= lang(
    'Podcast.category_options.' . $podcast->category->code,
) ?>
        </span>
        <?php foreach ($podcast->other_categories as $other_category): ?>
            <span class="px-2 py-1 text-sm font-semibold border rounded-sm border-subtle bg-highlight">
                <?= lang(
    'Podcast.category_options.' . $other_category->code,
) ?>
            </span>
        <?php endforeach; ?>
    </div>

    <div class="flex items-center mt-4 gap-x-8">
        <?php if ($podcast->persons !== []): ?>
            <button class="flex items-center text-xs font-semibold gap-x-2 hover:underline focus:ring-accent" data-toggle="persons-list" data-toggle-class="hidden">
                <div class="inline-flex flex-row-reverse">
                    <?php $i = 0; ?>
                    <?php foreach ($podcast->persons as $person): ?>
                        <img src="<?= $person->avatar->thumbnail_url ?>" alt="<?= $person->full_name ?>" class="object-cover w-8 -ml-4 border-2 rounded-full aspect-square border-background-base last:ml-0" />
                        <?php $i++; if ($i === 3) {
    break;
}?>
                    <?php endforeach; ?>
                </div>
                <?= lang('Podcast.persons', [
                    'personsCount' => count($podcast->persons),
                ]) ?>
            </button>
        <?php endif; ?>
        <?php if ($podcast->location): ?>
            <?= location_link($podcast->location, 'text-xs font-semibold p-2') ?>
        <?php endif; ?>
    </div>
    <div class="mt-4">
        <h2 class="text-xs font-bold tracking-wider text-gray-600 uppercase border-b-2 border-subtle font-display"><?= lang('Podcast.stats.title') ?></h2>
        <div class="flex flex-col text-sm">
            <?php foreach ($stats as $key => $value): ?>
                <span class="py-2 border-b border-subtle">
                    <?= lang('Podcast.about.stats.' . $key, [$value]) ?>
                </span>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<?= view('_persons_modal', [
    'title' => lang('Podcast.persons_list', [
        'podcastTitle' => $podcast->title,
    ]),
    'persons' => $podcast->persons,
]) ?>

<?= $this->endSection()
?>
