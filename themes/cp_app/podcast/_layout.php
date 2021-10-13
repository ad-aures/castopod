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

<body class="grid items-start mx-auto grid-cols-podcastLayout bg-pine-50">
    <?php if (can_user_interact()): ?>
        <div class="col-span-full">
            <?= $this->include('_admin_navbar') ?>
        </div>
    <?php endif; ?>

    <header class="z-50 flex flex-col-reverse justify-between w-full col-start-2 bg-top bg-no-repeat bg-cover sm:flex-row sm:items-end bg-pine-800" style="background-image: url('<?= $podcast->actor->cover_image_url ?>'); aspect-ratio: 15 / 5;">
        <div class="flex items-center pl-4 -mb-6 md:pl-8 md:-mb-8 gap-x-4">
            <img src="<?= $podcast->image->thumbnail_url ?>" alt="<?= $podcast->title ?>" loading="lazy" class="h-24 rounded-full md:h-28 ring-4 ring-white" />
            <div class="relative flex flex-col text-white -top-2">
                <h1 class="text-lg font-bold leading-none line-clamp-2 md:leading-none md:text-2xl font-display"><?= $podcast->title ?><span class="ml-1 font-sans text-base font-normal">@<?= $podcast->handle ?></span></h1>
                <span class="text-xs"><?= lang('Podcast.followers', [
                    'numberOfFollowers' => $podcast->actor->followers_count,
                ]) ?></span>
            </div>
        </div>
        <div class="inline-flex items-center self-end mt-2 mb-2 mr-2 gap-x-2">
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
                            'group inline-flex items-center px-2 py-1 text-xs tracking-wider font-semibold text-white uppercase rounded-full shadow focus:outline-none focus:ring bg-rose-600',
                    ],
                ) ?>
        </div>
    </header>
    <?= $this->include('podcast/_partials/navigation') ?>
    <div class="grid items-start grid-cols-3 col-start-2 pb-12 mt-6 gap-x-6">
        <main class="col-span-full sm:col-span-2">
            <?= $this->renderSection('content') ?>
        </main>
        <?= $this->include('podcast/_partials/sidebar') ?>
    </div>

    <?php if (in_array(true, array_column($podcast->fundingPlatforms, 'is_visible'), true)): ?>
        <?= $this->include('podcast/_partials/funding_links_modal') ?>
    <?php endif; ?>

</body>
