<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= esc($episode->title) ?></title>
    <meta name="description" content="<?= esc(
        $episode->description,
    ) ?>" />
    <link rel="icon" type="image/x-icon" href="<?= get_site_icon_url('ico') ?>" />
    <link rel="apple-touch-icon" href="<?= get_site_icon_url('180') ?>">
    <link rel='stylesheet' type='text/css' href='<?= route_to('themes-colors-css') ?>' />
    <?= service('vite')
        ->asset('styles/index.css', 'css') ?>
    <?= service('vite')
        ->asset('js/embed.ts', 'js') ?>
</head>

<body class="flex theme-<?= service('settings')
        ->get('App.theme') ?>" style="background: <?= $themeData['background'] ?>; color: <?= $themeData['text'] ?>;">
    <img src="<?= $episode->cover->thumbnail_url ?>" alt="<?= esc($episode->title) ?>" class="flex-shrink w-28 h-28 aspect-square" loading="lazy" />
    <div class="flex flex-col items-start flex-1 min-w-0 px-4 pt-4 h-28">
        <a href="https://castopod.org/" class="absolute top-0 right-0 mt-1 mr-2 text-2xl text-pine-500 hover:opacity-75" title="<?= lang('Common.powered_by', [
            'castopod' => 'Castopod',
        ]) ?>" target="_blank" rel="noopener noreferrer"><?= icon('podcasting:castopod') ?></a>
        <div class="flex gap-x-2">
            <?= episode_numbering($episode->number, $episode->season_number, 'text-xs font-semibold !no-underline border px-1 border-gray-500', true) ?>
            <a href="<?= route_to('podcast-activity', esc($podcast->handle)) ?>" style="color: <?= $themeData['text'] ?>;" class="text-xs truncate opacity-75 hover:opacity-100" target="_blank" rel="noopener noreferrer"><?= esc($podcast->title) ?></a>
        </div>
        <a href="<?= $episode->link ?>" class="flex flex-col items-start text-sm" style="color: <?= $themeData['text'] ?>;" target="_blank" rel="noopener noreferrer">
            <h1 class="font-semibold leading-tight opacity-100 line-clamp-2 hover:opacity-75"><?= esc($episode->title) ?></h1>
        </a>
        <?php if ($episode->is_premium && ! is_unlocked($podcast->handle)): ?>
            <?php // @icon("lock-fill")?>
            <x-Button variant="primary" class="mt-auto mb-2" iconLeft="lock-fill" uri="<?= $episode->link ?>" target="_blank" rel="noopener noreferrer"><?= lang('PremiumPodcasts.unlock') ?></x-Button>
        <?php else: ?>
        <vm-player
                id="castopod-vm-player"
                theme="<?= str_starts_with($theme, 'dark') ? 'dark' : 'light' ?>"
                language="<?= service('request')->getLocale() ?>"
                class="w-full mt-auto"
                icons="castopod-vm-player-icons"
                style="--vm-player-box-shadow:0; --vm-player-theme: hsl(var(--color-accent-base)); --vm-control-focus-color: hsl(var(--color-accent-contrast)); --vm-control-spacing: 4px; --vm-menu-item-focus-bg: hsl(var(--color-background-highlight)); --vm-control-icon-size: 24px; <?= str_ends_with($theme, 'transparent') ? '--vm-controls-bg: transparent;' : '' ?>"
            >
            <vm-audio preload="none">
                <?php
                $superglobals = service('superglobals');
            $source = auth()->loggedIn() ? $episode->audio_url : $episode->audio_url .
                ($superglobals->server('HTTP_REFERER') === null
                    ? '?_from=' .
                        parse_url($superglobals->server('HTTP_REFERER'), PHP_URL_HOST)
                    : '') ?>
                <source src="<?= $source ?>" type="<?= $episode->audio->file_mimetype ?>" />
            </vm-audio>
            <vm-ui>
                <vm-icon-library name="castopod-vm-player-icons"></vm-icon-library>
                <vm-controls full-width>
                    <vm-playback-control></vm-playback-control>
                    <vm-volume-control></vm-volume-control>
                    <vm-current-time></vm-current-time>
                    <vm-scrubber-control></vm-scrubber-control>
                    <vm-end-time></vm-end-time>
                </vm-controls>
            </vm-ui>
        </vm-player>
        <?php endif; ?>
    </div>
</body>

</html>
