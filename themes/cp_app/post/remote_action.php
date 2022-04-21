<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/x-icon" href="<?= service('settings')
    ->get('App.siteIcon')['ico'] ?>" />
    <link rel="apple-touch-icon" href="<?= service('settings')->get('App.siteIcon')['180'] ?>">
    <link rel="manifest" href="<?= route_to('podcast-webmanifest', esc($post->actor->podcast->handle)) ?>">
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

<body class="flex flex-col min-h-screen mx-auto bg-base theme-<?= service('settings')
        ->get('App.theme') ?>">
    <header class="pt-8 pb-32 bg-header">
        <h1 class="text-lg font-semibold text-center text-white"><?= lang(
            'Fediverse.' . $action . '.subtitle',
        ) ?></h1>
    </header>
    <main class="flex-1 max-w-xl px-4 pb-8 mx-auto -mt-24">
        <?= view('post/_partials/card', [
            'index' => 1,
            'podcast' => $podcast,
            'post' => $post,
        ]) ?>

        <form action="<?= route_to('post-attempt-remote-action', $post->id, $action) ?>" method="POST" class="flex flex-col mt-8 gap-y-2">
            <?= csrf_field() ?>
            <?= view('_message_block') ?>

            <Forms.Field
                name="handle"
                label="<?= lang('Fediverse.your_handle') ?>"
                hint="<?= lang('Fediverse.your_handle_hint') ?>"
                required="true" />

            <Button variant="primary" type="submit" class="self-end" iconRight="send-plane"><?= lang('Fediverse.' . $action . '.submit') ?></Button>
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
