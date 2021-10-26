<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="UTF-8" />
    <title><?= $episode->title ?></title>
    <meta name="description" content="<?= htmlspecialchars(
        $episode->description,
    ) ?>" />
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <?= service('vite')->asset('styles/index.css', 'css') ?>
    <link rel="canonical" href="<?= $episode->link ?>" />
</head>

<body class="flex w-full h-screen" style="background: <?= $theme[
    'background'
] ?>; color: <?= $theme['text'] ?>;">
    <img src="<?= $episode->image
        ->medium_url ?>" alt="<?= $episode->title ?>" class="flex-shrink h-full" />
    <div class="flex flex-col flex-1 min-w-0 p-4">
        <div class="flex items-center">
            <a href="<?= route_to(
                'podcast',
                $podcast->name,
            ) ?>" style="color: <?= $theme[
    'text'
] ?>;" class="mr-2 text-xs tracking-wider uppercase truncate opacity-75 hover:opacity-100" target="_blank">
                <?= $podcast->title ?>
            </a>
            <a href="https://castopod.org/" class="ml-auto text-xl text-pine-700 hover:opacity-75" title="<?= lang(
                'Common.powered_by',
                [
                    'castopod' => 'Castopod',
                ],
            ) ?>" target="_blank" rel="noopener noreferrer">
                <?= icon('podcasting/castopod') ?>
            </a>
        </div>
        <a href="<?= $episode->link ?>" class="flex items-center mb-2" style="color: <?= $theme[
    'text'
] ?>;" target="_blank">
            <h1 class="mr-2 text-lg font-semibold truncate opacity-100 hover:opacity-75">
                <?= $episode->title ?>
            </h1>
            <?= episode_numbering(
                $episode->number,
                $episode->season_number,
                'text-xs',
                true,
            ) ?>
        </a>
        <audio controls preload="none" class="flex w-full mt-auto">
            <source src="<?= $episode->audio_file_analytics_url .
                (isset($_SERVER['HTTP_REFERER'])
                    ? '?_from=' .
                        parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)
                    : '') ?>" type="<?= $episode->audio_file_mimetype ?>" />
            Your browser does not support the audio tag.
        </audio>
    </div>
</body>

</html>
