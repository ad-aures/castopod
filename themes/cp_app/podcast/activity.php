<?= $this->extend('podcast/_layout') ?>

<?= $this->section('meta-tags') ?>
<link type="application/rss+xml" rel="alternate" title="<?= $podcast->title ?>" href="<?= $podcast->feed_url ?>"/>

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

<nav class="sticky z-20 flex justify-center pt-2 text-lg sm:top-0 top-12 bg-pine-50">
<a href="<?= route_to(
        'podcast-activity',
        $podcast->handle,
    ) ?>" class="px-4 py-1 mr-8 font-semibold border-b-4 text-pine-800 border-pine-500"><?= lang(
        'Podcast.activity',
    ) ?></a>
    <a href="<?= route_to(
        'podcast-episodes',
        $podcast->handle,
    ) ?>" class="px-4 py-1 rounded-full hover:bg-pine-100"><?= lang(
        'Podcast.episodes',
    ) ?></a>
</nav>
<section class="max-w-2xl px-6 py-8 mx-auto space-y-8">
<?php foreach ($posts as $post): ?>
    <?php if ($post->reblog_of_id !== null): ?>
        <?= view('podcast/_partials/reblog', [
    'post' => $post->reblog_of_post,
            'podcast' => $podcast,
]) ?>
    <?php else: ?>
        <?= view('podcast/_partials/post', [
    'post' => $post,
            'podcast' => $podcast,
]) ?>
    <?php endif; ?>
<?php endforeach; ?>
</section>

<?= $this->endSection() ?>
