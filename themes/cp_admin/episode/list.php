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
                    return '<button id="more-dropdown-' . $episode->id . '" type="button" class="inline-flex items-center p-1 outline-none focus:ring" data-dropdown="button" data-dropdown-target="more-dropdown-' . $episode->id . '-menu" aria-haspopup="true" aria-expanded="false">' .
                        icon('more') .
                        '</button>' .
                        '<DropdownMenu id="more-dropdown-' . $episode->id . '-menu" labelledby="more-dropdown-' . $episode->id . '" items="' . esc(json_encode([
                            [
                                'type' => 'link',
                                'title' => lang('Episode.edit'),
                                'uri' => route_to('episode-edit', $podcast->id, $episode->id),
                            ],
                            [
                                'type' => 'link',
                                'title' => lang('Episode.embeddable_player.title'),
                                'uri' => route_to('embeddable-player-add', $podcast->id, $episode->id),
                            ],
                            [
                                'type' => 'link',
                                'title' => lang('Person.persons'),
                                'uri' => route_to('episode-persons-manage', $podcast->id, $episode->id),
                            ],
                            [
                                'type' => 'link',
                                'title' => lang('Episode.soundbites'),
                                'uri' => route_to('soundbites-edit', $podcast->id, $episode->id),
                            ],
                            [
                                'type' => 'link',
                                'title' => lang('Episode.go_to_page'),
                                'uri' => route_to('episode', $podcast->handle, $episode->slug),
                            ],
                            [
                                'type' => 'separator',
                            ],
                            [
                                'type' => 'link',
                                'title' => lang('Episode.delete'),
                                'uri' => route_to('episode-delete', $podcast->id, $episode->id),
                                'class' => 'font-semibold text-red-600',
                            ],
                        ])) . '" />';
                },
            ],
        ],
        $episodes,
        'mb-6',
        $podcast
    ) ?>

<?= $pager->links() ?>

<?= $this->endSection() ?>
