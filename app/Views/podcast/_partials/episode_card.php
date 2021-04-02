<div class="flex">
    <img
    src="<?= $episode->image->thumbnail_url ?>"
    alt="<?= $episode->title ?>" class="w-24 h-24"/>
    <div class="flex flex-col flex-1">
        <a href="<?= $episode->link ?>" class="flex-1 px-4 py-2 bg-gray-100">
            <div class="flex items-baseline">
                <span class="flex-1 w-0 mr-2 font-semibold leading-none truncate"><?= $episode->title ?></span>
                <?= episode_numbering(
                    $episode->number,
                    $episode->season_number,
                    'text-xs font-semibold text-gray-600',
                    true,
                ) ?>
            </div>
            <div class="text-xs text-gray-800">
                <time
                itemprop="published"
                datetime="<?= $episode->published_at->format(DateTime::ATOM) ?>"
                title="<?= $episode->published_at ?>">
                <?= lang('Common.mediumDate', [$episode->published_at]) ?>
                </time>
                <span class="mx-1">•</span>
                <time datetime="PT<?= $episode->enclosure_duration ?>S">
                    <?= format_duration($episode->enclosure_duration) ?>
                </time>
            </div>
        </a>
        <audio controls preload="none" class="w-full mt-auto">
            <source
            src="<?= $episode->enclosure_web_url ?>"
            type="<?= $episode->enclosure_mimetype ?>">
            Your browser does not support the audio tag.
        </audio>
    </div>
</div>
