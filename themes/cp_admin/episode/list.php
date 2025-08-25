<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.all_podcast_episodes') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php // @icon("add-fill")?>
<x-Button uri="<?= route_to('episode-create', $podcast->id) ?>" variant="primary" iconLeft="add-fill"><?= lang('Episode.create') ?></x-Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="flex flex-wrap items-center justify-between">
    <p class="text-sm italic text-skin-muted">
        <span class="font-semibold"><?= lang('Episode.list.number_of_episodes', [
            'numberOfEpisodes' => $pager->getDetails()['total'],
        ]) ?></span><br />
        <?= lang('Common.pageInfo', [
            'currentPage' => $pager->getDetails()['currentPage'],
            'pageCount'   => $pager->getDetails()['pageCount'],
        ]) ?>
    </p>
    <form class="relative flex">
        <div class="relative">
            <x-Forms.Input name="q" placeholder="<?= lang('Episode.list.search.placeholder') ?>" value="<?= esc($query) ?>" class="<?= $query ? 'pr-8' : '' ?>" />
            <?php if ($query): ?>
                <a href="<?= route_to('episode-list', $podcast->id) ?>" class="absolute inset-y-0 right-0 inline-flex items-center justify-center px-2 opacity-75 hover:opacity-100 focus:opacity-100" title="<?= lang('Episode.list.search.clear') ?>" data-tooltip="bottom"><?= icon('close-fill', [
                    'class' => 'text-lg',
                ]) ?></a>
            <?php endif; ?>
        </div>
        <x-Button type="submit" variant="secondary" class="px-3 ml-2 rounded-lg shadow-md" title="<?= lang('Episode.list.search.submit') ?>" data-tooltip="bottom" isSquared="true"><?= icon('search-fill', [
            'class' => 'text-xl',
        ]) ?></x-Button>
    </form>
</div>

<?= data_table(
    [
        [
            'header' => lang('Episode.list.episode'),
            'cell'   => function ($episode, $podcast) {
                $premiumBadge = '';
                if ($episode->is_premium) {
                    $premiumBadge = icon('exchange-dollar-fill', [
                        'class' => 'absolute left-0 w-8 pl-2 text-2xl rounded-r-full rounded-tl-lg top-2 text-accent-contrast bg-accent-base',
                    ]);
                }

                return '<div class="flex gap-x-2">' .
                    '<div class="relative flex-shrink-0">' .
                        '<time class="absolute px-1 text-xs font-semibold text-white rounded bottom-2 right-2 bg-black/50" datetime="PT' . round($episode->audio->duration, 3) . 'S">' .
                            format_duration(
                                (int) $episode->audio->duration,
                            ) .
                        '</time>' .
                        $premiumBadge .
                        '<img src="' . $episode->cover->thumbnail_url . '" alt="' . esc($episode->title) . '" class="object-cover w-20 rounded-lg shadow-inner aspect-square" loading="lazy" />' .
                    '</div>' .
                    '<a class="overflow-x-hidden text-sm hover:underline" href="' . route_to(
                        'episode-view',
                        $podcast->id,
                        $episode->id,
                    ) . '">' .
                    '<h2 class="inline-flex items-baseline w-full font-semibold gap-x-1 group">' .
                    episode_numbering(
                        $episode->number,
                        $episode->season_number,
                        'text-xs font-semibold text-skin-muted !no-underline border px-1 border-gray-500',
                        true,
                    ) .
                    '<span class="mr-1 truncate group-hover:underline">' . esc($episode->title) . '</span>' .
                    '</h2>' .
                    '<p class="text-xs whitespace-pre-wrap w-80 text-skin-muted line-clamp-2">' . $episode->description . '</p>' .
                    '</a>' .
                    '</div>';
            },
        ],
        [
            'header' => lang('Episode.list.visibility'),
            'cell'   => function ($episode): string {
                return publication_pill(
                    $episode->published_at,
                    $episode->publication_status,
                    'text-sm',
                );
            },
        ],
        [
            'header' => lang('Episode.list.downloads'),
            'cell'   => function ($episode): string {
                return downloads_abbr($episode->downloads_count);
            },
        ],
        [
            'header' => lang('Episode.list.comments'),
            'cell'   => function ($episode): int {
                return $episode->comments_count;
            },
        ],
        [
            'header' => lang('Episode.list.actions'),
            'cell'   => function ($episode, $podcast) {
                $items = [
                    [
                        'type'  => 'link',
                        'title' => lang('Episode.go_to_page'),
                        'uri'   => route_to('episode', esc($podcast->handle), esc($episode->slug)),
                    ],
                    [
                        'type'  => 'link',
                        'title' => lang('Episode.edit'),
                        'uri'   => route_to('episode-edit', $podcast->id, $episode->id),
                    ],
                    [
                        'type'  => 'link',
                        'title' => lang('Episode.embed.title'),
                        'uri'   => route_to('embed-add', $podcast->id, $episode->id),
                    ],
                    [
                        'type'  => 'link',
                        'title' => lang('Person.persons'),
                        'uri'   => route_to('episode-persons-manage', $podcast->id, $episode->id),
                    ],
                    [
                        'type'  => 'link',
                        'title' => lang('VideoClip.list.title'),
                        'uri'   => route_to('video-clips-list', $episode->podcast->id, $episode->id),
                    ],
                    [
                        'type'  => 'link',
                        'title' => lang('Soundbite.list.title'),
                        'uri'   => route_to('soundbites-list', $podcast->id, $episode->id),
                    ],
                    [
                        'type' => 'separator',
                    ],
                ];
                if ($episode->published_at === null) {
                    $items[] = [
                        'type'  => 'link',
                        'title' => lang('Episode.delete'),
                        'uri'   => route_to('episode-delete', $podcast->id, $episode->id),
                        'class' => 'font-semibold text-red-600',
                    ];
                } else {
                    $label = lang('Episode.delete');
                    $icon = icon('forbid-fill');
                    $title = lang('Episode.messages.unpublishBeforeDeleteTip');
                    $items[] = [
                        'type'    => 'html',
                        'content' => esc(<<<HTML
                        <span class="inline-flex items-center px-4 py-1 font-semibold text-gray-400 cursor-not-allowed" data-tooltip="bottom" title="{$title}">{$icon}<span class="ml-2">{$label}</span></span>
                    HTML),
                    ];
                }
                return '<button id="more-dropdown-' . $episode->id . '" type="button" class="inline-flex items-center p-1 rounded-full" data-dropdown="button" data-dropdown-target="more-dropdown-' . $episode->id . '-menu" aria-haspopup="true" aria-expanded="false">' .
                    icon('more-2-fill') .
                    '</button>' .
                    '<x-DropdownMenu id="more-dropdown-' . $episode->id . '-menu" labelledby="more-dropdown-' . $episode->id . '" offsetY="-24" items="' . esc(json_encode($items)) . '" />';
            },
        ],
    ],
    $episodes,
    'mb-6 mt-4',
    $podcast,
) ?>

<?= $pager->links() ?>

<?= $this->endSection() ?>
