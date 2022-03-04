<?= $this->extend('episode/_layout') ?>

<?= $this->section('content') ?>

<?php if (can_user_interact()): ?>
    <?= view('_message_block') ?>
    <form action="<?= route_to('comment-attempt-create', $podcast->id, $episode->id)  ?>" method="POST" class="flex p-4 gap-x-2">
        <?= csrf_field() ?>

        <img src="<?= interact_as_actor()
            ->avatar_image_url ?>" alt="<?= esc(interact_as_actor()
            ->display_name) ?>" class="w-10 h-10 rounded-full aspect-square" loading="lazy" />
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

<div class="flex flex-col gap-y-2">
    <?php foreach ($episode->comments as $comment): ?>
        <?= view('episode/_partials/comment', [
    'comment' => $comment,
            'podcast' => $podcast,
]) ?>
    <?php endforeach; ?>
</div>

<?= $this->endSection()
?>
