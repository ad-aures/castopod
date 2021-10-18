<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="UTF-8" />
    <title><?= $episode->title ?></title>
    <meta name="description" content="<?= htmlspecialchars(
        $episode->description,
    ) ?>" />
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <link rel="canonical" href="<?= $episode->link ?>" />
    <?= service('vite')
        ->asset('styles/index.css', 'css') ?>
    <?= service('vite')
        ->asset('js/embed.ts', 'js') ?>
</head>

<body class="flex w-full h-screen" style="background: <?= $themeData[
    'background'
] ?>; color: <?= $themeData['text'] ?>;">
    <img src="<?= $episode->image
    ->thumbnail_url ?>" alt="<?= $episode->title ?>" class="flex-shrink w-36 h-36" />
    <div class="flex flex-col items-start flex-1 min-w-0 px-4 py-2 h-36">
        <div class="flex items-center w-full">
            <a href="<?= route_to(
        'podcast-activity',
        $podcast->handle,
    ) ?>" style="color: <?= $themeData[
    'text'
] ?>;" class="mr-2 text-xs tracking-wider uppercase truncate opacity-75 hover:opacity-100" target="_blank">
                <?= $podcast->title ?>
            </a>
            <a href="https://castopod.org/" class="ml-auto text-3xl text-pine-500 hover:opacity-75" title="<?= lang(
    'Common.powered_by',
    [
        'castopod' => 'Castopod',
    ],
) ?>" target="_blank" rel="noopener noreferrer">
                <?= icon('podcasting/castopod') ?>
            </a>
        </div>
        <a href="<?= $episode->link ?>" class="flex items-center mb-2" style="color: <?= $themeData[
    'text'
] ?>;" target="_blank">
            <?= episode_numbering(
    $episode->number,
    $episode->season_number,
    'text-xs font-semibold text-gray-600 !no-underline border px-1 border-gray-500 mr-1',
    true,
) ?><h1 class="mr-2 text-lg font-semibold truncate opacity-100 hover:opacity-75">
<?= $episode->title ?>
</h1>
        </a>
        <vm-player
                id="castopod-vm-player"
                theme="<?= str_starts_with($theme, 'dark') ? 'dark' : 'light' ?>"
                language="${language}"
                icons="castopod-icons"
                class="w-full mt-auto"
                style="--vm-player-box-shadow:0; --vm-player-theme: #009486; --vm-control-spacing: 4px; --vm-control-icon-size: 24px; <?= str_ends_with($theme, 'transparent') ? '--vm-controls-bg: transparent;' : '' ?>"
            >
            <vm-audio preload="none">
                <?php $source = logged_in() ? $episode->audio_file_url : $episode->audio_file_analytics_url .
                    (isset($_SERVER['HTTP_REFERER'])
                        ? '?_from=' .
                            parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)
                        : '') ?>
                <source src="<?= $source ?>" type="<?= $episode->audio_file_mimetype ?>" />
            </vm-audio>
            <vm-ui>
                <vm-icon-library name="castopod-icons"></vm-icon-library>
                <vm-controls full-width>
                    <vm-playback-control></vm-playback-control>
                    <vm-volume-control></vm-volume-control>
                    <vm-current-time></vm-current-time>
                    <vm-scrubber-control></vm-scrubber-control>
                    <vm-end-time></vm-end-time>
                </vm-controls>
            </vm-ui>
        </vm-player>
    </div>
</body>

</html>
