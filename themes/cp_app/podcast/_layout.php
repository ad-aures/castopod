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
        ->asset('js/podcast.ts', 'js') ?>
    <?= service('vite')
        ->asset('js/audio-player.ts', 'js') ?>
</head>

<body class="grid items-start w-1/2 grid-cols-9 mx-auto bg-pine-50 gap-y-8 gap-x-6">
    <header class="sticky z-50 flex flex-col bg-white shadow -top-96 rounded-b-xl col-span-full">
        <div style="background-image: url('<?= $podcast->actor->cover_image_url ?>'); background-size: auto 320px;" class="w-full bg-fixed bg-top bg-no-repeat bg-cover bg-pine-800 h-80"></div>
        <div class="flex items-center justify-between py-4 ml-8 -mt-28">
            <div class="flex items-center gap-x-4">
                <img src="<?= $podcast->image->thumbnail_url ?>" alt="<?= $podcast->title ?>" loading="lazy" class="rounded-full h-36 ring-4 ring-white" />
                <div class="flex flex-col -mt-4 text-white">
                    <h1 class="inline-flex items-center text-2xl font-bold leading-none font-display"><?= $podcast->title . ($podcast->parental_advisory === 'explicit' ? '<span class="px-1 ml-2 text-xs font-semibold leading-tight tracking-wider text-gray-600 uppercase border-2 border-gray-500">' . lang('Common.explicit') . '</span>' : '') ?></h1>
                    <a href="#" class="hover:underline"><?= lang('Podcast.followers', [
                        'numberOfFollowers' => $podcast->actor->followers_count,
                    ]) ?></a>
                </div>
            </div>

            <div class="inline-flex items-center mr-4 -mt-4 gap-x-2">
                <?php if (in_array(true, array_column($podcast->fundingPlatforms, 'is_visible'), true)): ?>
                    <IconButton glyph="heart" data-toggle="funding-links" data-toggle-class="hidden"><?= lang('Podcast.sponsor') . lang('Podcast.sponsor_title') ?></IconButton>
                <?php endif; ?>
                <?= anchor_popup(
                        route_to('follow', $podcast->handle),
                        icon(
                            'social/castopod',
                            'mr-2 text-xl text-pink-200 group-hover:text-pink-50',
                        ) . lang('Podcast.follow'),
                        [
                            'width' => 420,
                            'height' => 620,
                            'class' =>
                                'group inline-flex items-center px-4 py-2 text-xs tracking-wider font-semibold text-white uppercase rounded-full shadow focus:outline-none focus:ring bg-rose-600',
                        ],
                    ) ?>
            </div>
        </div>
        <nav class="flex gap-4 px-8">
            <a href="<?= route_to('podcast-activity', $podcast->handle) ?>" class="px-4 py-1 font-semibold uppercase border-b-4 text-pine-500 border-pine-500"><?= lang('Podcast.activity') ?></a>
            <a href="<?= route_to('podcast-episodes', $podcast->handle) ?>" class="px-4 py-1 font-semibold text-gray-500 uppercase hover:text-black"><?= lang('Podcast.episodes') ?></a>
            <a href="<?= route_to('podcast-about', $podcast->handle) ?>" class="px-4 py-1 font-semibold text-gray-500 uppercase hover:text-black"><?= lang('Podcast.about') ?></a>
        </nav>
    </header>
    
    <main class="col-span-6">
        <?= $this->renderSection('content') ?>
    </main>

    <aside class="sticky col-span-3 top-12">
        <?php if (
            in_array(true, array_column($podcast->socialPlatforms, 'is_visible'), true)
        ): ?>
        <h2 class="font-semibold"> <?= lang('Podcast.find_on', [
            'podcastTitle' => $podcast->title,
        ]) ?></h2>
        <div class="grid items-center justify-center grid-cols-6 gap-3 mt-2">
        <?php foreach ($podcast->socialPlatforms as $socialPlatform): ?>
            <?php if ($socialPlatform->is_visible): ?>
                <?= anchor(
            $socialPlatform->link_url,
            icon("{$socialPlatform->type}/{$socialPlatform->slug}"),
            [
                'class' => 'text-2xl text-gray-500 hover:text-gray-700 w-8 h-8 items-center inline-flex justify-center',
                'target' => '_blank',
                'rel' => 'noopener noreferrer',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => $socialPlatform->label,
            ],
        ) ?>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <h2 class="mt-6 font-semibold"><?= lang('Podcast.listen_on') ?></h2>
        <div class="grid items-center justify-center grid-cols-6 gap-3 mt-2">
            <?= anchor(route_to('podcast_feed', $podcast->handle), icon('rss'), [
                'class' =>
                    'bg-orange-500 text-xl text-white hover:bg-orange-700 w-8 h-8 inline-flex items-center justify-center rounded-lg',
                'target' => '_blank',
                'rel' => 'noopener noreferrer',
                'data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => lang('Podcast.feed'),
            ]) ?>
            <?php foreach ($podcast->podcastingPlatforms as $podcastingPlatform): ?>
                <?php if ($podcastingPlatform->is_visible): ?>
                    <?= anchor(
                $podcastingPlatform->link_url,
                icon(
                    "{$podcastingPlatform->type}/{$podcastingPlatform->slug}",
                ),
                [
                    'class' => 'text-2xl text-gray-500 hover:text-gray-700 w-8 h-8 items-center inline-flex justify-center',
                    'target' => '_blank',
                    'rel' => 'noopener noreferrer',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'bottom',
                    'title' => $podcastingPlatform->label,
                ],
            ) ?>
                <?php endif; ?>
        <?php endforeach; ?>
        </div>
        <footer class="flex flex-col items-center py-2 mt-8 text-xs text-center text-gray-600 border-t">
                <?= render_page_links('inline-flex mb-2 flex-wrap gap-y-1') ?>
                <div class="flex flex-col">
                    <p><?= $podcast->copyright ?></p>
                    <p><?= lang('Common.powered_by', [
                        'castopod' =>
                            '<a class="inline-flex font-semibold hover:underline" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod' . icon('social/castopod', 'ml-1 text-lg') . '</a>',
                    ]) ?></p>
                </div>
        </footer>
    </aside>
</body>
