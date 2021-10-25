<footer>
    <?php if (can_user_interact()): ?>
        <form action="<?= route_to('comment-attempt-like', interact_as_actor()->username, $comment->episode->slug, $comment->id) ?>" method="POST" class="flex items-center gap-x-4">
            <button type="submit" name="action" class="inline-flex items-center hover:underline group" title="<?= lang(
    'Comment.likes',
    [
        'numberOfLikes' => $comment->likes_count,
    ],
) ?>"><?= icon('heart', 'text-xl mr-1 text-gray-400 group-hover:text-red-600') . $comment->likes_count ?></button>
            <Button uri="<?= route_to('episode-comment', $comment->episode->podcast->handle, $comment->episode->slug, $comment->id) ?>" size="small"><?= lang('Comment.reply') ?></Button>
        </form>
        <?php if ($comment->replies_count): ?>
            <?= anchor(
    route_to('episode-comment', $comment->episode->podcast->handle, $comment->episode->slug, $comment->id),
    icon('caret-down', 'text-xl mr-1') . lang('Comment.view_replies', [
        'numberOfReplies' => $comment->replies_count,
    ]),
    [
        'class' => 'inline-flex items-center text-xs hover:underline',
    ]
) ?>
        <?php endif; ?>
    <?php else: ?>
        <button class="inline-flex items-center opacity-50 cursor-not-allowed hover:underline" title="<?= lang(
    'Comment.like',
    [
        'numberOfLikes' => $comment->likes_count,
    ],
) ?>"><?= icon('heart', 'text-xl mr-1 text-gray-500') . $comment->likes_count ?></button>
        <?php if ($comment->replies_count): ?>
            <?= anchor(
    route_to('episode-comment', $comment->episode->podcast->handle, $comment->episode->slug, $comment->id),
    icon('caret-down', 'text-xl mr-1') . lang('Comment.view_replies', [
        'numberOfReplies' => $comment->replies_count,
    ]),
    [
        'class' => 'inline-flex items-center text-xs hover:underline',
    ]
) ?>
        <?php endif; ?>
    <?php endif; ?>
</footer>
