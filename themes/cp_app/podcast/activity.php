<?= $this->extend('podcast/_layout') ?>

<?= $this->section('content') ?>

<?php if (can_user_interact()): ?>
    <form action="<?= route_to('post-attempt-create', esc(interact_as_actor()->username)) ?>" method="POST" class="flex p-4 shadow bg-elevated gap-x-2 rounded-conditional-2xl">
    <?= csrf_field() ?>

    
    <img src="<?= interact_as_actor()
        ->avatar_image_url ?>" alt="<?= esc(interact_as_actor()
        ->display_name) ?>" class="w-10 h-10 rounded-full aspect-square" loading="lazy" />
    <div class="flex flex-col flex-1 min-w-0 gap-y-2">
        <?= view('_message_block') ?>
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
<hr class="my-4 border-subtle">

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
