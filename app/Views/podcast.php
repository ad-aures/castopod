<?= helper('page') ?>

<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <title><?= $podcast->title ?></title>
    <meta name="description" content="<?= $podcast->description ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<?php if (
    !empty($podcast->payment_pointer)
): ?>    <meta name="monetization" content="<?= $podcast->payment_pointer ?>">                    
<?php endif; ?>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link rel="stylesheet" href="/assets/index.css"/>
    <link rel="canonical" href="<?= current_season_url() ?>" />
    <link type="application/rss+xml" rel="alternate" title="<?= $podcast->title ?>" href="<?= $podcast->feed_url ?>"/>
    <script src="/assets/podcast.js" type="module" defer></script>
    <meta property="og:title" content="<?= $podcast->title ?>" />
    <meta property="og:locale" content="<?= $podcast->language_code ?>" />
    <meta property="og:site_name" content="<?= $podcast->title ?>" />
    <meta property="og:url" content="<?= current_season_url() ?>" />
    <meta property="og:image" content="<?= $podcast->image->large_url ?>" />
    <meta property="og:image:width" content="<?= config('Images')
        ->largeSize ?>" />
    <meta property="og:image:height" content="<?= config('Images')
        ->largeSize ?>" />
    <meta property="og:description" content="<?= $podcast->description ?>" />
    <meta name="twitter:card" content="summary_large_image" />
</head>

<body class="flex flex-col min-h-screen">
    <main class="flex-1 bg-gray-200">
        <header class="border-b bg-gradient-to-tr from-gray-900 to-gray-800">
            <div class="flex flex-col items-center justify-center md:items-stretch md:mx-auto md:container md:py-12 md:flex-row ">
                <img src="<?= $podcast->image->medium_url ?>"
                alt="<?= $podcast->title ?>" class="object-cover w-full max-w-xs m-4 rounded-lg shadow-xl" />
                <div class="w-full p-4 bg-white md:max-w-md md:text-white md:bg-transparent">
                    <h1 class="text-2xl font-semibold leading-tight"><?= $podcast->title ?> <span class="text-lg font-normal opacity-75">@<?= $podcast->name ?></span></h1>
                    <div class="flex items-center mb-4">
                        <address>
                            <?= lang('Podcast.by', [
                                'publisher' => $podcast->publisher,
                            ]) ?>
                        </address>
                        <?= $podcast->parental_advisory === 'explicit'
                            ? '<span class="px-1 ml-2 text-xs font-semibold leading-tight tracking-wider uppercase border-2 border-gray-700 rounded md:border-white">' .
                                lang('Common.explicit') .
                                '</span>'
                            : '' ?>
                        <?= location_link(
                            $podcast->location_name,
                            $podcast->location_geo,
                            $podcast->location_osmid,
                            'ml-4'
                        ) ?>
                    </div>
                    <div class="flex mb-2 space-x-2">
                        <?= anchor(
                            route_to('podcast_feed', $podcast->name),
                            icon('rss', 'mr-2') . lang('Podcast.feed'),
                            [
                                'class' =>
                                    'text-white bg-gradient-to-r from-orange-400 to-red-500 hover:to-orange-500 hover:bg-orange-500 inline-flex items-center px-2 py-1 font-semibold rounded-lg shadow-md hover:bg-orange-600',
                            ]
                        ) ?>
                    <?php foreach (
                        $podcast->podcastingPlatforms
                        as $podcastingPlatform
                    ): ?>
                        <?php if ($podcastingPlatform->is_visible): ?>
                            <a href="<?= $podcastingPlatform->link_url ?>" title="<?= $podcastingPlatform->label ?>" target="_blank" rel="noopener noreferrer">
                            <?= platform_icon(
                                $podcastingPlatform->type,
                                $podcastingPlatform->slug,
                                'h-8'
                            ) ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </div>
                               
                    <div class="flex mb-2 space-x-2">
                    <?php foreach (
                        $podcast->socialPlatforms
                        as $socialPlatform
                    ): ?>
                        <?php if ($socialPlatform->is_visible): ?>
                            <a href="<?= $socialPlatform->link_url ?>" title="<?= $socialPlatform->label ?>" target="_blank" rel="noopener noreferrer">
                            <?= platform_icon(
                                $socialPlatform->type,
                                $socialPlatform->slug,
                                'h-8 text-black md:text-white'
                            ) ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </div>
               
                    <div class="flex mb-2 space-x-2">
                    <?php foreach (
                        $podcast->fundingPlatforms
                        as $fundingPlatform
                    ): ?>
                        <?php if ($fundingPlatform->is_visible): ?>
                            <a href="<?= $fundingPlatform->link_url ?>" title="<?= $fundingPlatform->link_content ?>" target="_blank" rel="noopener noreferrer">
                            <?= platform_icon(
                                $fundingPlatform->type,
                                $fundingPlatform->slug,
                                'h-8'
                            ) ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </div>

                    <div class="flex mb-2 space-x-2">
                    <?php foreach ($personArray as $person): ?>
                        <?php if (!empty($person['information_url'])): ?>
                            <a href="<?= $person[
                                'information_url'
                            ] ?>" target="_blank" rel="noreferrer noopener">
                        <?php endif; ?>
                        <img src="<?= $person[
                            'thumbnail_url'
                        ] ?>" alt="<?= $person[
    'full_name'
] ?>" title="[<?= $person['full_name'] ?>] <?= $person[
    'roles'
] ?>" class="object-cover w-12 h-12 rounded-full" />
                        <?php if (!empty($person['information_url'])): ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </div>
                    
                    <div class="mb-2 opacity-75">
                        <?= $podcast->description_html ?>
                    </div>
                    <span class="px-2 py-1 mb-2 mr-2 text-sm text-gray-700 bg-gray-200 rounded">
                        <?= lang(
                            'Podcast.category_options.' .
                                $podcast->category->code
                        ) ?>
                    </span>
                    <?php foreach (
                        $podcast->other_categories
                        as $other_category
                    ): ?>
                        <span class="px-2 py-1 mb-2 mr-2 text-sm text-gray-700 bg-gray-200 rounded">
                            <?= lang(
                                'Podcast.category_options.' .
                                    $other_category->code
                            ) ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
        </header>

        <section class="flex flex-col">
            <nav class="inline-flex justify-center px-4 bg-gray-100 border-b">
                <?php foreach ($episodesNav as $link): ?>
                    <?= anchor(
                        $link['route'],
                        $link['label'] .
                            ' (' .
                            $link['number_of_episodes'] .
                            ')',
                        [
                            'class' =>
                                'px-2 py-1 font-semibold ' .
                                ($link['is_active']
                                    ? 'border-b-2 border-gray-600'
                                    : 'text-gray-600 hover:text-gray-900'),
                        ]
                    ) ?>
                <?php endforeach; ?>
            </nav>
            <div class="container py-6 mx-auto">
                <?php if ($episodes): ?>
                    <h1 class="px-4 mb-2 text-xl text-center">
                    <?php if ($activeQuery['type'] == 'year'): ?>
                        <?= lang('Podcast.list_of_episodes_year', [
                            'year' => $activeQuery['value'],
                        ]) ?> (<?= count($episodes) ?>)
                    <?php elseif ($activeQuery['type'] == 'season'): ?>
                        <?= lang('Podcast.list_of_episodes_season', [
                            'seasonNumber' => $activeQuery['value'],
                        ]) ?> (<?= count($episodes) ?>)
                    <?php endif; ?>
                    </h1>
                    <?php foreach ($episodes as $episode): ?>
                        <article class="flex w-full max-w-lg p-4 mx-auto">
                            <img
                            loading="lazy"
                            src="<?= $episode->image->thumbnail_url ?>"
                            alt="<?= $episode->title ?>" class="object-cover w-20 h-20 mr-2 rounded-lg" />
                            <div class="flex flex-col flex-1">
                                <a class="text-sm hover:underline" href="<?= $episode->link ?>">
                                    <h2 class="inline-flex justify-between w-full font-bold leading-none group">
                                        <span class="mr-1 group-hover:underline"><?= $episode->title ?></span>
                                        <?= episode_numbering(
                                            $episode->number,
                                            $episode->season_number,
                                            'text-xs font-bold text-gray-600',
                                            true
                                        ) ?>
                                    </h2>
                                </a>
                                <div class="mb-2 text-xs">
                                    <time
                                    pubdate
                                    datetime="<?= $episode->published_at->format(
                                        DateTime::ATOM
                                    ) ?>"
                                    title="<?= $episode->published_at ?>">
                                    <?= lang('Common.mediumDate', [
                                        $episode->published_at,
                                    ]) ?>
                                    </time>
                                    <span class="mx-1">•</span>
                                    <time datetime="PT<?= $episode->enclosure_duration ?>S">
                                        <?= format_duration(
                                            $episode->enclosure_duration
                                        ) ?>
                                    </time>
                                </div>
                                <audio controls preload="none" class="w-full mt-auto">
                                    <source src="<?= $episode->enclosure_web_url ?>" type="<?= $episode->enclosure_type ?>">
                                    Your browser does not support the audio tag.
                                </audio>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h1 class="px-4 mb-2 text-xl text-center"><?= lang(
                        'Podcast.no_episode'
                    ) ?></h1>
                    <p class="italic text-center"><?= lang(
                        'Podcast.no_episode_hint'
                    ) ?></p>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <footer class="px-2 py-4 border-t ">
        <div class="container flex flex-col items-center justify-between mx-auto text-xs md:flex-row ">
            <?= render_page_links('inline-flex mb-4 md:mb-0') ?>
            <div class="flex flex-col items-center md:items-end">
                <p><?= $podcast->copyright ?></p>
                <p><?= lang('Common.powered_by', [
                    'castopod' =>
                        '<a class="underline hover:no-underline" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod</a>',
                ]) ?></p>
            </div>
        </div>
    </footer>
</body>
