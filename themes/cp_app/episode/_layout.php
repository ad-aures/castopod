<?= helper('page') ?>

<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />

    <?= $this->renderSection('meta-tags') ?>
    <?php if ($podcast->payment_pointer): ?>
        <meta name="monetization" content="<?= $podcast->payment_pointer ?>" />
    <?php endif; ?>

    <?= service('vite')
        ->asset('styles/index.css', 'css') ?>
    <?= service('vite')
        ->asset('js/app.ts', 'js') ?>
    <?= service('vite')
        ->asset('js/podcast.ts', 'js') ?>
    <?= service('vite')
        ->asset('js/audio-player.ts', 'js') ?>
</head>

<body class="grid items-start mx-auto grid-cols-podcast bg-pine-50">
    <?php if (can_user_interact()): ?>
        <div class="col-span-full">
            <?= $this->include('_admin_navbar') ?>
        </div>
    <?php endif; ?>

    <nav class="flex items-center justify-between h-10 col-start-2 text-white bg-pine-800">
        <a href="<?= route_to('podcast-episodes', $podcast->handle) ?>" class="inline-flex items-center h-full px-2 focus:ring-castopod focus:ring-inset" title="<?= lang('Episode.back_to_episodes', [
            'podcast' => $podcast->title,
        ]) ?>">
            <?= icon('arrow-left', 'mr-2 text-lg') ?>
            <div class="inline-flex items-center gap-x-2">
                <img class="w-8 h-8 rounded-full" src="<?= $episode->podcast->image->thumbnail_url ?>" alt="<?= $episode->podcast->title ?>" />
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
                <IconButton glyph="heart" variant="accent" data-toggle="funding-links" data-toggle-class="hidden"><?= lang('Podcast.sponsor') . lang('Podcast.sponsor_title') ?></IconButton>
            <?php endif; ?>
            <?= anchor_popup(
                        route_to('follow', $podcast->handle),
                        icon(
                            'social/castopod',
                            'mr-2 text-xl text-rose-200 group-hover:text-rose-50',
                        ) . lang('Podcast.follow'),
                        [
                            'width' => 420,
                            'height' => 620,
                            'class' =>
                                'group inline-flex items-center px-2 py-1 text-xs tracking-wider font-semibold text-white uppercase rounded-full shadow focus:ring-castopod bg-rose-600',
                        ],
                    ) ?>
        </div>
    </nav>
    <header class="relative z-50 flex flex-col col-start-2 px-8 pt-8 pb-4 overflow-hidden bg-pine-500 gap-y-4">
        <div class="absolute top-0 left-0 w-full h-full bg-center bg-no-repeat bg-cover blur-lg mix-blend-luminosity" style="background-image: url('<?= $episode->podcast->image->thumbnail_url ?>');"></div>
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-pine-800 to-transparent"></div>
        <div class="z-10 flex flex-col items-start gap-y-2 gap-x-4 sm:flex-row">
            <img src="<?= $episode->image->medium_url ?>" alt="<?= $episode->title ?>" loading="lazy" class="rounded-md h-36" />
            <div class="flex flex-col items-start text-white">
                <?= episode_numbering($episode->number, $episode->season_number, 'bg-pine-50 text-sm leading-none font-semibold text-gray-700 border !no-underline border-pine-100', true) ?>
                <h1 class="inline-flex items-baseline max-w-md mt-2 text-2xl font-bold leading-none sm:text-3xl font-display line-clamp-2"><?= $episode->title ?></h1>
                <div class="flex items-center mt-4 gap-x-8">
                <?php if ($episode->persons !== []): ?>
                    <button class="flex items-center text-xs font-semibold gap-x-2 hover:underline focus:ring-castopod" data-toggle="persons-list" data-toggle-class="hidden">
                        <div class="inline-flex flex-row-reverse">
                            <?php $i = 0; ?>
                            <?php foreach ($episode->persons as $person): ?>
                                <img src="<?= $person->image->thumbnail_url ?>" alt="<?= $person->full_name ?>" class="object-cover w-8 h-8 -ml-5 border-2 rounded-full border-pine-100 last:ml-0" />
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
                imageSrc="<?= $episode->image->thumbnail_url ?>"
                title="<?= $episode->title ?>"
                podcast="<?= $episode->podcast->title ?>"
                src="<?= $episode->audio_file_web_url ?>"
                mediaType="<?= $episode->audio_file_mimetype ?>"
                playLabel="<?= lang('Common.play_episode_button.play') ?>"
                playingLabel="<?= lang('Common.play_episode_button.playing') ?>"></play-episode-button>
            <div class="text-xs">
                <?= relative_time($episode->published_at) ?>
                <span class="mx-1">•</span>
                <time datetime="PT<?= $episode->audio_file_duration ?>S">
                    <?= format_duration_symbol($episode->audio_file_duration) ?>
                </time>
            </div>
        </div>
    </header>
    <div class="col-start-2 px-8 py-4 text-white bg-pine-800">
        <h2 class="text-xs font-bold tracking-wider uppercase whitespace-pre-line font-display"><?= lang('Episode.description') ?></h2>
        <?php if (substr_count($episode->description_markdown, "\n") > 3 || strlen($episode->description) > 250): ?>
            <SeeMore class="max-w-xl prose-sm text-white whitespace-pre-line"><?= $episode->getDescriptionHtml('-+Website+-') ?></SeeMore>
        <?php else: ?>
            <div class="max-w-xl prose-sm text-white whitespace-pre-line"><?= $episode->getDescriptionHtml('-+Website+-') ?></div>
        <?php endif; ?>
    </div>
    <?= $this->include('episode/_partials/navigation') ?>
    <div class="relative grid items-start col-start-2 pt-6 pb-4 grid-cols-podcastMain gap-x-6">
        <main class="w-full col-span-full md:col-span-1">
            <?= $this->renderSection('content') ?>
        </main>
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
