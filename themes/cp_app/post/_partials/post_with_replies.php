<?php declare(strict_types=1);

if ($post->in_reply_to_id): ?>
    <div class="relative -mb-2 overflow-hidden border-t border-l border-r border-subtle rounded-t-xl">
        <div class="absolute z-0 w-[2px] h-full bg-base left-[43px] top-4"></div>
        <?= view('post/_partials/reply', [
            'podcast' => $podcast,
            'reply' => $post->reply_to_post,
        ]) ?>
    </div>
<?php endif; ?>
<?= view('post/_partials/card', [
    'index' => $index,
    'post' => $post,
    'podcast' => $podcast,
]) ?>
<div class="-mt-2 overflow-hidden border-b border-l border-r border-subtle post-replies rounded-b-xl">
    <div class="px-6 pt-8 pb-4 bg-base">
        <?php if (can_user_interact()): ?>
            <form action="<?= route_to('post-attempt-action', esc(interact_as_actor()->username), $post->id) ?>" method="POST" class="flex gap-x-2" >
                <?= csrf_field() ?>

                <img src="<?= interact_as_actor()
                    ->avatar_image_url ?>" alt="<?= esc(interact_as_actor()
                    ->display_name) ?>" class="w-10 h-10 rounded-full aspect-square" loading="lazy" />
                <div class="flex flex-col flex-1">
                    <Forms.Textarea
                        name="message"
                        class="w-full mb-4"
                        required="true"
                        placeholder="<?= lang('Post.form.reply_to_placeholder', [
                            'actorUsername' => esc($post->actor->username),
                        ]) ?>"
                        rows="1" />
                    <Button variant="primary" size="small" type="submit" name="action" value="reply" class="self-end" iconRight="send-plane"><?= lang('Post.form.submit_reply') ?></Button>
                </div>
            </form>
        <?php else: ?>
            <?= anchor_popup(
                            route_to('post-remote-action', esc($podcast->handle), $post->id, 'reply'),
                            lang('Post.reply_to', [
                                'actorUsername' => esc($post->actor->username),
                            ]),
                            [
                                'class' =>
                                    'text-center justify-center font-semibold rounded-full shadow relative z-10 px-4 py-2 w-full bg-accent-base text-accent-contrast inline-flex items-center hover:bg-accent-hover',
                                'width' => 420,
                                'height' => 620,
                            ],
                        ) ?>
        <?php endif; ?>
    </div>

    <?php if ($post->has_replies): ?>
        <div class="border-t divide-y border-subtle">
        <?php foreach ($post->replies as $reply): ?>
            <?= view('post/_partials/reply', [
                'podcast' => $podcast,
                'reply' => $reply,
            ]) ?>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>