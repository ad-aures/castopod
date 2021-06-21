<article class="relative z-10 w-full bg-white shadow-md rounded-2xl">
    <header class="flex px-6 py-4">
        <img src="<?= $status->actor
            ->avatar_image_url ?>" alt="<?= $status->display_name ?>" class="w-12 h-12 mr-4 rounded-full" />
        <div class="flex flex-col min-w-0">
            <a href="<?= $status->actor
                ->uri ?>" class="flex items-baseline hover:underline" <?= $status
    ->actor->is_local
    ? ''
    : 'target="_blank" rel="noopener noreferrer"' ?>>
                <span class="mr-2 font-semibold truncate"><?= $status->actor
                    ->display_name ?></span>
                <span class="text-sm text-gray-500 truncate">@<?= $status->actor
                    ->username .
                    ($status->actor->is_local
                        ? ''
                        : '@' . $status->actor->domain) ?></span>
            </a>
            <a href="<?= route_to('status', $podcast->name, $status->id) ?>"
            class="text-xs text-gray-500">
                <time
                itemprop="published"
                datetime="<?= $status->published_at->format(DateTime::ATOM) ?>"
                title="<?= $status->published_at ?>"
                ><?= lang('Common.mediumDate', [$status->published_at]) ?></time>
            </a>
        </div>
    </header>
    <div class="px-6 mb-4 status-content"><?= $status->message_html ?></div>
    <?php if ($status->episode_id): ?>
        <?= view('podcast/_partials/episode_card', [
            'episode' => $status->episode,
        ]) ?>
    <?php elseif ($status->has_preview_card): ?>
        <?= view('podcast/_partials/preview_card', [
            'preview_card' => $status->preview_card,
        ]) ?>
    <?php endif; ?>
    <?= $this->include('podcast/_partials/status_actions') ?>
</article>
