<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">
<head>
    <meta charset="UTF-8" />
    <title><?= $episode->title ?></title>
    <meta name="description"
    content="<?= htmlspecialchars($episode->description) ?>"/> 
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <link rel="stylesheet" href="/assets/index.css" />
    <link rel="canonical" href="<?= $episode->link ?>" />
</head>
<body>
    <div class="flex w-full p-1 md:p-2"style="background: <?= $theme[
        'background'
    ] ?>; color: <?= $theme['text'] ?>;">
        <img src="<?= $episode->image
            ->medium_url ?>" alt="<?= $episode->title ?>" class="w-32 h-32 md:w-64 md:h-64" />
        <div class="flex-grow pl-4">
            <div class="flex">
                <a href="<?= route_to('podcast', $podcast->name) ?>"
                style="color: <?= $theme['text'] ?>;"
                class="flex flex-col text-base leading-tight opacity-50 md:text-lg hover:opacity-100" target="_blank">
                <?= $podcast->title ?>
                </a>
                <address class="ml-2 text-xs opacity-50 md:text-sm">
                <?= lang('Podcast.by', [
                    'publisher' => $podcast->publisher,
                ]) ?></address>
            </div>

            <div class="flex mt-1 space-x-2 md:space-x-4 md:mt-3 md:top-0 md:mr-4 md:right-0 md:absolute ">
                <?php if ($podcast->has_social_platforms): ?> 
                    <div  class="flex space-x-1">
                        <?php foreach (
                            $podcast->social_platforms
                            as $socialPlatform
                        ): ?>
                            <?php if (
                                $socialPlatform->is_on_embeddable_player
                            ): ?>
                                <?= anchor(
                                    $socialPlatform->link_url,
                                    platform_icon(
                                        $socialPlatform->type,
                                        $socialPlatform->slug,
                                        'h-4 md:h-6'
                                    ),
                                    [
                                        'target' => '_blank',
                                        'rel' => 'noopener noreferrer',
                                        'title' => $socialPlatform->label,
                                        'class' =>
                                            'opacity-50 hover:opacity-100',
                                    ]
                                ) ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if ($podcast->has_funding_platforms): ?>
                    <div class="flex space-x-1">
                        <?php foreach (
                            $podcast->funding_platforms
                            as $fundingPlatform
                        ): ?>
                            <?php if (
                                $fundingPlatform->is_on_embeddable_player
                            ): ?>
                                <?= anchor(
                                    $fundingPlatform->link_url,
                                    platform_icon(
                                        $fundingPlatform->type,
                                        $fundingPlatform->slug,
                                        'h-4 md:h-6'
                                    ),
                                    [
                                        'target' => '_blank',
                                        'rel' => 'noopener noreferrer',
                                        'title' => $fundingPlatform->label,
                                        'class' =>
                                            'opacity-50 hover:opacity-100',
                                    ]
                                ) ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="flex space-x-1">
                <?php foreach (
                    $podcast->podcasting_platforms
                    as $podcastingPlatform
                ): ?>
                    <?php if ($podcastingPlatform->is_on_embeddable_player): ?>
                        <?= anchor(
                            $podcastingPlatform->link_url,
                            platform_icon(
                                $podcastingPlatform->type,
                                $podcastingPlatform->slug,
                                'h-4 md:h-6'
                            ),
                            [
                                'target' => '_blank',
                                'rel' => 'noopener noreferrer',
                                'title' => $podcastingPlatform->label,
                                'class' => 'opacity-50 hover:opacity-100',
                            ]
                        ) ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?= anchor(
                    route_to('podcast_feed', $podcast->name),
                    icon('rss', 'mr-2') . lang('Podcast.feed'),
                    [
                        'target' => '_blank',
                        'class' =>
                            'text-white h-4 md:h-6 md:text-sm text-xs bg-gradient-to-r from-orange-400 to-red-500 hover:to-orange-500 hover:bg-orange-500 inline-flex items-center px-2 py-1 font-semibold rounded-md md:rounded-lg shadow-md hover:bg-orange-600',
                    ]
                ) ?>
                </div>
            </div>
            <h1 class="mt-2 text-xl font-semibold opacity-100 md:text-3xl hover:opacity-75">
                <a href="<?= $episode->link ?>"
                style="color: <?= $theme['text'] ?>;"
                target="_blank">
                    <?= $episode->title ?>
                </a>
            </h1>
            <div class="flex w-full">
                <div
                    style="color: <?= $theme['text'] ?>;"
                    class="text-sm opacity-50 md:text-base">
                    <?= episode_numbering(
                        $episode->number,
                        $episode->season_number
                    ) ?>
                    <div>
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
                        <span>•</span>
                        <time datetime="PT<?= $episode->enclosure_duration ?>S">
                            <?= format_duration($episode->enclosure_duration) ?>
                        </time>
                    </div>
                </div>
                <?php if ($episode->location_name): ?>
                    <a href="<?= location_url(
                        $episode->location_name,
                        $episode->location_geo,
                        $episode->location_osmid
                    ) ?>"
                style="color: <?= $theme['inverted'] ?>; background: <?= $theme[
    'text'
] ?>;" class="inline-flex items-center px-3 py-1 mt-1 ml-4 text-xs align-middle rounded-full shadow-xs outline-none opacity-50 md:mt-2 md:text-sm hover:opacity-75 focus:shadow-outline" target="_blank" rel="noreferrer noopener"><?= icon(
    'map-pin'
) ?>
                        <?= $episode->location_name ?>
                    </a>
                <?php endif; ?>
            </div>
                    
            <?php if (!empty($persons)): ?>
                <div class="flex my-2 space-x-1 md:my-4 md:space-x-2">
                    <?php foreach ($persons as $person): ?>
                        <?php if (!empty($person['information_url'])): ?>
                            <a href="<?= $person['information_url'] ?>"
                            class="hover:opacity-50"
                            target="_blank"
                            rel="noreferrer noopener">
                        <?php endif; ?>
                                <img src="<?= $person['thumbnail_url'] ?>"
                                alt="<?= $person['full_name'] ?>"
                                title="[<?= $person[
                                    'full_name'
                                ] ?>] <?= $person['roles'] ?>"
                                class="object-cover h-8 rounded-full md:h-12 md:w-12" />
                        <?php if (!empty($person['information_url'])): ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <audio controls preload="none" class="flex w-full mt-2 md:mt-4">
                <source
                src="<?= $episode->enclosure_url .
                    (isset($_SERVER['HTTP_REFERER'])
                        ? '?_from=' .
                            parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)
                        : '') ?>"
                type="<?= $episode->enclosure_type ?>" />
                    Your browser does not support the audio tag.
            </audio>
        </div>


        <a href="https://castopod.org/"
        class="absolute bottom-0 right-0 mb-4 mr-4 hover:opacity-75"
        title="<?= lang('Common.powered_by', [
            'castopod' => 'Castopod',
        ]) ?>"
        target="_blank"
        rel="noopener noreferrer">
            <?= platform_icon('podcasting', 'castopod', 'h-6') ?>
        </a>
    </div>
</body>
</html>