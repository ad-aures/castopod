<?= $this->extend('podcast/_layout') ?>

<?= $this->section('meta-tags') ?>
    <title><?= lang('Post.title', [
        'actorDisplayName' => $post->actor->display_name,
    ]) ?></title>
    <meta name="description" content="<?= $post->message ?>"/>
    <meta property="og:title" content="<?= lang('Post.title', [
        'actorDisplayName' => $post->actor->display_name,
    ]) ?>"/>
    <meta property="og:locale" content="<?= service(
        'request',
    )->getLocale() ?>" />
    <meta property="og:site_name" content="<?= $post->actor->display_name ?>" />
    <meta property="og:url" content="<?= current_url() ?>" />
    <meta property="og:image" content="<?= $post->actor->avatar_image_url ?>" />
    <meta property="og:description" content="<?= $post->message ?>" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-2xl px-6 mx-auto">
    <nav class="py-3">
        <a href="<?= route_to('podcast-activity', $podcast->handle) ?>"
        class="inline-flex items-center px-4 py-2 text-sm"><?= icon(
        'arrow-left',
        'mr-2 text-lg',
    ) .
            lang('Post.back_to_actor_posts', [
                'actor' => $post->actor->display_name,
            ]) ?></a>
    </nav>
    <div class="pb-12">
        <?= $this->include('podcast/_partials/post_with_replies') ?>
    </div>
</div>

<?= $this->endSection()
?>
