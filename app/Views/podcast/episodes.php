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
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<nav class="sticky top-0 flex items-center justify-center pt-2 text-lg bg-pine-50">
    <a href="<?= route_to(
        'podcast-activity',
        $podcast->name,
    ) ?>" class="px-4 py-1 mr-8 rounded-full hover:bg-pine-100"><?= lang(
    'Podcast.activity',
) ?></a>
    <a href="<?= route_to(
        'podcast-episodes',
        $podcast->name,
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
            <article class="w-full mb-4 bg-white rounded-lg shadow">
                <div class="flex px-4 pt-4 pb-2">
                    <img loading="lazy" src="<?= $episode->image
                        ->thumbnail_url ?>" alt="<?= $episode->title ?>" class="object-cover w-20 h-20 mr-2 rounded-lg" />
                    <div class="flex flex-col flex-1">
                        <a class="text-sm" href="<?= $episode->link ?>">
                            <h2 class="inline-flex justify-between w-full font-semibold leading-none group">
                                <span class="mr-1 group-hover:underline"><?= $episode->title ?></span>
                                <?= episode_numbering(
                                    $episode->number,
                                    $episode->season_number,
                                    'text-xs font-semibold text-gray-600',
                                    true,
                                ) ?>
                            </h2>
                        </a>
                        <div class="mb-2 text-xs">
                            <time itemprop="published" datetime="<?= $episode->published_at->format(
                                DateTime::ATOM,
                            ) ?>" title="<?= $episode->published_at ?>">
                                <?= lang('Common.mediumDate', [
                                    $episode->published_at,
                                ]) ?>
                            </time>
                            <span class="mx-1">•</span>
                            <time datetime="PT<?= $episode->audio_file_duration ?>S">
                                <?= format_duration(
                                    $episode->audio_file_duration,
                                ) ?>
                            </time>
                        </div>
                        <audio controls preload="none" class="w-full mt-auto">
                            <source src="<?= $episode->audio_file_web_url ?>" type="<?= $episode->audio_file_mimetype ?>">
                            Your browser does not support the audio tag.
                        </audio>
                    </div>
                </div>
                <div class="px-4 py-2 space-x-4 text-sm">
                    <?= anchor(
                        route_to('episode', $podcast->name, $episode->slug),
                        icon('chat', 'text-xl mr-1 text-gray-400') .
                            $episode->statuses_total,
                        [
                            'class' =>
                                'inline-flex items-center hover:underline',
                            'title' => lang('Episode.total_statuses', [
                                'numberOfTotalStatuses' => $episode->statuses_total,
                            ]),
                        ],
                    ) ?>
                    <?= anchor(
                        route_to('episode', $podcast->name, $episode->slug),
                        icon('repeat', 'text-xl mr-1 text-gray-400') .
                            $episode->reblogs_total,
                        [
                            'class' =>
                                'inline-flex items-center hover:underline',
                            'title' => lang('Episode.total_reblogs', [
                                'numberOfTotalReblogs' =>
                                    $episode->reblogs_total,
                            ]),
                        ],
                    ) ?>

                    <?= anchor(
                        route_to('episode', $podcast->name, $episode->slug),
                        icon('heart', 'text-xl mr-1 text-gray-400') .
                            $episode->favourites_total,
                        [
                            'class' =>
                                'inline-flex items-center hover:underline',
                            'title' => lang('Episode.total_favourites', [
                                'numberOfTotalFavourites' =>
                                    $episode->favourites_total,
                            ]),
                        ],
                    ) ?>
                </div>
            </article>
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
