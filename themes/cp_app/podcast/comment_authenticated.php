<?= $this->extend('podcast/_layout_authenticated') ?>

<?= $this->section('meta-tags') ?>
    <title><?= lang('Comment.title', [
    'actorDisplayName' => $comment->actor->display_name,
        'episodeTitle' => $episode->title,
]) ?></title>
    <meta name="description" content="<?= $comment->message ?>"/>
    <meta property="og:title" content="<?= lang('Comment.title', [
        'actorDisplayName' => $comment->actor->display_name,
        'episodeTitle' => $episode->title,
    ]) ?>"/>
    <meta property="og:locale" content="<?= service(
        'request',
    )->getLocale() ?>" />
    <meta property="og:site_name" content="<?= $comment->actor->display_name ?>" />
    <meta property="og:url" content="<?= current_url() ?>" />
    <meta property="og:image" content="<?= $comment->actor->avatar_image_url ?>" />
    <meta property="og:description" content="<?= $comment->message ?>" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-2xl px-6 mx-auto">
    <nav class="py-3">
        <a href="<?= route_to('episode', $podcast->handle, $episode->slug) ?>"
        class="inline-flex items-center px-4 py-2 text-sm"><?= icon(
        'arrow-left',
        'mr-2 text-lg',
    ) .
            lang('Comment.back_to_episode', [
                'episodeTitle' => $episode->title,
            ]) ?></a>
    </nav>
    <div class="pb-12">
        <?= $this->include(
                'podcast/_partials/comment_with_replies_authenticated',
            ) ?>
    </div>
</div>

<?= $this->endSection() ?>
