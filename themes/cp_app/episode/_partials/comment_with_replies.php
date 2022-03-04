<?php declare(strict_types=1);

if ($comment->in_reply_to_id): ?>
    <div class="relative -mb-2 overflow-hidden border-t border-l border-r border-subtle rounded-t-xl">
        <div class="absolute z-0 w-[2px] h-full bg-base left-[43px] top-4"></div>
        <?= view('episode/_partials/comment_reply', [
            'reply' => $comment->reply_to_comment,
        ]) ?>
    </div>
<?php endif; ?>
<?= $this->include('episode/_partials/comment_card') ?>
<div class="-mt-2 overflow-hidden border-b border-l border-r border-subtle post-replies rounded-b-xl">

<?php if (can_user_interact()): ?>
<form action="<?= route_to('comment-attempt-reply', $podcast->id, $episode->id, $comment->id) ?>" method="POST" class="flex px-6 pt-8 pb-4 gap-x-2 bg-base">
    <?= csrf_field() ?>

    <img src="<?= interact_as_actor()
        ->avatar_image_url ?>" alt="<?= esc(interact_as_actor()
        ->display_name) ?>" class="w-10 h-10 rounded-full aspect-square" loading="lazy" />
    <div class="flex flex-col flex-1">
        <Forms.Textarea
            name="message"
            required="true"
            class="w-full mb-4"
            placeholder="<?= lang('Comment.form.reply_to_placeholder', [
                'actorUsername' => esc($comment->actor->username),
            ]) ?>"
            rows="1" />
        <Button variant="primary" size="small" type="submit" name="action" value="reply" class="self-end" iconRight="send-plane"><?= lang('Comment.form.submit_reply') ?></Button>
    </div>
</form>
<?php endif; ?>

<?php if ($comment->has_replies): ?>
    <div class="border-t divide-y border-subtle">
    <?php foreach ($comment->replies as $reply): ?>
        <?= view('episode/_partials/comment_reply', [
            'reply' => $reply,
        ]) ?>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

</div>
