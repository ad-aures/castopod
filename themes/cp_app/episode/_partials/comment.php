<article class="relative z-10 flex w-full px-4 py-2 rounded-conditional-2xl gap-x-2">
    <img src="<?= $comment->actor->avatar_image_url ?>" alt="<?= esc($comment->display_name) ?>" class="w-10 h-10 rounded-full aspect-square" loading="lazy" />
    <div class="flex-1">
        <header class="w-full mb-2 text-sm">
            <a href="<?= $comment->actor
    ->uri ?>" class="flex items-baseline hover:underline" <?= $comment->actor->is_local
                ? ''
                : 'target="_blank" rel="noopener noreferrer"' ?>>
                <span class="mr-2 font-semibold truncate"><?= esc($comment->actor
                    ->display_name) ?></span>
                <span class="text-sm truncate text-skin-muted">@<?= esc($comment->actor
                    ->username) .
                    ($comment->actor->is_local
                        ? ''
                        : '@' . esc($comment->actor->domain)) ?></span>
                <?= relative_time($comment->created_at, 'text-xs text-skin-muted ml-auto flex-shrink-0') ?>
            </a>
        </header>
        <div class="mb-2 post-content"><?= $comment->message_html ?></div>
        <?php if ($comment->is_from_post): ?>
            <?= $this->include('episode/_partials/comment_actions_from_post') ?>
        <?php else: ?>
            <?= $this->include('episode/_partials/comment_actions') ?>
        <?php endif; ?>
    </div>
</article>
