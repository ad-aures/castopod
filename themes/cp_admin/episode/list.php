<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.all_podcast_episodes') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.all_podcast_episodes') ?> (<?= $pager->getDetails()['total'] ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button uri="<?= route_to('episode-create', $podcast->id) ?>" variant="primary" iconLeft="add"><?= lang('Episode.create') ?></Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<p class="mb-4 text-sm italic text-gray-700">
    <?= lang('Common.pageInfo', [
        'currentPage' => $pager->getDetails()['currentPage'],
        'pageCount' => $pager->getDetails()['pageCount'],
    ]) ?>
</p>

<?= data_table(
        [
            [
                'header' => lang('Episode.list.episode'),
                'cell' => function ($episode, $podcast) {
                    return '<div class="flex">' .
                        '<div class="relative flex-shrink-0 mr-2">' .
                            '<time class="absolute px-1 text-xs font-semibold text-white rounded bottom-2 right-2 bg-black/50" datetime="PT<?= $episode->audio_file_duration ?>S">' .
                                format_duration(
                                    $episode->audio_file_duration,
                                ) .
                            '</time>' .
                            '<img loading="lazy" src="' . $episode->image->thumbnail_url . '" alt="' . $episode->title . '" class="object-cover w-20 h-20 rounded-lg" />' .
                        '</div>' .
                        '<a class="text-sm hover:underline" href="' . route_to(
                            'episode-view',
                            $podcast->id,
                            $episode->id,
                        ) . '">' .
                        '<h2 class="inline-flex w-full font-semibold leading-none group">' .
                        episode_numbering(
                            $episode->number,
                            $episode->season_number,
                            'text-xs font-semibold text-gray-600',
                            true,
                        ) .
                        '<span class="mx-1">-</span>' .
                        '<span class="mr-1 group-hover:underline">' . $episode->title . '</span>' .
                        '</h2>' .
                        '<p class="max-w-sm text-xs text-gray-600 line-clamp-2">' . $episode->description . '</p>' .
                        '</a>' .
                        '</div>';
                },
            ],
            [
                'header' => lang('Episode.list.visibility'),
                'cell' => function ($episode): string {
                    return publication_pill(
                        $episode->published_at,
                        $episode->publication_status,
                    );
                },
            ],
            [
                'header' => lang('Episode.list.comments'),
                'cell' => function ($episode): int {
                    return $episode->comments_count;
                },
            ],
            [
                'header' => lang('Episode.list.actions'),
                'cell' => function ($episode, $podcast) {
                    return '<button id="more-dropdown-<?= $episode->id ?>" type="button" class="inline-flex items-center p-1 outline-none focus:ring" data-dropdown="button" data-dropdown-target="more-dropdown-<?= $episode->id ?>-menu" aria-haspopup="true" aria-expanded="false">' .
                        icon('more') .
                        '</button>' .
                        '<nav id="more-dropdown-<?= $episode->id ?>-menu" class="flex flex-col py-2 text-black whitespace-no-wrap bg-white border rounded shadow" aria-labelledby="more-dropdown-<?= $episode->id ?>" data-dropdown="menu" data-dropdown-placement="bottom-start" data-dropdown-offset-x="0" data-dropdown-offset-y="-24">' .
                        '<a class="px-4 py-1 hover:bg-gray-100" href="' . route_to(
                            'episode-edit',
                            $podcast->id,
                            $episode->id,
                        ) . '">' . lang('Episode.edit') . '</a>' .
                        '<a class="px-4 py-1 hover:bg-gray-100" href="' . route_to(
                            'embeddable-player-add',
                            $podcast->id,
                            $episode->id,
                        ) . '">' . lang(
                            'Episode.embeddable_player.add',
                        ) . '</a>' .
                        '<a class="px-4 py-1 hover:bg-gray-100" href="' . route_to(
                            'episode-persons-manage',
                            $podcast->id,
                            $episode->id,
                        ) . '">' . lang('Person.persons') . '</a>' .
                        '<a class="px-4 py-1 hover:bg-gray-100" href="' . route_to(
                            'soundbites-edit',
                            $podcast->id,
                            $episode->id,
                        ) . '">' . lang('Episode.soundbites') . '</a>' .
                        '<a class="px-4 py-1 hover:bg-gray-100" href="' . route_to(
                            'episode',
                            $podcast->handle,
                            $episode->slug,
                        ) . '">' . lang('Episode.go_to_page') . '</a>' .
                        '<a class="px-4 py-1 hover:bg-gray-100" href="' . route_to(
                            'episode-delete',
                            $podcast->id,
                            $episode->id,
                        ) . '">' . lang('Episode.delete') . '</a>' .
                        '</nav>' .
                        '</div>';
                },
            ],
        ],
        $episodes,
        'mb-6',
        $podcast
    ) ?>

<?= $pager->links() ?>

<?= $this->endSection() ?>
