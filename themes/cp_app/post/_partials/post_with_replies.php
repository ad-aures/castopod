<?= view('post/_partials/card', [
    'index' => $index,
    'post' => $post,
    'podcast' => $podcast,
]) ?>
<div class="-mt-2 overflow-hidden border-b border-l border-r post-replies rounded-b-xl">
    <div class="px-6 pt-8 pb-4 bg-gray-50">
        <?php if (can_user_interact()): ?>
            <form action="<?= route_to('post-attempt-action', interact_as_actor()->username, $post->id) ?>" method="POST" class="flex" >
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
                    <Button variant="primary" size="small" type="submit" name="action" value="reply" class="self-end" iconRight="send-plane"><?= lang('Post.form.submit_reply') ?></Button>
                </div>
            </form>
        <?php else: ?>
            <?= anchor_popup(
                            route_to('post-remote-action', $podcast->handle, $post->id, 'reply'),
                            lang('Post.reply_to', [
                                'actorUsername' => $post->actor->username,
                            ]),
                            [
                                'class' =>
                                    'text-center justify-center font-semibold rounded-full shadow relative z-10 px-4 py-2 w-full bg-rose-600 text-white inline-flex items-center hover:bg-rose-700',
                                'width' => 420,
                                'height' => 620,
                            ],
                        ) ?>
        <?php endif; ?>
    </div>

    <?php if ($post->has_replies): ?>
        <?php foreach ($post->replies as $reply): ?>
            <?= view('post/_partials/reply', [
                'podcast' => $podcast,
                'reply' => $reply,
            ]) ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>