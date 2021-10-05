<?= $this->extend('podcast/_layout_authenticated') ?>

<?= $this->section('meta-tags') ?>
<link type="application/rss+xml" rel="alternate" title="<?= $podcast->title ?>" href="<?= $podcast->feed_url ?>" />

<title><?= $podcast->title ?></title>
<meta name="description" content="<?= htmlspecialchars(
    $podcast->description,
) ?>" />
<link rel="shortcut icon" type="image/png" href="/favicon.ico" />
<link rel="canonical" href="<?= current_url() ?>" />
<meta property="og:title" content="<?= $podcast->title ?>" />
<meta property="og:description" content="<?= $podcast->description ?>" />
<meta property="og:locale" content="<?= $podcast->language_code ?>" />
<meta property="og:site_name" content="<?= $podcast->title ?>" />
<meta property="og:url" content="<?= current_url() ?>" />
<meta property="og:image" content="<?= $podcast->image->large_url ?>" />
<meta property="og:image:width" content="<?= config('Images')
    ->largeSize ?>" />
<meta property="og:image:height" content="<?= config('Images')
    ->largeSize ?>" />
<meta name="twitter:card" content="summary_large_image" />

<?= service('vite')
    ->asset('styles/index.css', 'css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('podcast/_navigation') ?>

<section class="flex flex-col max-w-2xl px-6 py-8 mx-auto">

    <?php if ($episodes) : ?>
        <h1 class="mb-4 text-xl font-semibold">
            <?php if ($activeQuery['type'] === 'year') : ?>
                <?= lang('Podcast.list_of_episodes_year', [
    'year' => $activeQuery['value'],
                    'episodeCount' => count($episodes),
]) ?>
            <?php elseif ($activeQuery['type'] === 'season') : ?>
                <?= lang('Podcast.list_of_episodes_season', [
    'seasonNumber' => $activeQuery['value'],
                    'episodeCount' => count($episodes),
]) ?>
            <?php endif; ?>
        </h1>
        <?php foreach ($episodes as $episode) : ?>
            <?= view('podcast/_partials/episode_card', [
    'episode' => $episode,
                'podcast' => $podcast,
]) ?>
        <?php endforeach; ?>
    <?php else : ?>
        <h1 class="px-4 mb-2 text-xl text-center"><?= lang(
    'Podcast.no_episode',
) ?></h1>
        <p class="italic text-center"><?= lang('Podcast.no_episode_hint') ?></p>
    <?php endif; ?>
</section>

<?= $this->endSection()
?>
