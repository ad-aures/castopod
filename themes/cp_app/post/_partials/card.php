<article class="relative z-10 w-full shadow bg-elevated sm:rounded-conditional-2xl">
    <header class="flex px-6 py-4 gap-x-2">
        <img src="<?= $post->actor
    ->avatar_image_url ?>" alt="<?= esc($post->actor->display_name) ?>" class="w-10 h-10 rounded-full aspect-square" loading="lazy" />
        <div class="flex flex-col min-w-0">
            <a href="<?= $post->actor
    ->uri ?>" class="flex items-baseline hover:underline" <?= $post
    ->actor->is_local
    ? ''
    : 'target="_blank" rel="noopener noreferrer"' ?>>
                <span class="mr-2 font-semibold truncate"><?= esc($post->actor
        ->display_name) ?></span>
                <span class="text-sm truncate text-skin-muted">@<?= esc($post->actor
        ->username) .
                    ($post->actor->is_local
                        ? ''
                        : '@' . esc($post->actor->domain)) ?></span>
            </a>
            <a href="<?= route_to('post', esc($podcast->handle), $post->id) ?>"
            class="text-xs text-skin-muted">
                <?= relative_time($post->published_at) ?>
            </a>
        </div>
    </header>
    <?php if (substr_count($post->message, "\n") >= 3 || strlen($post->message) > 250): ?>
        <ReadMore id="<?= $index ?>" class="px-6 mb-4 post-content"><?= $post->message_html ?></ReadMore>
    <?php else: ?>
        <div class="px-6 mb-4 post-content"><?= $post->message_html ?></div>
    <?php endif; ?>
    <?php if ($post->episode_id && $post->in_reply_to_id === null): ?>
        <?= view('episode/_partials/preview_card', [
    'index' => $index,
            'episode' => $post->episode,
]) ?>
    <?php elseif ($post->preview_card): ?>
        <?= view('post/_partials/preview_card', [
            'preview_card' => $post->preview_card,
        ]) ?>
    <?php endif; ?>
    <?= $this->include('post/_partials/actions') ?>
</article>
