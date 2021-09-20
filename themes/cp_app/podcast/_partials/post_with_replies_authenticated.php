<?= $this->include('podcast/_partials/post_authenticated') ?>
<div class="-mt-2 overflow-hidden border-b border-l border-r post-replies rounded-b-xl">
<form action="<?= route_to('post-attempt-action', interact_as_actor()->username, $post->id) ?>" method="POST" class="flex px-6 pt-8 pb-4 bg-gray-50" >
<img src="<?= interact_as_actor()
    ->avatar_image_url ?>" alt="<?= interact_as_actor()
    ->display_name ?>" class="w-12 h-12 mr-4 rounded-full ring-gray-50 ring-2" />
<div class="flex flex-col flex-1">
    <Forms.Textarea
        name="message"
        class="w-full mb-4"
        required="true"
        placeholder="<?= lang('Post.form.reply_to_placeholder', [
            'actorUsername' => $post->actor->username,
        ]) ?>"
        rows="1" />
    <Button variant="primary" size="small" type="submit" name="action" value="reply" class="self-end"><?= lang('Post.form.submit_reply') ?></Button>
</div>
</form>

<?php if ($post->has_replies): ?>
    <?php foreach ($post->replies as $reply): ?>
        <?= view('podcast/_partials/reply_authenticated', [
            'reply' => $reply,
        ]) ?>
    <?php endforeach; ?>
<?php endif; ?>
</div>
