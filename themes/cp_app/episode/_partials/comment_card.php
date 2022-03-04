<article class="relative z-10 flex w-full p-4 shadow bg-elevated rounded-conditional-2xl gap-x-2">
    <img src="<?= $comment->actor->avatar_image_url ?>" alt="<?= $comment->display_name ?>" class="w-10 h-10 rounded-full aspect-square" loading="lazy" />
    <div class="flex-1">
        <header class="w-full mb-2 text-sm">
            <a href="<?= $comment->actor->uri ?>" class="flex items-baseline hover:underline" <?= $comment->actor->is_local
                ? ''
                : 'target="_blank" rel="noopener noreferrer"' ?>>
                <span class="mr-2 font-semibold truncate"><?= esc($comment->actor
                    ->display_name) ?></span>
                <span class="text-sm truncate text-skin-muted">@<?= esc($comment->actor
                    ->username) .
                    ($comment->actor->is_local
                        ? ''
                        : '@' . esc($comment->actor->domain)) ?></span>
                <?= relative_time($comment->created_at, 'text-xs text-skin-muted ml-auto') ?>
            </a>
        </header>
        <div class="mb-2 post-content"><?= $comment->message_html ?></div>
        <?php if ($comment->is_from_post): ?>
            <?= $this->include('episode/_partials/comment_actions_from_post') ?>
        <?php else: ?>
            <footer>
                <?php if (can_user_interact()): ?>
                    <form action="<?= route_to('episode-comment-attempt-like', esc(interact_as_actor()->username), esc($episode->slug), $comment->id) ?>" method="POST" class="flex items-center gap-x-4">
                    <?= csrf_field() ?>

                    <button type="submit" name="action" class="inline-flex items-center hover:underline group" title="<?= lang(
                            'Comment.likes',
                            [
                                'numberOfLikes' => $comment->likes_count,
                            ],
                        ) ?>"><?= icon('heart', 'text-xl mr-1 text-gray-400 group-hover:text-red-600') . lang(
                            'Comment.likes',
                            [
                                'numberOfLikes' => $comment->likes_count,
                            ],
                        ) ?></button>
                </form>
                <?php else: ?>
                    <button class="inline-flex items-center opacity-50 cursor-not-allowed" title="<?= lang(
                            'Comment.likes',
                            [
                                'numberOfLikes' => $comment->likes_count,
                            ],
                        ) ?>"><?= icon('heart', 'text-xl mr-1 text-skin-muted') . lang(
                            'Comment.likes',
                            [
                                'numberOfLikes' => $comment->likes_count,
                            ],
                        ) ?></button>
                <?php endif; ?>
            </footer>
        <?php endif; ?>
    </div>
</article>
