<footer>
    <button class="inline-flex items-center opacity-50 cursor-not-allowed hover:underline" title="<?= lang(
        'Comment.like',
        [
            'numberOfLikes' => $comment->likes_count,
        ],
    ) ?>"><?= icon('heart', 'text-xl mr-1 text-gray-500') . $comment->likes_count ?></button>
    <?php if($comment->replies_count): ?>
        <?= anchor(
            route_to('comment', $podcast->handle, $episode->slug, $comment->id),
            icon('caret-down', 'text-xl mr-1') . lang('Comment.view_replies', ['numberOfReplies' => $comment->replies_count]),
            ['class' => 'inline-flex items-center text-xs hover:underline']
        ) ?>
    <?php endif; ?>
</footer>