<?= $this->extend('podcast/_layout_authenticated') ?>

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
<meta property="og:image:width" content="<?= config('Images')->largeSize ?>" />
<meta property="og:image:height" content="<?= config('Images')->largeSize ?>" />
<meta name="twitter:card" content="summary_large_image" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<nav class="sticky top-0 z-20 flex justify-center pt-2 text-lg bg-pine-50">
<a href="<?= route_to(
    'podcast-activity',
    $podcast->name,
) ?>" class="px-4 py-1 mr-8 font-semibold border-b-4 text-pine-800 border-pine-800"><?= lang(
    'Podcast.activity',
) ?></a>
    <a href="<?= route_to(
        'podcast-episodes',
        $podcast->name,
    ) ?>" class="px-4 py-1 rounded-full hover:bg-pine-100"><?= lang(
    'Podcast.episodes',
) ?></a>
</nav>

<section class="max-w-2xl px-6 py-8 mx-auto">
<?= form_open(route_to('status-attempt-create', interact_as_actor()->username), [
    'class' => 'flex p-4 bg-white shadow rounded-xl',
]) ?>
    <?= csrf_field() ?>

    <?= view('_message_block') ?>

    <img src="<?= interact_as_actor()
        ->avatar_image_url ?>" alt="<?= interact_as_actor()
    ->display_name ?>" class="w-12 h-12 mr-4 rounded-full" />
    <div class="flex flex-col flex-1 min-w-0">
        <?= form_textarea(
            [
                'id' => 'message',
                'name' => 'message',
                'class' => 'form-textarea',
                'required' => 'required',
                'placeholder' => lang('Status.form.message_placeholder'),
            ],
            old('message', '', false),
            ['rows' => 2],
        ) ?>
        <?= form_input([
            'id' => 'episode_url',
            'name' => 'episode_url',
            'class' => 'form-input mb-2',
            'placeholder' =>
                lang('Status.form.episode_url_placeholder') .
                ' (' .
                lang('Common.optional') .
                ')',
            'type' => 'url',
        ]) ?>

        <?= button(
            lang('Status.form.submit'),
            '',
            ['variant' => 'primary', 'size' => 'small'],
            ['type' => 'submit', 'class' => 'self-end'],
        ) ?>
    </div>
<?= form_close() ?>
<hr class="my-4 border-2 border-pine-100">

<div class="space-y-8">
<?php foreach ($statuses as $status): ?>
    <?php if ($status->reblog_of_id !== null): ?>
        <?= view('podcast/_partials/reblog_authenticated', [
            'status' => $status->reblog_of_status,
        ]) ?>
    <?php else: ?>
        <?= view('podcast/_partials/status_authenticated', ['status' => $status]) ?>
    <?php endif; ?>
<?php endforeach; ?>
</div>
</section>

<?= $this->endSection() ?>
