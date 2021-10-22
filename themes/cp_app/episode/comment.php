<?= $this->extend('episode/_layout') ?>

<?= $this->section('meta-tags') ?>
    <title><?= lang('Comment.title', [
        'actorDisplayName' => $comment->actor->display_name,
    ]) ?></title>
    <meta name="description" content="<?= $comment->message ?>"/>
    <meta property="og:title" content="<?= lang('Comment.title', [
        'actorDisplayName' => $comment->actor->display_name,
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
    <nav class="mb-2">
        <a href="<?= route_to('episode', $podcast->handle, $episode->slug) ?>"
        class="inline-flex items-center px-4 py-2 text-sm focus:ring-castopod"><?= icon(
        'arrow-left',
        'mr-2 text-lg',
    ) . lang('Comment.back_to_comments') ?></a>
    </nav>
    <div class="pb-12">
        <?= $this->include('episode/_partials/comment_with_replies') ?>
    </div>
</div>

<?= $this->endSection()
?>
