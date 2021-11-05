<?= $this->extend('podcast/_layout') ?>

<?= $this->section('meta-tags') ?>
<!-- TODO: -->

<link type="application/rss+xml" rel="alternate" title="<?= $podcast->title ?>" href="<?= $podcast->feed_url ?>" />

<title><?= $podcast->title ?></title>
<meta name="description" content="<?= htmlspecialchars(
    $podcast->description,
) ?>" />
<link rel="icon" type="image/x-icon" href="<?= service('settings')
    ->get('App.siteIcon')['ico'] ?>" />
<link rel="apple-touch-icon" href="<?= service('settings')->get('App.siteIcon')['180'] ?>">
<link rel="manifest" href="<?= route_to('webmanifest') ?>">
<link rel="canonical" href="<?= current_url() ?>" />
<meta property="og:title" content="<?= $podcast->title ?>" />
<meta property="og:description" content="<?= $podcast->description ?>" />
<meta property="og:locale" content="<?= $podcast->language_code ?>" />
<meta property="og:site_name" content="<?= $podcast->title ?>" />
<meta property="og:url" content="<?= current_url() ?>" />
<meta property="og:image" content="<?= $podcast->cover->large_url ?>" />
<meta property="og:image:width" content="<?= config('Images')->podcastCoverSizes['large'][0] ?>" />
<meta property="og:image:height" content="<?= config('Images')->podcastCoverSizes['large'][1] ?>" />
<meta name="twitter:card" content="summary_large_image" />

<?= service('vite')
    ->asset('styles/index.css', 'css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="px-2 sm:px-4">
    <div class="mb-2"><?= $podcast->description_html ?></div>
    <div class="flex gap-x-4 gap-y-2">
        <span class="px-2 py-1 text-sm font-semibold border rounded-sm border-subtle bg-highlight text-skin-muted">
            <?= lang(
        'Podcast.category_options.' . $podcast->category->code,
    ) ?>
        </span>
        <?php foreach ($podcast->other_categories as $other_category): ?>
            <span class="px-2 py-1 text-sm font-semibold border rounded-sm border-subtle bg-highlight text-skin-muted">
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
                        <img src="<?= $person->avatar->thumbnail_url ?>" alt="<?= $person->full_name ?>" class="object-cover w-8 h-8 -ml-5 border-2 rounded-full border-background-base last:ml-0" />
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
</div>


<?= view('_persons_modal', [
    'title' => lang('Podcast.persons_list', [
        'podcastTitle' => $podcast->title,
    ]),
    'persons' => $podcast->persons,
]) ?>

<?= $this->endSection()
?>
