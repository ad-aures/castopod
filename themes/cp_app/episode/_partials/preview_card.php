<div class="flex items-center border-y border-subtle">
    <div class="relative">
        <time class="absolute px-1 text-sm font-semibold text-white rounded bg-black/75 bottom-2 right-2" datetime="PT<?= round($episode->audio->duration, 3) ?>S">
            <?= format_duration((int) $episode->audio->duration) ?>
        </time>
        <img
        src="<?= $episode->cover->thumbnail_url ?>"
        alt="<?= esc($episode->title) ?>" class="w-24 h-24 aspect-square" loading="lazy" />
    </div>
    <div class="flex flex-col flex-1 px-4 py-2">
        <div class="inline-flex">
            <?= episode_numbering($episode->number, $episode->season_number, 'text-xs font-semibold text-skin-muted px-1 border border-subtle mr-2 !no-underline', true) ?>
            <?= relative_time($episode->published_at, 'text-xs whitespace-nowrap text-skin-muted') ?>
        </div>
        <a href="<?= $episode->link ?>" class="flex items-baseline font-semibold line-clamp-2" title="<?= esc($episode->title) ?>"><?= esc($episode->title) ?></a>
    </div>
    <play-episode-button
        class="mr-4"
        id="<?= $index . '_' . $episode->id ?>"
        imageSrc="<?= $episode->cover->thumbnail_url ?>"
        title="<?= esc($episode->title) ?>"
        podcast="<?= esc($episode->podcast->title) ?>"
        src="<?= $episode->audio_web_url ?>"
        mediaType="<?= $episode->audio->file_mimetype ?>"
        playLabel="<?= lang('Common.play_episode_button.play') ?>"
        playingLabel="<?= lang('Common.play_episode_button.playing') ?>"></play-episode-button>
</div>