<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>

<?= lang('Episode.all_podcast_episodes') ?> (<?= count($podcast->episodes) ?>)

<?= $this->endSection() ?>


<?= $this->section('content') ?>

<a class="inline-block px-4 py-2 mb-2 border hover:bg-gray-100" href="<?= route_to(
    'episode_create',
    $podcast->id
) ?>"><?= lang('Episode.create') ?></a>

<?= view('admin/_partials/_episode-list.php', [
    'episodes' => $podcast->episodes,
]) ?>

<?= $this->endSection()
?>
