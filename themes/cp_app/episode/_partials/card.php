<article class="flex w-full p-4 shadow bg-elevated rounded-conditional-2xl gap-x-2">
    <div class="relative">
        <time class="absolute px-1 text-xs font-semibold text-white rounded bottom-2 right-2 bg-black/75" datetime="PT<?= round($episode->audio->duration, 3) ?>S">
            <?= format_duration((int) $episode->audio->duration) ?>
        </time>
        <img src="<?= $episode->cover
                ->thumbnail_url ?>" alt="<?= esc($episode->title) ?>" class="object-cover w-20 rounded-lg shadow-inner aspect-square" loading="lazy" />
    </div>
    <div class="flex items-center flex-1 gap-x-4">
        <div class="flex flex-col flex-1">
            <div class="inline-flex items-center">
                <?= episode_numbering($episode->number, $episode->season_number, 'text-xs font-semibold border-subtle text-skin-muted px-1 border mr-2 !no-underline', true) ?>
                <?= relative_time($episode->published_at, 'text-xs whitespace-nowrap text-skin-muted') ?>
            </div>
            <h2 class="flex-1 mt-1 font-semibold leading-tight line-clamp-2"><a class="hover:underline" href="<?= $episode->link ?>"><?= esc($episode->title) ?></a></h2>
        </div>
        <play-episode-button
            id="<?= $episode->id ?>"
            imageSrc="<?= $episode->cover->thumbnail_url ?>"
            title="<?= esc($episode->title) ?>"
            podcast="<?= esc($episode->podcast->title) ?>"
            src="<?= $episode->audio_web_url ?>"
            mediaType="<?= $episode->audio->file_mimetype ?>"
            playLabel="<?= lang('Common.play_episode_button.play') ?>"
            playingLabel="<?= lang('Common.play_episode_button.playing') ?>"></play-episode-button>
    </div>
</article>
