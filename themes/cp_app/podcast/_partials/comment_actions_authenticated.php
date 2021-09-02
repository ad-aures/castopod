<footer>
    <form action="<?= route_to('comment-attempt-like', interact_as_actor()->username, $episode->slug, $comment->id) ?>" method="POST" class="flex items-center gap-x-4">
        <button type="submit" name="action" class="inline-flex items-center hover:underline group" title="<?= lang(
            'Comment.likes',
            [
                'numberOfLikes' => $comment->likes_count,
            ],
        ) ?>"><?= icon('heart', 'text-xl mr-1 text-gray-400 group-hover:text-red-600') . $comment->likes_count ?></button>
        <?= button(
            lang('Comment.reply'),
            route_to('comment', $podcast->handle, $episode->slug, $comment->id),
            [
                'size' => 'small',
            ],
        ) ?>
    </form>
    <?php if($comment->replies_count): ?>
        <?= anchor(
            route_to('comment', $podcast->handle, $episode->slug, $comment->id),
            icon('caret-down', 'text-xl mr-1') . lang('Comment.view_replies', ['numberOfReplies' => $comment->replies_count]),
            ['class' => 'inline-flex items-center text-xs hover:underline']
        ) ?>
    <?php endif; ?>
</footer>
