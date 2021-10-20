<?= $this->include('episode/_partials/comment_card') ?>
<div class="-mt-2 overflow-hidden border-b border-l border-r post-replies rounded-b-xl">

<?php if (can_user_interact()): ?>
<form action="<?= route_to('comment-attempt-reply', $podcast->id, $episode->id, $comment->id) ?>" method="POST" class="flex px-6 pt-8 pb-4 bg-gray-50">
    <img src="<?= interact_as_actor()
    ->avatar_image_url ?>" alt="<?= interact_as_actor()
    ->display_name ?>" class="w-10 h-10 mr-2 rounded-full ring-gray-50 ring-2" />
    <div class="flex flex-col flex-1">
        <Forms.Textarea
            name="message"
            required="true"
            class="w-full mb-4"
            placeholder="<?= lang('Comment.form.reply_to_placeholder', [
                'actorUsername' => $comment->actor->username,
            ]) ?>"
            rows="1" />
        <Button variant="primary" size="small" type="submit" name="action" value="reply" class="self-end" iconRight="send-plane"><?= lang('Comment.form.submit_reply') ?></Button>
    </div>
</form>
<?php endif; ?>

<?php foreach ($comment->replies as $reply): ?>
    <?= view('episode/_partials/comment_reply', [
        'reply' => $reply,
    ]) ?>
<?php endforeach; ?>

</div>
