<?= $this->extend('episode/_layout') ?>

<?= $this->section('content') ?>

<?php if (can_user_interact()): ?>
    <?= view('_message_block') ?>
    <form action="<?= route_to('post-attempt-create', esc($podcast->handle)) ?>" method="POST" class="flex p-4 shadow bg-elevated gap-x-2 rounded-conditional-2xl">
        <?= csrf_field() ?>

        <img src="<?= interact_as_actor()
            ->avatar_image_url ?>" alt="<?= esc(interact_as_actor()
            ->display_name) ?>" class="w-10 h-10 rounded-full aspect-square" loading="lazy" />
        <div class="flex flex-col flex-1 min-w-0 gap-y-2">
            <input name="episode_url" value="<?= esc($episode->link) ?>" type="hidden" />
            <Forms.Textarea
                name="message"
                placeholder="<?= lang('Post.form.episode_message_placeholder') ?>"
                required="true"
                rows="2" />
            <Button variant="primary" size="small" type="submit" class="self-end" iconRight="send-plane"><?= lang('Post.form.submit') ?></Button>
        </div>
    </form>
    <hr class="my-4 border-subtle">
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
