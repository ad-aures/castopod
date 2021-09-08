<article class="relative z-10 w-full bg-white shadow rounded-2xl">
    <header class="flex px-6 py-4">
        <img src="<?= $post->actor
    ->avatar_image_url ?>" alt="<?= $post->actor->display_name ?>" class="w-12 h-12 mr-4 rounded-full" />
        <div class="flex flex-col min-w-0">
            <a href="<?= $post->actor
    ->uri ?>" class="flex items-baseline hover:underline" <?= $post
    ->actor->is_local
    ? ''
    : 'target="_blank" rel="noopener noreferrer"' ?>>
                <span class="mr-2 font-semibold truncate"><?= $post->actor
        ->display_name ?></span>
                <span class="text-sm text-gray-500 truncate">@<?= $post->actor
        ->username .
                    ($post->actor->is_local
                        ? ''
                        : '@' . $post->actor->domain) ?></span>
            </a>
            <a href="<?= route_to('post', $podcast->handle, $post->id) ?>"
            class="text-xs text-gray-500">
                <?= relative_time($post->published_at) ?>
            </a>
        </div>
    </header>
    <div class="px-6 mb-4 post-content"><?= $post->message_html ?></div>
    <?php if ($post->episode_id): ?>
        <?= view('podcast/_partials/episode_preview_card', [
            'episode' => $post->episode,
        ]) ?>
    <?php elseif ($post->has_preview_card): ?>
        <?= view('podcast/_partials/preview_card', [
            'preview_card' => $post->preview_card,
        ]) ?>
    <?php endif; ?>
    <?= $this->include('podcast/_partials/post_actions_authenticated') ?>
</article>
