<div class="flex">
    <div class="relative">
        <time class="absolute px-1 text-sm font-semibold text-white bg-black/50 bottom-2 right-2" datetime="PT<?= $episode->audio_file_duration ?>S">
                    <?= format_duration($episode->audio_file_duration) ?>
        </time>
        <img
        src="<?= $episode->image->thumbnail_url ?>"
        alt="<?= $episode->title ?>" class="w-24 h-24"/>
    </div>
    <div class="flex flex-col flex-1 px-4 py-2 border-t border-b">
        <a href="<?= $episode->link ?>" class="flex justify-between flex-1">
            <div class="flex items-baseline font-semibold">
                <?= episode_numbering(
                    $episode->number,
                    $episode->season_number,
                    'text-xs font-semibold text-gray-600',
                    true,
                ) ?>
                <span class="mx-1">-</span>
                <?= $episode->title ?>
            </div>
            <time
                class="text-xs"
                itemprop="published"
                datetime="<?= $episode->published_at->format(DateTime::ATOM) ?>"
                title="<?= $episode->published_at ?>">
                <?= lang('Common.mediumDate', [$episode->published_at]) ?>
            </time> 
        </a>
        <?= play_episode_button($episode->id, $episode->image->thumbnail_url, $episode->title, $podcast->title, $episode->audio_file_web_url, $episode->audio_file_mimetype, 'mt-auto') ?>
    </div>
</div>
