<section class="flex flex-col">
    <header class="flex justify-between py-2">
        <Heading tagName="h2"><?= lang('Podcast.latest_episodes') ?></Heading>
        <a href="<?= route_to(
    'episode-list',
    $podcast->id,
) ?>" class="inline-flex items-center text-sm underline hover:no-underline">
            <?= lang('Podcast.see_all_episodes') ?>
            <?= icon('chevron-right', 'ml-2') ?>
        </a>
    </header>
    <?php if ($episodes): ?>
        <div class="flex p-2 overflow-x-auto gap-x-6 snap snap-x snap-proximity">
        <?php foreach ($episodes as $episode): ?>
            <article class="snap-center flex flex-col flex-shrink-0 flex-1 w-full min-w-[12rem] max-w-[17rem] overflow-hidden bg-white border-2 border-pine-100 rounded-xl">
                <div class="relative">
                    <?= publication_pill(
    $episode->published_at,
    $episode->publication_status,
    'absolute top-2 right-2 text-sm'
); ?>
                    <img
                    src="<?= $episode->image->medium_url ?>"
                    alt="<?= $episode->title ?>" class="object-cover w-full" />
                </div>
                <div class="flex items-start justify-between p-2">
                    <div class="flex flex-col min-w-0">
                        <a href="<?= route_to(
    'episode-view',
    $podcast->id,
    $episode->id,
) ?>"
                        class="text-sm font-semibold truncate hover:underline focus:ring-castopod"
                        >
                        <?= episode_numbering(
    $episode->number,
    $episode->season_number,
    'text-xs font-semibold text-gray-600 !no-underline border px-1 border-gray-500 mr-1',
    true,
) . $episode->title ?>
                        </a>
                    </div>
                    <button
                        type="button"
                        class="inline-flex items-center p-1 focus:ring-castopod"
                        id="more-dropdown-<?= $episode->id ?>"
                        data-dropdown="button"
                        data-dropdown-target="more-dropdown-<?= $episode->id ?>-menu"
                        aria-label="<?= lang('Common.more') ?>"
                        aria-haspopup="true"
                        aria-expanded="false"
                        ><?= icon('more') ?></button>
                    <DropdownMenu id="more-dropdown-<?= $episode->id ?>-menu" labelledby="more-dropdown-<?= $episode->id ?>" items="<?= esc(json_encode([
                        [
                            'type' => 'link',
                            'title' => lang('Episode.edit'),
                            'uri' => route_to('episode-edit', $podcast->id, $episode->id),
                        ],
                        [
                            'type' => 'link',
                            'title' => lang('Episode.embed.title'),
                            'uri' => route_to('embed-add', $podcast->id, $episode->id),
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
                    ])) ?>" />
                </div>
            </article>
        <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="italic"><?= lang('Podcast.no_episode') ?></p>
    <?php endif; ?>
</section>
