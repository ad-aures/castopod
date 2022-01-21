<?= helper('page') ?>

<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/x-icon" href="<?= service('settings')
    ->get('App.siteIcon')['ico'] ?>" />
    <link rel="apple-touch-icon" href="<?= service('settings')->get('App.siteIcon')['180'] ?>">
    <link rel="manifest" href="<?= route_to('podcast-webmanifest', $podcast->handle) ?>">
    <meta name="theme-color" content="<?= \App\Controllers\WebmanifestController::THEME_COLORS[service('settings')->get('App.theme')]['theme'] ?>">
    <script>
    // Check that service workers are supported
    if ('serviceWorker' in navigator) {
        // Use the window load event to keep the page load performant
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js');
        });
    }
    </script>

    <?= $metatags ?>

    <link rel='stylesheet' type='text/css' href='<?= route_to('themes-colors-css') ?>' />
    <?= service('vite')
        ->asset('styles/index.css', 'css') ?>
    <?= service('vite')
        ->asset('js/app.ts', 'js') ?>
    <?= service('vite')
        ->asset('js/podcast.ts', 'js') ?>
    <?= service('vite')
        ->asset('js/audio-player.ts', 'js') ?>
</head>

<body class="flex flex-col min-h-screen mx-auto md:min-h-full md:grid md:grid-cols-podcast bg-base theme-<?= service('settings')
        ->get('App.theme') ?>">
    <?php if (can_user_interact()): ?>
        <div class="col-span-full">
            <?= $this->include('_admin_navbar') ?>
        </div>
    <?php endif; ?>

    <nav class="flex items-center justify-between h-10 col-start-2 text-white bg-header">
        <a href="<?= route_to('podcast-episodes', $podcast->handle) ?>" class="inline-flex items-center h-full px-2 focus:ring-accent focus:ring-inset" title="<?= lang('Episode.back_to_episodes', [
            'podcast' => $podcast->title,
        ]) ?>">
            <?= icon('arrow-left', 'mr-2 text-lg') ?>
            <div class="inline-flex items-center gap-x-2">
                <img class="w-8 h-8 rounded-full" src="<?= $episode->podcast->cover->tiny_url ?>" alt="<?= $episode->podcast->title ?>" loading="lazy" />
                <div class="flex flex-col">
                    <span class="text-sm font-semibold leading-none"><?= $episode->podcast->title ?></span>
                    <span class="text-xs"><?= lang('Podcast.followers', [
                        'numberOfFollowers' => $podcast->actor->followers_count,
                    ]) ?></span>
                </div>
            </div>
        </a>
        <div class="inline-flex items-center self-end h-full px-2 gap-x-2">
            <?php if (in_array(true, array_column($podcast->fundingPlatforms, 'is_visible'), true)): ?>
                <button class="p-2 text-red-600 bg-white rounded-full shadow hover:text-red-500 focus:ring-accent" data-toggle="funding-links" data-toggle-class="hidden" title="<?= lang('Podcast.sponsor') ?>"><Icon glyph="heart"></Icon></button>
            <?php endif; ?>
            <?= anchor_popup(
                        route_to('follow', $podcast->handle),
                        icon(
                            'social/castopod',
                            'mr-2 text-xl text-black/75 group-hover:text-black',
                        ) . lang('Podcast.follow'),
                        [
                            'width' => 420,
                            'height' => 620,
                            'class' =>
                                'group inline-flex items-center px-3 leading-8 text-xs tracking-wider font-semibold text-black uppercase rounded-full shadow focus:ring-accent bg-white',
                        ],
                    ) ?>
        </div>
    </nav>
    <header class="relative z-50 flex flex-col col-start-2 px-8 pt-8 pb-4 overflow-hidden bg-accent-base/75 gap-y-4">
        <div class="absolute top-0 left-0 w-full h-full bg-center bg-no-repeat bg-cover blur-lg mix-blend-overlay filter grayscale" style="background-image: url('<?= $episode->podcast->banner->small_url ?>');"></div>
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-background-header to-transparent"></div>
        <div class="z-10 flex flex-col items-start gap-y-2 gap-x-4 sm:flex-row">
            <div class="relative">
                <?= explicit_badge($episode->parental_advisory === 'explicit', 'rounded absolute left-0 bottom-0 ml-2 mb-2 bg-black/75 text-accent-contrast') ?>
                <img src="<?= $episode->cover->medium_url ?>" alt="<?= $episode->title ?>" class="rounded-md shadow-xl h-36 aspect-square" loading="lazy" />
            </div>
            <div class="flex flex-col items-start text-white">
                <?= episode_numbering($episode->number, $episode->season_number, 'text-sm leading-none font-semibold px-1 py-1 text-white/90 border !no-underline border-subtle', true) ?>
                <h1 class="inline-flex items-baseline max-w-md mt-2 text-2xl font-bold sm:leading-none sm:text-3xl font-display line-clamp-2"><?= $episode->title ?></h1>
                <div class="flex items-center mt-4 gap-x-8">
                <?php if ($episode->persons !== []): ?>
                    <button class="flex items-center text-xs font-semibold gap-x-2 hover:underline focus:ring-accent" data-toggle="persons-list" data-toggle-class="hidden">
                        <div class="inline-flex flex-row-reverse">
                            <?php $i = 0; ?>
                            <?php foreach ($episode->persons as $person): ?>
                                <img src="<?= $person->avatar->thumbnail_url ?>" alt="<?= $person->full_name ?>" class="object-cover w-8 h-8 -ml-4 border-2 rounded-full aspect-square border-background-header last:ml-0" loading="lazy" />
                                <?php $i++; if ($i === 3) {
                        break;
                    }?>
                            <?php endforeach; ?>
                        </div>
                        <?= lang('Episode.persons', [
                            'personsCount' => count($episode->persons),
                        ]) ?>
                    </button>
                <?php endif; ?>
                <?php if ($episode->location): ?>
                    <?= location_link($episode->location, 'text-xs font-semibold p-2') ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="z-10 inline-flex items-center text-white gap-x-4">
            <play-episode-button
                id="<?= $episode->id ?>"
                imageSrc="<?= $episode->cover->thumbnail_url ?>"
                title="<?= $episode->title ?>"
                podcast="<?= $episode->podcast->title ?>"
                src="<?= $episode->audio_web_url ?>"
                mediaType="<?= $episode->audio->file_mimetype ?>"
                playLabel="<?= lang('Common.play_episode_button.play') ?>"
                playingLabel="<?= lang('Common.play_episode_button.playing') ?>"></play-episode-button>
            <div class="text-xs">
                <?= relative_time($episode->published_at) ?>
                <span class="mx-1">•</span>
                <time datetime="PT<?= $episode->audio->duration ?>S">
                    <?= format_duration_symbol($episode->audio->duration) ?>
                </time>
            </div>
        </div>
    </header>
    <div class="col-start-2 px-8 py-4 text-white bg-header">
        <h2 class="text-xs font-bold tracking-wider uppercase whitespace-pre-line font-display"><?= lang('Episode.description') ?></h2>
        <?php if (substr_count($episode->description_markdown, "\n") > 3 || strlen($episode->description) > 250): ?>
            <SeeMore class="max-w-xl prose-sm text-white"><?= $episode->getDescriptionHtml('-+Website+-') ?></SeeMore>
        <?php else: ?>
            <div class="max-w-xl prose-sm text-white"><?= $episode->getDescriptionHtml('-+Website+-') ?></div>
        <?php endif; ?>
    </div>
    <?= $this->include('episode/_partials/navigation') ?>
    <div class="relative grid items-start flex-1 col-start-2 grid-cols-podcastMain gap-x-6">
        <main class="w-full col-start-1 row-start-1 py-6 col-span-full md:col-span-1">
            <?= $this->renderSection('content') ?>
        </main>
        <div data-sidebar-toggler="backdrop" class="absolute top-0 left-0 z-10 hidden w-full h-full bg-backdrop/75 md:hidden" role="button" tabIndex="0" aria-label="Close"></div>
        <?= $this->include('podcast/_partials/sidebar') ?>
    </div>
    <?= view('_persons_modal', [
        'title' => lang('Episode.persons_list', [
            'episodeTitle' => $episode->title,
        ]),
        'persons' => $episode->
persons,
    ]) ?>
    <?php if (in_array(true, array_column($podcast->fundingPlatforms, 'is_visible'), true)): ?>
        <?= $this->include('podcast/_partials/funding_links_modal') ?>
    <?php endif; ?>
</body>
