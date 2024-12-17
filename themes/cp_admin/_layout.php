<?php declare(strict_types=1);

$isPodcastArea = isset($podcast) && ! isset($episode);
$isEpisodeArea = isset($podcast) && isset($episode);
?>

<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<?=
service('html_head')
    ->appendRawContent(service('vite')->asset('styles/index.css', 'css'))
    ->appendRawContent(service('vite')->asset('js/admin.ts', 'js'))
    ->appendRawContent(service('vite')->asset('js/admin-audio-player.ts', 'js'))
?>

<body class="relative grid items-start min-h-screen bg-base grid-cols-admin grid-rows-admin">
    <?= $this->include('_partials/_nav_header') ?>
    <?= $this->include('_partials/_nav_aside') ?>
    <main class="relative max-w-full col-start-1 row-start-2 col-span-full md:col-start-2 md:col-span-1">
        <header class="z-40 flex flex-col items-start justify-center px-4 border-b bg-elevated md:px-12 sticky-header-outer border-subtle">
            <div class="flex flex-col justify-end w-full -mt-4 sticky-header-inner bg-elevated">
                <?= render_breadcrumb('text-xs items-center flex') ?>
                <div class="flex justify-between py-1">
                    <div class="flex flex-wrap items-center truncate gap-x-2">
                    <?php if (($isEpisodeArea && $episode->is_premium) || ($isPodcastArea && $podcast->is_premium)): ?>
                        <div class="inline-flex items-center">
                            <?php // @icon("exchange-dollar-fill")?>
                            <x-IconButton uri="<?= route_to('subscription-list', $podcast->id) ?>" glyph="exchange-dollar-fill" variant="secondary" size="large" class="p-0 mr-2 border-0"><?= ($isEpisodeArea && $episode->is_premium) ? lang('PremiumPodcasts.episode_is_premium') : lang('PremiumPodcasts.podcast_is_premium') ?></x-IconButton>
                            <x-Heading tagName="h1" size="large" class="max-w-sm truncate"><?= $this->renderSection('pageTitle') ?></x-Heading>
                        </div>
                    <?php else: ?>
                            <x-Heading tagName="h1" size="large" class="max-w-lg truncate"><?= $this->renderSection('pageTitle') ?></x-Heading>
                    <?php endif; ?>
                        <?= $this->renderSection('headerLeft') ?>
                    </div>
                    <div class="flex items-center flex-shrink-0 gap-x-2"><?= $this->renderSection('headerRight') ?></div>
                </div>
            </div>
            <?= $this->renderSection('subtitle') ?>
        </header>
        <?php if ($isPodcastArea): ?>
            <?php if (service('settings')->get('Import.current') === $podcast->handle): ?>
                <div class="flex items-center px-12 py-2 border-b bg-stripes-warning border-subtle" role="alert">
                    <p class="flex items-center text-gray-900">
                        <span class="inline-flex items-center gap-1 text-xs font-semibold tracking-wide uppercase"><?= icon('import-fill', [
                            'class' => 'text-base text-yellow-900',
                        ]) . lang('PodcastImport.banner.disclaimer') ?></span>
                        <span class="ml-3 text-sm"><?= lang('PodcastImport.banner.text', [
                            'podcastTitle' => $podcast->title,
                        ]) ?></span>
                    </p>
                    <a href="<?= route_to('podcast-imports', $podcast->id) ?>" class="ml-1 text-sm font-semibold underline shadow-xs text-accent-base hover:text-accent-hover hover:no-underline"><?= lang('PodcastImport.banner.cta') ?></a>
                </div>
            <?php endif; ?>
            <?php if ($podcast->publication_status !== 'published'): ?>
                <?= publication_status_banner($podcast->published_at, $podcast->id, $podcast->publication_status) ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($isEpisodeArea && $episode->publication_status !== 'published'): ?>
            <?= episode_publication_status_banner($episode, 'border-b') ?>
        <?php endif; ?>
        <div class="px-2 py-8 mx-auto md:px-12">
            <?= view('_message_block') ?>
            <?= $this->renderSection('content') ?>
        </div>
    </main>
</body>