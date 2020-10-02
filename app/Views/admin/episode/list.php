<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.all_podcast_episodes') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.all_podcast_episodes') ?> (<?= $pager->getDetails()[
     'total'
 ] ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= button(
    lang('Episode.create'),
    route_to('episode-create', $podcast->id),

    ['variant' => 'primary', 'iconLeft' => 'add']
) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<p class="mb-4 text-sm italic text-gray-700"><?= lang('Common.pageInfo', [
    'currentPage' => $pager->getDetails()['currentPage'],
    'pageCount' => $pager->getDetails()['pageCount'],
]) ?></p>
<div class="flex flex-wrap mb-6">
    <?php if ($episodes): ?>
        <?php foreach ($episodes as $episode): ?>
            <article class="flex w-full max-w-lg p-4 mx-auto">
                <img
                loading="lazy"
                src="<?= $episode->image->thumbnail_url ?>"
                alt="<?= $episode->title ?>" class="object-cover w-20 h-20 mr-2 rounded-lg" />
                <div class="flex flex-col flex-1">
                    <div class="flex">
                        <a class="flex-1 text-sm hover:underline" href="<?= route_to(
                            'episode-view',
                            $podcast->id,
                            $episode->id
                        ) ?>">
                            <h2 class="inline-flex justify-between w-full font-bold leading-none group">
                                <span class="mr-1 group-hover:underline"><?= $episode->title ?></span>
                                <?php if (
                                    $episode->season_number &&
                                    $episode->number
                                ): ?>
                                <abbr class="text-xs font-bold text-gray-600" title="<?= lang(
                                    'Episode.season_episode',
                                    [
                                        'seasonNumber' =>
                                            $episode->season_number,
                                        'episodeNumber' => $episode->number,
                                    ]
                                ) ?>"><?= lang('Episode.season_episode_abbr', [
    'seasonNumber' => $episode->season_number,
    'episodeNumber' => $episode->number,
]) ?></abbr>
                                <?php elseif (
                                    !$episode->season_number &&
                                    $episode->number
                                ): ?>
                                    <abbr class="text-xs font-bold text-gray-600" title="<?= lang(
                                        'Episode.number',
                                        [
                                            'episodeNumber' => $episode->number,
                                        ]
                                    ) ?>"><?= lang('Episode.number_abbr', [
    'episodeNumber' => $episode->number,
]) ?></abbr>
                                <?php endif; ?>
                            </h2>
                        </a>
                        <div class="relative" data-toggle="dropdown">
                            <button type="button" class="inline-flex items-center p-1 outline-none focus:shadow-outline" id="moreDropdown" data-popper="button" aria-haspopup="true" aria-expanded="false">
                                <?= icon('more') ?>
                            </button>
                            <nav class="absolute z-10 flex-col hidden py-2 text-black whitespace-no-wrap bg-white border rounded shadow" aria-labelledby="moreDropdown" data-popper="menu" data-popper-placement="bottom-end" data-popper-offset-x="0" data-popper-offset-y="-24" >
                                    <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
                                        'episode-edit',
                                        $podcast->id,
                                        $episode->id
                                    ) ?>"><?= lang('Episode.edit') ?></a>
                                    <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
                                        'episode',
                                        $podcast->name,
                                        $episode->slug
                                    ) ?>"><?= lang('Episode.go_to_page') ?></a>
                                    <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
                                        'episode-delete',
                                        $podcast->id,
                                        $episode->id
                                    ) ?>"><?= lang('Episode.delete') ?></a>
                            </nav>
                        </div>
                    </div>
                    <div class="mb-2 text-xs">
                        <time
                        pubdate
                        datetime="<?= $episode->published_at->toDateTimeString() ?>"
                        title="<?= $episode->published_at ?>">
                        <?= lang('Common.mediumDate', [
                            $episode->published_at,
                        ]) ?>
                        </time>
                        <span class="mx-1">•</span>
                        <time datetime="PT<?= $episode->enclosure_duration ?>S">
                            <?= lang('Common.duration', [
                                $episode->enclosure_duration,
                            ]) ?>
                        </time>
                    </div>
                    <audio controls preload="none" class="w-full mt-auto">
                        <source src="/<?= $episode->enclosure_media_path ?>" type="<?= $episode->enclosure_type ?>">
                        Your browser does not support the audio tag.
                    </audio>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="italic"><?= lang('Podcast.no_episode') ?></p>
    <?php endif; ?>
</div>

<?= $pager->links() ?>

<?= $this->endSection()
?>
