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
                        class="text-sm font-semibold truncate hover:underline"
                        >
                        <?= episode_numbering(
    $episode->number,
    $episode->season_number,
    'font-semibold text-gray-600',
    true,
) ?>
                        <span class="mx-1">-</span>
                        <?= $episode->title ?>
                        </a>
                    </div>
                    <button
                        type="button"
                        class="inline-flex items-center p-1 outline-none focus:ring"
                        id="more-dropdown-<?= $episode->id ?>"
                        data-dropdown="button"
                        data-dropdown-target="more-dropdown-<?= $episode->id ?>-menu"
                        aria-label="<?= lang('Common.more') ?>"
                        aria-haspopup="true"
                        aria-expanded="false"
                        ><?= icon('more') ?></button>
                    <nav
                        id="more-dropdown-<?= $episode->id ?>-menu"
                        class="z-50 flex flex-col py-2 text-black whitespace-no-wrap bg-white border rounded shadow"
                        aria-labelledby="more-dropdown-<?= $episode->id ?>"
                        data-dropdown="menu"
                        data-dropdown-placement="bottom">
                            <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
    'episode-edit',
    $podcast->id,
    $episode->id,
) ?>"><?= lang('Episode.edit') ?></a>
                            <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
    'embeddable-player-add',
    $podcast->id,
    $episode->id,
) ?>"><?= lang(
    'Episode.embeddable_player.title',
) ?></a>
                            <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
    'episode-persons-manage',
    $podcast->id,
    $episode->id,
) ?>"><?= lang('Person.persons') ?></a>
                            <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
    'episode',
    $podcast->handle,
    $episode->slug,
) ?>"><?= lang('Episode.go_to_page') ?></a>
                            <hr class="my-2 border border-gray-100">
                            <a class="px-4 py-1 font-semibold text-red-600 hover:bg-gray-100" href="<?= route_to(
    'episode-delete',
    $podcast->id,
    $episode->id,
) ?>"><?= lang('Episode.delete') ?></a>
                    </nav>
                </div>
            </article>
        <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="italic"><?= lang('Podcast.no_episode') ?></p>
    <?php endif; ?>
</section>
