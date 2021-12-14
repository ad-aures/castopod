<article class="flex w-full p-4 shadow bg-elevated rounded-conditional-2xl gap-x-2">
    <div class="relative">
        <time class="absolute px-1 text-xs font-semibold text-white rounded bottom-2 right-2 bg-black/75" datetime="PT<?= $episode->audio->duration ?>S">
            <?= format_duration($episode->audio->duration) ?>
        </time>
        <img loading="lazy" src="<?= $episode->cover
                ->thumbnail_url ?>" alt="<?= $episode->title ?>" class="object-cover w-20 rounded-lg shadow-inner aspect-square" />
    </div>
    <div class="flex items-center flex-1 gap-x-4">
        <div class="flex flex-col flex-1">
            <div class="inline-flex items-center">
                <?= episode_numbering($episode->number, $episode->season_number, 'text-xs font-semibold border-subtle text-skin-muted px-1 border mr-2 !no-underline', true) ?>
                <?= relative_time($episode->published_at, 'text-xs whitespace-nowrap text-skin-muted') ?>
            </div>
            <h2 class="flex-1 font-semibold line-clamp-2"><a class="hover:underline" href="<?= $episode->link ?>"><?= $episode->title ?></a></h2>
        </div>
        <play-episode-button
            id="<?= $episode->id ?>"
            imageSrc="<?= $episode->cover->thumbnail_url ?>"
            title="<?= $episode->title ?>"
            podcast="<?= $episode->podcast->title ?>"
            src="<?= $episode->audio_file_web_url ?>"
            mediaType="<?= $episode->audio->file_content_type ?>"
            playLabel="<?= lang('Common.play_episode_button.play') ?>"
            playingLabel="<?= lang('Common.play_episode_button.playing') ?>"></play-episode-button>
    </div>
</article>
