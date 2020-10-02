<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= button(
    lang('Podcast.edit'),
    route_to('podcast-edit', $podcast->id),
    ['variant' => 'secondary', 'iconLeft' => 'edit'],
    ['class' => 'mr-2']
) ?>
<?= button(lang('Episode.create'), route_to('episode-create', $podcast->id), [
    'variant' => 'primary',
    'iconLeft' => 'add',
]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= view_cell('\App\Controllers\Admin\Podcast::latestEpisodes', [
    'limit' => 5,
]) ?>

<?= $this->endSection() ?>
