<?= $this->extend('episode/_layout') ?>

<?= $this->section('meta-tags') ?>
<title><?= $episode->title ?></title>
<meta name="description" content="<?= htmlspecialchars(
    $episode->description,
) ?>" />
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
<meta name="twitter:player" content="<?= $episode->getEmbeddablePlayerUrl('light') ?>" />
<meta name="twitter:player:width" content="600" />
<meta name="twitter:player:height" content="200" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex flex-col gap-y-4">
    <?php if (can_user_interact()): ?>
    <form action="<?= route_to('comment-attempt-create', $podcast->id, $episode->id)  ?>" method="POST" class="flex p-4">
        <?= csrf_field() ?>

        <?= view('_message_block') ?>

        <img src="<?= interact_as_actor()
            ->avatar_image_url ?>" alt="<?= interact_as_actor()
            ->display_name ?>" class="w-10 h-10 mr-2 rounded-full" />
        <div class="flex flex-col flex-1 min-w-0 gap-y-2">
            <Forms.Textarea
                name="message"
                required="true"
                placeholder="<?= lang('Comment.form.episode_message_placeholder') ?>"
                rows="2" />
            <Button class="self-end" variant="primary" size="small" type="submit" iconRight="send-plane"><?= lang('Comment.form.submit') ?></Button>
        </div>
    </form>
    <?php endif; ?>

    <?php foreach ($episode->comments as $comment): ?>
    <?= view('episode/_partials/comment', [
    'comment' => $comment,
        'podcast' => $podcast,
]) ?>
    <?php endforeach; ?>
</div>

<?= $this->endSection()
?>
