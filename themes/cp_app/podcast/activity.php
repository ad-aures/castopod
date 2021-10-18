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

<?php if (can_user_interact()): ?>
    <form action="<?= route_to('post-attempt-create', interact_as_actor()->username) ?>" method="POST" class="flex p-4 bg-white shadow rounded-conditional-2xl">
    <?= csrf_field() ?>

    <?= view('_message_block') ?>

    <img src="<?= interact_as_actor()
        ->avatar_image_url ?>" alt="<?= interact_as_actor()
        ->display_name ?>" class="w-12 h-12 mr-4 rounded-full" />
    <div class="flex flex-col flex-1 min-w-0 gap-y-2">
        <Forms.Textarea
            name="message"
            required="true"
            placeholder="<?= lang('Post.form.message_placeholder') ?>"
            rows="2" />
        <Forms.Input
            name="episode_url"
            type="url"
            placeholder="<?= lang('Post.form.episode_url_placeholder') . ' (' . lang('Common.optional') . ')' ?>" />
        <Button variant="primary" size="small" type="submit" class="self-end" iconRight="send-plane"><?= lang('Post.form.submit') ?></Button>
    </div>
</form>
<hr class="my-4 border-2 border-pine-100">

<?php endif; ?>
<div class="flex flex-col gap-y-4">
    <?php foreach ($posts as $key => $post): ?>
        <?php if ($post->reblog_of_id !== null): ?>
            <?= view('post/_partials/reblog', [
    'index' => $key,
                'post' => $post->reblog_of_post,
                'podcast' => $podcast,
]) ?>
        <?php else: ?>
            <?= view('post/_partials/card', [
    'index' => $key,
                'post' => $post,
                'podcast' => $podcast,
]) ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
