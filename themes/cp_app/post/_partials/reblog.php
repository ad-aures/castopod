<article class="relative z-10 w-full shadow bg-elevated rounded-conditional-2xl">
    <p class="inline-flex px-6 pt-4 text-xs text-skin-muted"><?= icon(
    'repeat',
    'text-lg mr-2 opacity-40',
) .
        lang('Post.actor_shared', [
            'actor' => esc($post->actor->display_name),
        ]) ?></p>
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
                        : '@' . $post->actor->domain) ?></span>
            </a>
            <a href="<?= route_to('post', esc($podcast->handle), $post->id) ?>"
            class="text-xs text-skin-muted">
                <?= relative_time($post->published_at) ?>
            </a>
        </div>
    </header>
    <div class="px-6 mb-4 post-content"><?= $post->message_html ?></div>
    <?php if ($post->episode_id): ?>
        <?= view('episode/_partials/preview_card', [
            'index' => $index,
            'episode' => $post->episode,
        ]) ?>
    <?php elseif ($post->preview_card_id): ?>
        <?= view('post/_partials/preview_card', [
            'preview_card' => $post->preview_card,
        ]) ?>
    <?php endif; ?>
    <?= $this->include('post/_partials/actions') ?>
</article>
