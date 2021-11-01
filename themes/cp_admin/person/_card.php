<article class="relative h-full overflow-hidden transition bg-white shadow border-3 border-pine-100 rounded-xl group hover:shadow-xl focus-within:shadow-xl focus-within:ring-castopod">
    <a href="<?= route_to('person-view', $person->id) ?>" class="flex flex-col justify-end w-full h-full text-white group">
        <div class="absolute bottom-0 left-0 z-10 w-full h-full backdrop-gradient"></div>
        <div class="w-full h-full overflow-hidden">
            <img alt="<?= $person->full_name ?>" src="<?= $person->avatar->medium_url ?>" class="object-cover w-full h-full transition duration-200 ease-in-out transform group-focus:scale-105 group-hover:scale-105" />
        </div>
        <div class="absolute z-20">
            <h2 class="px-4 py-2 font-semibold leading-tight"><?= $person->full_name ?></h2>
        </div>
    </a>
    <button class="absolute top-0 right-0 z-10 p-2 mt-2 mr-2 text-white transition -translate-y-12 rounded-full opacity-0 focus:ring-castopod focus:opacity-100 focus:-translate-y-0 group-hover:translate-y-0 bg-black/50 group-hover:opacity-100" id="more-dropdown-<?= $person->id ?>" data-dropdown="button" data-dropdown-target="more-dropdown-<?= $person->id ?>-menu" aria-haspopup="true" aria-expanded="false" title="<?= lang('Common.more') ?>"><?= icon('more') ?></button>
    <DropdownMenu id="more-dropdown-<?= $person->id ?>-menu" labelledby="more-dropdown-<?= $person->id ?>" offsetY="-32" items="<?= esc(json_encode([
        [
            'type' => 'link',
            'title' => lang('Person.view'),
            'uri' => route_to('person-view', $person->id),
        ],
        [
            'type' => 'link',
            'title' => lang('Person.edit'),
            'uri' => route_to('person-edit', $person->id),
        ],
        [
            'type' => 'separator',
        ],
        [
            'type' => 'link',
            'title' => lang('Person.delete'),
            'uri' => route_to('person-delete', $person->id),
            'class' => 'font-semibold text-red-600',
        ],
    ])) ?>" />
</article>