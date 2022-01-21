<article class="relative h-full overflow-hidden transition shadow bg-elevated border-3 border-subtle group rounded-xl hover:shadow-xl focus-within:shadow-xl focus-within:ring-accent">
    <a href="<?= route_to('podcast-view', $podcast->id) ?>" class="flex flex-col justify-end w-full h-full text-white group">
        <div class="absolute bottom-0 left-0 z-10 w-full h-full backdrop-gradient mix-blend-multiply"></div>
        <div class="w-full h-full overflow-hidden bg-header">
            <img
            alt="<?= $podcast->title ?>"
            src="<?= $podcast->cover->medium_url ?>" class="object-cover w-full h-full transition duration-200 ease-in-out transform aspect-square group-focus:scale-105 group-hover:scale-105" loading="lazy" />
        </div>
        <div class="absolute z-20 w-full px-4 pb-4 transition duration-75 ease-out translate-y-6 group-focus:translate-y-0 group-hover:translate-y-0">
            <h2 class="font-bold leading-none truncate font-display"><?= $podcast->title ?></h2>
            <p class="text-sm transition duration-150 opacity-0 group-focus:opacity-100 group-hover:opacity-100">@<?= $podcast->handle ?></p>
        </div>
    </a>
    <button class="absolute top-0 right-0 z-10 p-2 mt-2 mr-2 text-white transition -translate-y-12 rounded-full opacity-0 focus:ring-accent focus:opacity-100 focus:-translate-y-0 group-hover:translate-y-0 bg-black/50 group-hover:opacity-100" id="more-dropdown-<?= $podcast->id ?>" data-dropdown="button" data-dropdown-target="more-dropdown-<?= $podcast->id ?>-menu" aria-haspopup="true" aria-expanded="false" title="<?= lang('Common.more') ?>"><?= icon('more') ?></button>
    <DropdownMenu id="more-dropdown-<?= $podcast->id ?>-menu" labelledby="more-dropdown-<?= $podcast->id ?>" offsetY="-32" items="<?= esc(json_encode([
        [
            'type' => 'link',
            'title' => lang('Podcast.view'),
            'uri' => route_to('podcast-view', $podcast->id),
        ],
        [
            'type' => 'link',
            'title' => lang('Podcast.edit'),
            'uri' => route_to('podcast-edit', $podcast->id),
        ],
    ])) ?>" />
</article>
