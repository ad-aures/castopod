<footer class="flex items-center gap-x-4">
    <button type="submit" name="action" class="inline-flex items-center opacity-50 cursor-not-allowed" disabled="disabled" title="<?= lang(
            'Comment.likes',
            [
                'numberOfLikes' => $reply->likes_count,
            ],
    ) ?>"><?= icon('heart', 'text-xl mr-1 text-gray-500') . $reply->likes_count ?></button>
    <?php if($reply->replies_count): ?>
    <?= anchor(
        route_to('comment', $podcast->handle, $episode->slug, $reply->id),
        icon('chat', 'text-2xl mr-1 text-gray-400') . $reply->replies_count,
        [
            'class' => 'inline-flex items-center hover:underline',
            'title' => lang('Comment.replies', [
                'numberOfReplies' => $reply->replies_count,
            ]),
        ],
    ) ?>
    <?php endif; ?>
</footer>
