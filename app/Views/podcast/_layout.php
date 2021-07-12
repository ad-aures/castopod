<?= helper('page') ?>

<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />

    <?= $this->renderSection('meta-tags') ?>
    <?php if ($podcast->payment_pointer): ?>
        <meta name="monetization" content="<?= $podcast->payment_pointer ?>" />
    <?php endif; ?>

    <?= service('vite')->asset('styles/index.css', 'css') ?>
    <?= service('vite')->asset('js/podcast.ts', 'js') ?>
</head>

<body class="flex w-full min-h-screen pb-20 overflow-x-hidden lg:mx-auto lg:container bg-pine-50 sm:pb-0">
    <?= $this->include('podcast/_partials/header') ?>

    <main class="flex-shrink-0 w-full min-w-0 sm:w-auto sm:flex-1 sm:flex-shrink">
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('podcast/_partials/sidebar') ?>
    <nav class="fixed bottom-0 left-0 z-50 flex items-center w-full px-4 py-4 sm:hidden">
        <div class="flex items-center w-full p-2 rounded-full shadow-2xl bg-pine-900">
            <button
            data-toggle="main-header"
            data-toggle-class="sticky -translate-x-full"
            class="flex-shrink-0 mr-3 overflow-hidden rounded-full focus:ring-2 focus:outline-none focus:ring-pine-50">
            <img src="<?= $podcast->image
                ->thumbnail_url ?>" alt="<?= $podcast->title ?>" class="h-14"/>
            </button>
            <p class="flex flex-col flex-1 min-w-0 mr-2 text-white">
                <span class="text-sm font-semibold truncate"><?= $podcast->title ?></span>
                <span class="text-xs">@<?= $podcast->name ?></span>
            </p>
            <?= anchor_popup(
                route_to('follow', $podcast->name),
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
            <button
            data-toggle="main-sidebar"
            data-toggle-class="translate-x-full"
            data-toggle-body-class="-ml-64"
            class="p-4 text-xl rounded-full focus:outline-none focus:ring-2 focus:ring-pine-600 text-pine-200 hover:text-pine-50"><?= icon(
                'menu',
            ) ?><span class="sr-only"><?= lang(
    'Podcast.toggle_podcast_sidebar',
) ?></span></button>
        </div>
    </nav>

    <button
    data-toggle="main-sidebar"
    data-toggle-class="translate-x-full"
    data-toggle-body-class="-ml-64"
    class="fixed z-40 hidden p-4 text-xl rounded-full shadow-2xl sm:block lg:hidden bottom-4 left-4 bg-pine-900 focus:outline-none focus:ring-2 focus:ring-pine-600 text-pine-200 hover:text-pine-50"><?= icon(
        'menu',
    ) ?><span class="sr-only"><?= lang(
    'Podcast.toggle_podcast_sidebar',
) ?></span></button>

    <!-- Funding links modal -->
    <div id="funding-links" class="fixed top-0 left-0 z-50 flex items-center justify-center hidden w-screen h-screen">
        <div
        class="absolute w-full h-full bg-pine-900 bg-opacity-90"
        role="button"
        data-toggle="funding-links"
        data-toggle-class="hidden"
        aria-label="<?= lang('Common.close') ?>"></div>
        <div class="z-10 w-full max-w-xl bg-white rounded-lg shadow-2xl">
            <div class="flex justify-between px-4 py-2 border-b">
                <h3 class="self-center text-lg"><?= lang(
                    'Podcast.funding_links',
                    ['podcastTitle' => $podcast->title],
                ) ?></h3>
                <button
                data-toggle="funding-links"
                data-toggle-class="hidden"
                aria-label="<?= lang('Common.close') ?>"
                class="self-start p-1 text-2xl"><?= icon('close') ?></button>
            </div>
            <div class="flex flex-col items-start p-4 space-y-4">
                <?php foreach (
                    $podcast->fundingPlatforms
                    as $fundingPlatform
                ): ?>
                    <?php if ($fundingPlatform->is_visible): ?>
                        <a
                        href="<?= $fundingPlatform->link_url ?>"
                        title="<?= $fundingPlatform->link_content ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center font-semibold text-pine-900">
                        <?= icon(
                            $fundingPlatform->type .
                                '/' .
                                $fundingPlatform->slug,
                            'mr-2',
                        ) . $fundingPlatform->link_url ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
