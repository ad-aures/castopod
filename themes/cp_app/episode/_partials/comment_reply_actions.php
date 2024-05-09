<footer>
    <?php if (can_user_interact()): ?>
        <form action="<?= route_to('episode-comment-attempt-like', esc($reply->episode->podcast->handle), esc($reply->episode->slug), $reply->id) ?>" method="POST" class="flex items-center gap-x-4">
            <?= csrf_field() ?>

            <button type="submit" name="action" class="inline-flex items-center hover:underline group" title="<?= lang(
                'Comment.likes',
                [
                    'numberOfLikes' => $reply->likes_count,
                ],
            ) ?>"><?= icon('heart-fill', [
                'class' => 'text-lg mr-1 text-gray-400 group-hover:text-red-600',
            ]) . $reply->likes_count ?></button>
            <x-Button uri="<?= route_to('episode-comment', esc($reply->episode->podcast->handle), esc($reply->episode->slug), $reply->id) ?>" size="small"><?= lang('Comment.reply') ?></x-Button>
        </form>
    <?php else: ?>
        <button type="submit" name="action" class="inline-flex items-center opacity-50 cursor-not-allowed" disabled="disabled" title="<?= lang(
            'Comment.likes',
            [
                'numberOfLikes' => $reply->likes_count,
            ],
        ) ?>"><?= icon('heart-fill', [
            'class' => 'text-lg mr-1 text-skin-muted',
        ]) . $reply->likes_count ?></button>
            <?php if ($reply->replies_count): ?>
                    <?= anchor(
                        route_to('episode-comment', esc($reply->episode->podcast->handle), esc($reply->episode->slug), $reply->id),
                        icon('chat-4-fill', [
                            'class' => 'text-2xl mr-1 opacity-40',
                        ]) . $reply->replies_count,
                        [
                            'class' => 'inline-flex items-center hover:underline',
                            'title' => lang('Comment.replies', [
                                'numberOfReplies' => $reply->replies_count,
                            ]),
                        ],
                    ) ?>
            <?php endif; ?>
    <?php endif; ?>
</footer>
