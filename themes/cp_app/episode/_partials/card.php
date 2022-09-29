<article class="flex w-full p-3 shadow border-3 bg-elevated rounded-conditional-2xl gap-x-2 <?= $episode->is_premium ? 'border-accent-base' : 'border-transparent' ?>">
    <div class="relative flex-shrink-0 w-20">
        <time class="absolute px-1 text-xs font-semibold text-white rounded bottom-2 right-2 bg-black/75" datetime="PT<?= round($episode->audio->duration, 3) ?>S">
            <?= format_duration((int) $episode->audio->duration) ?>
        </time>
        <?php if ($episode->is_premium): ?>
            <Icon glyph="exchange-dollar" class="absolute left-0 w-8 pl-2 text-2xl rounded-r-full rounded-tl-lg top-2 text-accent-contrast bg-accent-base" />
        <?php endif; ?>
        <img src="<?= $episode->cover
            ->thumbnail_url ?>" alt="<?= esc($episode->title) ?>" class="object-cover w-full rounded-lg shadow-inner aspect-square" loading="lazy" />
    </div>
    <div class="flex items-center flex-1 gap-x-4">
        <div class="flex flex-col flex-1">
            <div class="flex flex-wrap items-center">
                <?= episode_numbering($episode->number, $episode->season_number, 'text-xs font-semibold border-subtle text-skin-muted px-1 border mr-2 !no-underline', true) ?>
                <?= relative_time($episode->published_at, 'text-xs whitespace-nowrap text-skin-muted') ?>
            </div>
            <h2 class="flex-1 mt-1 font-semibold leading-tight line-clamp-2"><a class="hover:underline" href="<?= $episode->link ?>"><?= esc($episode->title) ?></a></h2>
        </div>
        <?php if ($episode->is_premium && ! is_unlocked($podcast->handle)): ?>
            <a href="<?= route_to('episode', $episode->podcast->handle, $episode->slug) ?>" class="p-3 rounded-full bg-brand bg-accent-base text-accent-contrast hover:bg-accent-hover focus:ring-accent" title="<?= lang('PremiumPodcasts.unlock_episode') ?>" data-tooltip="bottom">
                <Icon glyph="lock" class="text-xl" />
            </a>
        <?php else: ?>
            <play-episode-button
                id="<?= $episode->id ?>"
                imageSrc="<?= $episode->cover->thumbnail_url ?>"
                title="<?= esc($episode->title) ?>"
                podcast="<?= esc($episode->podcast->title) ?>"
                src="<?= $episode->audio_web_url ?>"
                mediaType="<?= $episode->audio->file_mimetype ?>"
                playLabel="<?= lang('Common.play_episode_button.play') ?>"
                playingLabel="<?= lang('Common.play_episode_button.playing') ?>"></play-episode-button>
        <?php endif; ?>
    </div>
</article>
