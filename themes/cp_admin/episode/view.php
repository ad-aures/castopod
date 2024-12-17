<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= esc($episode->title) ?>    
<?= $this->endSection() ?>

<?= $this->section('headerLeft') ?>
<?= publication_pill(
    $episode->published_at,
    $episode->publication_status,
    'text-sm align-middle',
) ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php if ($episode->publication_status === 'published'): ?>
<?php // @icon("history-fill")?>
<x-IconButton
    uri="<?= route_to('episode-publish_date_edit', $podcast->id, $episode->id) ?>"
    glyph="history-fill"
    variant="secondary"
    glyphClass="text-xl"
><?= lang('Episode.publish_date_edit') ?></x-IconButton>
<?php endif; ?>
<?= publication_button(
    $podcast->id,
    $episode->id,
    $episode->publication_status,
) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="mb-12">
    <?= audio_player($episode->audio->file_url, $episode->audio->file_mimetype) ?>
</div>

<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <x-Charts.XY title="<?= lang('Charts.episode_by_day') ?>" dataUrl="<?= route_to(
        'analytics-filtered-data',
        $podcast->id,
        'PodcastByEpisode',
        'ByDay',
        $episode->id,
    ) ?>"/>

    <x-Charts.XY title="<?= lang('Charts.episode_by_month') ?>" dataUrl="<?= route_to(
        'analytics-filtered-data',
        $podcast->id,
        'PodcastByEpisode',
        'ByMonth',
        $episode->id,
    ) ?>"/>
</div>


<?= service('vite')
        ->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
