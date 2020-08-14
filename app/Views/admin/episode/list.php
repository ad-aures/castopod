<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>

<?= lang('Episode.all_podcast_episodes') ?> (<?= count($podcast->episodes) ?>)
<a class="inline-flex items-center px-2 py-1 mb-2 ml-2 text-sm text-white bg-green-500 rounded shadow-xs outline-none hover:bg-green-600 focus:shadow-outline" href="<?= route_to(
    'episode-create',
    $podcast->id
) ?>">
<?= icon('add', 'mr-2') ?>
<?= lang('Episode.create') ?></a>

<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= view('admin/_partials/_episode-list.php', [
    'episodes' => $podcast->episodes,
]) ?>

<?= $this->endSection()
?>
