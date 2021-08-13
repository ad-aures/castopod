<article class="relative z-10 w-full bg-white shadow-md rounded-2xl">
    <header class="flex px-6 py-4">
        <img src="<?= $comment->actor
            ->avatar_image_url ?>" alt="<?= $comment->actor->display_name ?>" class="w-12 h-12 mr-4 rounded-full" />
        <div class="flex flex-col min-w-0">
            <a href="<?= $comment->actor
                ->uri ?>" class="flex items-baseline hover:underline" <?= $comment
    ->actor->is_local
    ? ''
    : 'target="_blank" rel="noopener noreferrer"' ?>>
                <span class="mr-2 font-semibold truncate"><?= $comment->actor
                    ->display_name ?></span>
                <span class="text-sm text-gray-500 truncate">@<?= $comment->actor
                    ->username .
                    ($comment->actor->is_local
                        ? ''
                        : '@' . $comment->actor->domain) ?></span>
            </a>
            <a href="<?= route_to('comment', $podcast->handle, $episode->slug, $comment->id) ?>"
            class="text-xs text-gray-500">
                <?= relative_time($comment->created_at) ?>
            </a>
        </div>
    </header>
    <div class="px-6 mb-4 post-content"><?= $comment->message_html ?></div>
    <?= $this->include('podcast/_partials/comment_actions') ?>
</article>
