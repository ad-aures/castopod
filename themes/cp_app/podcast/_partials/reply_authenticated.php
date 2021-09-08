<article class="flex px-6 py-4 bg-gray-50">
    <img src="<?= $reply->actor->avatar_image_url ?>" alt="<?= $reply->actor
    ->display_name ?>" class="w-12 h-12 mr-4 rounded-full ring-gray-50 ring-2" />
    <div class="flex flex-col flex-1 min-w-0">
        <header class="flex items-center mb-2">
            <a href="<?= $reply->actor
    ->uri ?>" class="mr-2 text-base font-semibold truncate hover:underline" <?= $reply
    ->actor->is_local
    ? ''
    : 'target="_blank" rel="noopener noreferrer"' ?>><?= $reply->actor
        ->display_name ?><span class="ml-1 text-sm font-normal text-gray-600">@<?= $reply
        ->actor->username .
    ($reply->actor->is_local ? '' : '@' . $reply->actor->domain) ?></span></a>
            <?= relative_time($post->published_at, 'flex-shrink-0 ml-auto text-xs text-gray-600') ?>
        </header>
        <p class="mb-2 post-content"><?= $reply->message_html ?></p>
        <?php if ($reply->has_preview_card): ?>
            <?= view('podcast/_partials/preview_card', [
                'preview_card' => $reply->preview_card,
            ]) ?>
        <?php endif; ?>
        <?= $this->include('podcast/_partials/reply_actions_authenticated') ?>
    </div>
</article>
