<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= esc($episode->title) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= esc($episode->title) ?>    
<?= $this->endSection() ?>

<?= $this->section('headerLeft') ?>
<?= publication_pill(
    $episode->published_at,
    $episode->publication_status,
    'text-sm ml-2 align-middle',
) ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php if ($episode->publication_status === 'published'): ?>
<IconButton
    uri="<?= route_to('episode-publish_date_edit', $podcast->id, $episode->id) ?>"
    glyph="history"
    variant="secondary"
    glyphClass="text-xl"
><?= lang('Episode.publish_date_edit') ?></IconButton>
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
    <Charts.XY title="<?= lang('Charts.episode_by_day') ?>" dataUrl="<?= route_to(
    'analytics-filtered-data',
    $podcast->id,
    'PodcastByEpisode',
    'ByDay',
    $episode->id,
) ?>"/>

    <Charts.XY title="<?= lang('Charts.episode_by_month') ?>" dataUrl="<?= route_to(
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
