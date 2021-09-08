<article class="relative z-10 flex w-full p-4 bg-white shadow rounded-2xl">
    <img src="<?= $comment->actor->avatar_image_url ?>" alt="<?= $comment->display_name ?>" class="w-12 h-12 mr-4 rounded-full" />
    <div class="flex-1">
        <header class="w-full mb-2 text-sm">
            <a href="<?= $comment->actor
    ->uri ?>" class="flex items-baseline hover:underline" <?= $comment->actor->is_local
                ? ''
                : 'target="_blank" rel="noopener noreferrer"' ?>>
                <span class="mr-2 font-semibold truncate"><?= $comment->actor
                    ->display_name ?></span>
                <span class="text-sm text-gray-500 truncate">@<?= $comment->actor
                    ->username .
                    ($comment->actor->is_local
                        ? ''
                        : '@' . $comment->actor->domain) ?></span>
                <?= relative_time($comment->created_at, 'text-xs text-gray-500 ml-auto') ?>
            </a>
        </header>
        <div class="mb-2 post-content"><?= $comment->message_html ?></div>
        <?php if ($comment->is_from_post): ?>
            <?= $this->include('podcast/_partials/comment_actions_from_post') ?>
        <?php else: ?>
            <footer>
                <button class="inline-flex items-center opacity-50 cursor-not-allowed" title="<?= lang(
                            'Comment.likes',
                            [
                                'numberOfLikes' => $comment->likes_count,
                            ],
                        ) ?>"><?= icon('heart', 'text-xl mr-1 text-gray-500') . lang(
                            'Comment.likes',
                            [
                                'numberOfLikes' => $comment->likes_count,
                            ],
                        ) ?></button>
            </footer>
        <?php endif; ?>
    </div>
</article>
