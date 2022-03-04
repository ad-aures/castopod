<article class="flex px-6 py-4 bg-base gap-x-2">
    <img src="<?= $reply->actor->avatar_image_url ?>" alt="<?= esc($reply->actor
    ->display_name) ?>" class="z-10 w-10 h-10 rounded-full ring-gray-50 ring-2 aspect-square" loading="lazy" />
    <div class="flex flex-col flex-1 min-w-0">
        <header class="flex items-center mb-2">
            <a href="<?= $reply->actor
    ->uri ?>" class="mr-2 text-base font-semibold truncate hover:underline" <?= $reply
    ->actor->is_local
    ? ''
    : 'target="_blank" rel="noopener noreferrer"' ?>><?= esc($reply->actor
        ->display_name) ?><span class="ml-1 text-sm font-normal text-skin-muted">@<?= esc($reply
        ->actor->username) .
    ($reply->actor->is_local ? '' : '@' . esc($reply->actor->domain)) ?></span></a>
            <?= relative_time($reply->created_at, 'flex-shrink-0 ml-auto text-xs text-skin-muted') ?>
        </header>
        <p class="mb-2 post-content"><?= $reply->message_html ?></p>
        <?= $this->include('episode/_partials/comment_reply_actions') ?>
    </div>
</article>
