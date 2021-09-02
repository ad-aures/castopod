<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('headerLeft') ?>
<?= location_link($podcast->location, 'ml-4 text-sm') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= button(
    lang('Podcast.edit'),
    route_to('podcast-edit', $podcast->id),
    ['variant' => 'primary', 'iconLeft' => 'edit'],
    ['class' => 'mr-2'],
) ?>
<?= button(lang('Episode.create'), route_to('episode-create', $podcast->id), [
    'variant' => 'accent',
    'iconLeft' => 'add',
]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= view_cell('Modules\Admin\Controllers\PodcastController::latestEpisodes', [
    'limit' => 5,
    'podcastId' => $podcast->id,
]) ?>

<?= $this->endSection() ?>
