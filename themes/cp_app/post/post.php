<?= $this->extend('podcast/_layout') ?>

<?= $this->section('content') ?>
<nav class="py-2">
    <a href="<?= route_to('podcast-activity', esc($podcast->handle)) ?>"
    class="inline-flex items-center px-4 py-2 text-sm focus:ring-accent"><?= icon(
    'arrow-left',
    'mr-2 text-lg',
) .
        lang('Post.back_to_actor_posts', [
            'actor' => esc($post->actor->display_name),
        ]) ?></a>
</nav>
<div class="pb-12">
    <?= view('post/_partials/post_with_replies', [
        'index' => 1,
        'post' => $post,
        'podcast' => $podcast,
    ]) ?>
</div>
<?= $this->endSection() ?>
