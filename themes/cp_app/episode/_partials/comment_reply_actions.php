<footer>
    <?php if (can_user_interact()): ?>
        <form action="<?= route_to('comment-attempt-like', interact_as_actor()->username, $reply->episode->slug, $reply->id) ?>" method="POST" class="flex items-center gap-x-4">
            <button type="submit" name="action" class="inline-flex items-center hover:underline group" title="<?= lang(
    'Comment.likes',
    [
        'numberOfLikes' => $reply->likes_count,
    ],
) ?>"><?= icon('heart', 'text-lg mr-1 text-gray-400 group-hover:text-red-600') . $reply->likes_count ?></button>
            <Button uri="<?= route_to('episode-comment', $reply->episode->podcast->handle, $reply->episode->slug, $reply->id) ?>" size="small"><?= lang('Comment.reply') ?></Button>
        </form>
    <?php else: ?>
        <button type="submit" name="action" class="inline-flex items-center opacity-50 cursor-not-allowed" disabled="disabled" title="<?= lang(
    'Comment.likes',
    [
        'numberOfLikes' => $reply->likes_count,
    ],
) ?>"><?= icon('heart', 'text-lg mr-1 text-gray-500') . $reply->likes_count ?></button>
            <?php if ($reply->replies_count): ?>
                    <?= anchor(
    route_to('episode-comment', $reply->episode->podcast->handle, $reply->episode->slug, $reply->id),
    icon('chat', 'text-2xl mr-1 text-gray-400') . $reply->replies_count,
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
