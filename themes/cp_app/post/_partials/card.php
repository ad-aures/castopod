<article class="relative z-10 w-full bg-white shadow sm:rounded-2xl">
    <header class="flex px-6 py-4">
        <img src="<?= $post->actor
    ->avatar_image_url ?>" alt="<?= $post->actor->display_name ?>" class="w-10 h-10 mr-2 rounded-full" />
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
    <?php if (substr_count($post->message, "\n") >= 3 || strlen($post->message) > 250): ?>
        <ReadMore id="<?= $index ?>" class="px-6 mb-4 post-content"><?= $post->message_html ?></ReadMore>
    <?php else: ?>
        <div class="px-6 mb-4 post-content"><?= $post->message_html ?></div>
    <?php endif; ?>
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
