<?= helper('page') ?>

<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="<?= service('settings')
    ->get('App.siteIcon')['ico'] ?>" />
    <link rel="apple-touch-icon" href="<?= service('settings')->get('App.siteIcon')['180'] ?>">
    <link rel="manifest" href="<?= route_to('podcast-webmanifest', esc($actor->podcast->handle)) ?>">
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
        ->asset('js/podcast.ts', 'js') ?>
</head>

<body class="flex flex-col min-h-screen bg-base theme-<?= service('settings')
        ->get('App.theme') ?>">
    <header class="flex flex-col items-center mb-8">
        <h1 class="w-full pt-8 pb-32 text-lg font-semibold text-center text-white bg-header"><?= lang(
            'Fediverse.follow.subtitle',
        ) ?></h1>
        <div class="flex flex-col w-full max-w-xs -mt-24 overflow-hidden shadow bg-elevated rounded-xl">
            <img src="<?= $actor->podcast->banner->small_url ?>" alt="" class="w-full aspect-[3/1] bg-header" loading="lazy" />
            <div class="flex px-4 py-2">
                <img src="<?= $actor->avatar_image_url ?>" alt="<?= esc($actor->display_name) ?>"
                    class="w-16 h-16 mr-4 -mt-8 rounded-full ring-2 ring-background-elevated aspect-square" loading="lazy" />
                <div class="flex flex-col">
                    <p class="font-semibold"><?= esc($actor->display_name) ?></p>
                    <p class="text-sm text-skin-muted">@<?= esc($actor->username) ?></p>
                </div>
            </div>
        </div>
    </header>

    <main class="w-full max-w-md px-4 mx-auto">
        <form action="<?= route_to('attempt-follow', esc($actor->username)) ?>" method="POST" class="flex flex-col gap-y-2">
            <?= csrf_field() ?>
            <?= view('_message_block') ?>

            <Forms.Field
                name="handle"
                label="<?= lang('Fediverse.your_handle') ?>"
                hint="<?= lang('Fediverse.your_handle_hint') ?>"
                required="true"
            />
            <Button variant="primary" type="submit" class="self-end" iconRight="send-plane"><?= lang('Fediverse.follow.submit') ?></Button>
        </form>
    </main>

    <footer
        class="flex-col w-full px-2 py-4 mt-auto text-xs text-center border-t text-skin-muted border-subtle">
        <?= lang('Common.powered_by', [
            'castopod' =>
                '<a class="inline-flex font-semibold hover:underline focus:ring-accent" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod' . icon('castopod', 'ml-1 text-lg', 'social') . '</a>',
        ], null, false) ?>
    </footer>
</body>
