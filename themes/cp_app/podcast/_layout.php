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
    <link rel="manifest" href="<?= route_to('podcast-webmanifest', esc($podcast->handle)) ?>">
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

    <header class="min-h-[200px] relative z-50 flex flex-col-reverse justify-between w-full gap-x-2 col-start-2 bg-top bg-no-repeat bg-cover sm:flex-row sm:items-end bg-header aspect-[3/1]" style="background-image: url('<?= $podcast->banner->medium_url ?>');">
        <div class="absolute bottom-0 left-0 w-full h-full backdrop-gradient mix-blend-multiply"></div>
        <div class="z-10 flex items-center pl-4 -mb-6 md:pl-8 md:-mb-8 gap-x-4">
            <img src="<?= $podcast->cover->thumbnail_url ?>" alt="<?= esc($podcast->title) ?>" class="h-24 rounded-full sm:h-28 md:h-36 ring-3 ring-background-elevated aspect-square" loading="lazy" />
            <div class="relative flex flex-col text-white -top-3 sm:top-0 md:top-2">
                <h1 class="text-lg font-bold leading-none line-clamp-2 md:leading-none md:text-2xl font-display"><?= esc($podcast->title) ?><span class="ml-1 font-sans text-base font-normal">@<?= esc($podcast->handle) ?></span></h1>
                <div class="">
                    <?= explicit_badge($podcast->parental_advisory === 'explicit', 'mr-1') ?>
                    <span class="text-xs"><?= lang('Podcast.followers', [
                        'numberOfFollowers' => $podcast->actor->followers_count,
                    ]) ?></span>
                </div>
            </div>
        </div>
        <div class="z-10 inline-flex items-center self-end mt-2 mr-2 sm:mb-4 sm:mr-4 gap-x-2">
            <?php if (in_array(true, array_column($podcast->fundingPlatforms, 'is_visible'), true)): ?>
                <button class="inline-flex items-center px-4 text-xs font-semibold leading-8 tracking-wider text-red-600 uppercase bg-white rounded-full shadow hover:text-red-500 focus:ring-accent" data-toggle="funding-links" data-toggle-class="hidden"><Icon glyph="heart" class="mr-2 text-sm"></Icon><?= lang('Podcast.sponsor') ?></button>
            <?php endif; ?>
            <?= anchor_popup(
                        route_to('follow', esc($podcast->handle)),
                        icon(
                            'social/castopod',
                            'mr-2 text-xl text-black/75 group-hover:text-black',
                        ) . lang('Podcast.follow'),
                        [
                            'width' => 420,
                            'height' => 620,
                            'class' =>
                                'group inline-flex items-center px-4 text-xs tracking-wider font-semibold text-black uppercase rounded-full leading-8 shadow focus:ring-accent bg-white',
                        ],
                    ) ?>
        </div>
    </header>
    <?= $this->include('podcast/_partials/navigation') ?>
    <?= $this->include('podcast/_partials/premium_banner') ?>
    <div class="relative grid items-start flex-1 col-start-2 grid-cols-podcastMain gap-x-6">
        <main class="w-full max-w-xl col-start-1 row-start-1 py-6 mx-auto col-span-full md:col-span-1">
            <?= $this->renderSection('content') ?>
        </main>
        <?= $this->include('podcast/_partials/sidebar') ?>
    </div>

    <?php if (in_array(true, array_column($podcast->fundingPlatforms, 'is_visible'), true)): ?>
        <?= $this->include('podcast/_partials/funding_links_modal') ?>
    <?php endif; ?>

</body>
