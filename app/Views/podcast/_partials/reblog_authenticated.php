<article class="relative z-10 w-full bg-white shadow-md rounded-2xl">
    <p class="inline-flex px-6 pt-4 text-xs text-gray-700"><?= icon(
        'repeat',
        'text-lg mr-2 text-gray-400',
    ) .
        lang('Note.actor_shared', [
            'actor' => $note->actor->display_name,
        ]) ?></p>
    <header class="flex px-6 py-4">
        <img src="<?= $note->actor
            ->avatar_image_url ?>" alt="<?= $note->display_name ?>" class="w-12 h-12 mr-4 rounded-full" />
        <div class="flex flex-col min-w-0">
            <a href="<?= $note->actor
                ->uri ?>" class="flex items-baseline hover:underline" <?= !$note
    ->actor->is_local
    ? 'target="_blank" rel="noopener noreferrer"'
    : '' ?>>
                <span class="mr-2 font-semibold truncate"><?= $note->actor
                    ->display_name ?></span>
                <span class="text-sm text-gray-500 truncate">@<?= $note->actor
                    ->username .
                    (!$note->actor->is_local
                        ? '@' . $note->actor->domain
                        : '') ?></span>
            </a>
            <a href="<?= route_to('note', $podcast->name, $note->id) ?>"
            class="text-xs text-gray-500">
                <time
                itemprop="published"
                datetime="<?= $note->published_at->format(DateTime::ATOM) ?>"
                title="<?= $note->published_at ?>"
                ><?= lang('Common.mediumDate', [$note->published_at]) ?></time>
            </a>
        </div>
    </header>
    <div class="px-6 mb-4 note-content"><?= $note->message_html ?></div>
    <?php if ($note->preview_card): ?>
        <?= view('podcast/_partials/preview_card', [
            'preview_card' => $note->preview_card,
        ]) ?>
    <?php endif; ?>
    <?php if ($note->episode_id): ?>
        <?= view('podcast/_partials/episode_card', [
            'episode' => $note->episode,
        ]) ?>
    <?php endif; ?>
    <?= $this->include('podcast/_partials/note_actions_authenticated') ?>
</article>
