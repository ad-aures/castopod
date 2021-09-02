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
<meta property="og:image:width" content="<?= config('Images')->largeSize ?>" />
<meta property="og:image:height" content="<?= config('Images')->largeSize ?>" />
<meta name="twitter:card" content="summary_large_image" />

<?= service('vite')->asset('styles/index.css', 'css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<nav class="sticky z-20 flex items-center justify-center pt-2 text-lg top-12 sm:top-0 bg-pine-50">
    <a href="<?= route_to(
        'podcast-activity',
        $podcast->handle,
    ) ?>" class="px-4 py-1 mr-8 rounded-full hover:bg-pine-100"><?= lang(
    'Podcast.activity',
) ?></a>
    <a href="<?= route_to(
        'podcast-episodes',
        $podcast->handle,
    ) ?>" class="px-4 py-1 font-semibold border-b-4 text-pine-800 border-pine-800"><?= lang(
    'Podcast.episodes',
) ?></a>
    <?php if ($activeQuery): ?>
        <button id="episode-lists-dropdown" type="button" class="inline-flex items-center px-2 py-1 text-sm font-semibold outline-none focus:ring" data-dropdown="button" data-dropdown-target="episode-lists-dropdown-menu" aria-label="<?= lang(
            'Common.more',
        ) ?>" aria-haspopup="true" aria-expanded="false">
            <?= $activeQuery['label'] .
                ' (' .
                $activeQuery['number_of_episodes'] .
                ')' .
                icon('caret-down', 'ml-2 text-xl') ?>
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
</nav>

<section class="flex flex-col max-w-2xl px-6 py-8 mx-auto">

    <?php if ($episodes): ?>
        <h1 class="mb-4 text-xl font-semibold">
            <?php if ($activeQuery['type'] == 'year'): ?>
                <?= lang('Podcast.list_of_episodes_year', [
                    'year' => $activeQuery['value'],
                    'episodeCount' => count($episodes),
                ]) ?>
            <?php elseif ($activeQuery['type'] == 'season'): ?>
                <?= lang('Podcast.list_of_episodes_season', [
                    'seasonNumber' => $activeQuery['value'],
                    'episodeCount' => count($episodes),
                ]) ?>
            <?php endif; ?>
        </h1>
        <?php foreach ($episodes as $episode): ?>
            <?= view('podcast/_partials/episode_card', [
                'episode' => $episode,
                'podcast' => $podcast
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
