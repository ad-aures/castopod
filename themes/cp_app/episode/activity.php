<?= $this->extend('episode/_layout') ?>

<?= $this->section('meta-tags') ?>
<title><?= $episode->title ?></title>
<meta name="description" content="<?= htmlspecialchars($episode->description) ?>" />
<link rel="canonical" href="<?= $episode->link ?>" />
<meta property="og:title" content="<?= $episode->title ?>" />
<meta property="og:description" content="<?= $episode->description ?>" />
<meta property="og:locale" content="<?= $podcast->language_code ?>" />
<meta property="og:site_name" content="<?= $podcast->title ?>" />
<meta property="og:url" content="<?= current_url() ?>" />
<meta property="og:image" content="<?= $episode->image->large_url ?>" />
<meta property="og:image:width" content="<?= config('Images')
    ->largeSize ?>" />
<meta property="og:image:height" content="<?= config('Images')
    ->largeSize ?>" />
<meta property="og:description" content="$description" />
<meta property="article:published_time" content="<?= $episode->published_at ?>" />
<meta property="article:modified_time" content="<?= $episode->updated_at ?>" />
<meta property="og:audio" content="<?= $episode->audio_file_opengraph_url ?>" />
<meta property="og:audio:type" content="<?= $episode->audio_file_mimetype ?>" />
<link rel="alternate" type="application/json+oembed" href="<?= base_url(route_to('episode-oembed-json', $podcast->handle, $episode->slug)) ?>" title="<?= $episode->title ?> oEmbed json" />
<link rel="alternate" type="text/xml+oembed" href="<?= base_url(route_to('episode-oembed-xml', $podcast->handle, $episode->slug)) ?>" title="<?= $episode->title ?> oEmbed xml" />
<meta name="twitter:title" content="<?= $episode->title ?>" />
<meta name="twitter:description" content="<?= $episode->description ?>" />
<meta name="twitter:image" content="<?= $episode->image->large_url ?>" />
<meta name="twitter:card" content="player" />
<meta property="twitter:audio:partner" content="<?= $podcast->publisher ?>" />
<meta property="twitter:audio:artist_name" content="<?= $podcast->owner_name ?>" />
<meta name="twitter:player" content="<?= $episode->getEmbedUrl('light') ?>" />
<meta name="twitter:player:width" content="600" />
<meta name="twitter:player:height" content="200" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (can_user_interact()): ?>
    <?= view('_message_block') ?>
    <form action="<?= route_to('post-attempt-create', $podcast->handle) ?>" method="POST" class="flex p-4 bg-white shadow gap-x-2 rounded-conditional-2xl">
        <?= csrf_field() ?>

        <img src="<?= interact_as_actor()
            ->avatar_image_url ?>" alt="<?= interact_as_actor()
            ->display_name ?>" class="w-10 h-10 rounded-full" />
        <div class="flex flex-col flex-1 min-w-0 gap-y-2">
            <input name="episode_url" value="<?= $episode->link ?>" type="hidden" />
            <Forms.Textarea
                name="message"
                placeholder="<?= lang('Post.form.episode_message_placeholder') ?>"
                required="true"
                rows="2" />
            <Button variant="primary" size="small" type="submit" class="self-end" iconRight="send-plane"><?= lang('Post.form.submit') ?></Button>
        </div>
    </form>
    <hr class="my-4 border-2 border-pine-100">
<?php endif; ?>

<div class="flex flex-col gap-y-4">
    <?php foreach ($episode->posts as $key => $post): ?>
        <?= view('post/_partials/card', [
    'index' => $key,
            'post' => $post,
            'podcast' => $podcast,
]) ?>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
