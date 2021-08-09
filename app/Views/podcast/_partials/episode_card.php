<article class="w-full mb-4 bg-white rounded-lg shadow">
    <div class="flex p-4">
        <div class="relative mr-2">
            <time class="absolute px-1 text-xs font-semibold text-white rounded bottom-2 right-2 bg-black/50" datetime="PT<?= $episode->audio_file_duration ?>S">
                <?= format_duration(
                    $episode->audio_file_duration,
                ) ?>
            </time>
            <img loading="lazy" src="<?= $episode->image
            ->thumbnail_url ?>" alt="<?= $episode->title ?>" class="object-cover w-20 h-20 rounded-lg" />
        </div>
        <div class="flex flex-col flex-1">
            <a class="flex justify-between text-sm" href="<?= $episode->link ?>">
                <h2 class="flex-1 font-semibold hover:underline">
                    <?= episode_numbering(
                        $episode->number,
                        $episode->season_number,
                        'text-xs font-semibold text-gray-600',
                        true,
                    ) ?>
                    <span class="mx-1">-</span>
                    <?= $episode->title ?>
                </h2>
                <time class="text-xs whitespace-nowrap" itemprop="published" datetime="<?= $episode->published_at->format(DateTime::ATOM,) ?>" title="<?= $episode->published_at ?>">
                    <?= lang('Common.mediumDate', [
                        $episode->published_at,
                    ]) ?>
                </time>
            </a>
            <div class="flex mt-auto gap-x-4">
                <?= play_episode_button($episode->id, $episode->image->thumbnail_url, $episode->title, $podcast->title, $episode->audio_file_web_url, $episode->audio_file_mimetype, 'mt-auto') ?>
                <?= anchor(
                    route_to('episode', $podcast->handle, $episode->slug),
                    icon('chat', 'text-xl mr-1 text-gray-400') .
                    $episode->statuses_total,
                    [
                        'class' =>
                        'inline-flex items-center hover:underline',
                        'title' => lang('Episode.total_statuses', [
                            'numberOfTotalStatuses' => $episode->statuses_total,
                        ]),
                    ],
                    ) ?>
            </div>
        </div>
    </div>
</article>