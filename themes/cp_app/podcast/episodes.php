<?= $this->extend('podcast/_layout') ?>

<?= $this->section('meta-tags') ?>
<link type="application/rss+xml" rel="alternate" title="<?= $podcast->title ?>" href="<?= $podcast->feed_url ?>" />

<title><?= $podcast->title ?></title>
<meta name="description" content="<?= htmlspecialchars(
    $podcast->description,
) ?>" />
<link rel="shortcut icon" type="image/png" href="/favicon.ico" />
<link rel="canonical" href="<?= current_url() ?>" />
<meta property="og:title" content="<?= $podcast->title ?>" />
<meta property="og:description" content="<?= $podcast->description ?>" />
<meta property="og:locale" content="<?= $podcast->language_code ?>" />
<meta property="og:site_name" content="<?= $podcast->title ?>" />
<meta property="og:url" content="<?= current_url() ?>" />
<meta property="og:image" content="<?= $podcast->image->large_url ?>" />
<meta property="og:image:width" content="<?= config('Images')
    ->largeSize ?>" />
<meta property="og:image:height" content="<?= config('Images')
    ->largeSize ?>" />
<meta name="twitter:card" content="summary_large_image" />

<?= service('vite')
    ->asset('styles/index.css', 'css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="flex flex-col max-w-2xl gap-y-4">
    <?php if ($episodes): ?>
        <div class="flex items-center justify-between">
            <h1 class="font-semibold">
                <?php if ($activeQuery['type'] === 'year'): ?>
                    <?= lang('Podcast.list_of_episodes_year', [
    'year' => $activeQuery['value'],
                        'episodeCount' => count($episodes),
]) ?>
                <?php elseif ($activeQuery['type'] === 'season'): ?>
                    <?= lang('Podcast.list_of_episodes_season', [
    'seasonNumber' => $activeQuery['value'],
                        'episodeCount' => count($episodes),
]) ?>
                <?php endif; ?>
            </h1>
            <?php if ($activeQuery): ?>
                <button id="episode-lists-dropdown" type="button" class="inline-flex items-center px-2 py-1 text-sm font-semibold outline-none focus:ring" data-dropdown="button" data-dropdown-target="episode-lists-dropdown-menu" aria-label="<?= lang('Common.more') ?>" aria-haspopup="true" aria-expanded="false">
                    <?= $activeQuery['label'] . icon('caret-down', 'ml-2 text-xl') ?>
                </button>
                <nav id="episode-lists-dropdown-menu" class="flex flex-col py-2 text-black bg-white border rounded shadow" aria-labelledby="episode-lists-dropdown" data-dropdown="menu" data-dropdown-placement="bottom-end">
                    <?php foreach ($episodesNav as $link): ?>
                        <?= anchor(
    $link['route'],
    $link['label'] . ' (' . $link['number_of_episodes'] . ')',
    [
        'class' =>
            'px-2 py-1 whitespace-nowrap ' .
            ($link['is_active']
                ? 'font-semibold'
                : 'text-gray-600 hover:text-gray-900'),
    ],
) ?>
                    <?php endforeach; ?>
                </nav>
            <?php endif; ?>
        </div>
        <?php foreach ($episodes as $episode): ?>
            <?= view('episode/_partials/card', [
                'episode' => $episode,
                'podcast' => $podcast,
            ]) ?>
        <?php endforeach; ?>
    <?php else: ?>
        <h1 class="px-4 mb-2 text-xl text-center"><?= lang(
                'Podcast.no_episode',
            ) ?></h1>
        <p class="italic text-center"><?= lang('Podcast.no_episode_hint') ?></p>
    <?php endif; ?>
</section>

<?= $this->endSection()
?>
