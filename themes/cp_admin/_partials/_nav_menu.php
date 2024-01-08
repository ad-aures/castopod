<nav class="flex flex-col flex-1 py-4 overflow-y-auto">
    <?php foreach ($navigation as $section => $data):
        $isSectionActive = false;
        $activeItem = '';
        foreach ($data['items'] as $item) {
            if (url_is(route_to($item, $podcastId ?? null, $episodeId ?? null))) {
                $activeItem = $item;
                $isSectionActive = true;
            }
        }
        ?>
    <details <?= $isSectionActive ? 'open="open"' : '' ?> class="<?= $isSectionActive ? 'bg-navigation-active' : '' ?> [&[open]>summary::after]:rotate-90">
        <summary class="inline-flex items-center w-full px-4 py-2 font-semibold focus:ring-accent focus:ring-inset after:w-5 after:h-5 after:transition-transform after:content-chevronRightIcon after:ml-2 after:opacity-60 after:text-white">
            <div class="inline-flex items-center mr-auto">
            <?= icon($data['icon'], 'opacity-60 text-2xl mr-4') ?>
            <?= lang($langKey . '.' . $section) ?>
            <?php if (array_key_exists('count', $data)): ?>
                <a href="<?= route_to($data['count-route'], $podcastId ?? null, $episodeId ?? null) ?>" class="px-2 ml-2 text-xs font-normal rounded-full focus:ring-accent <?= $isSectionActive ? 'bg-navigation' : 'bg-navigation-active' ?>"><?= $data['count'] ?></a>
                <?php endif; ?>
            </div>
            <?php if(array_key_exists('add-cta', $data)): ?>
                <a href="<?= route_to($data['add-cta'], $podcastId ?? null, $episodeId ?? null)  ?>" class="p-2 rounded-full shadow bg-accent-base focus:ring-accent" title="<?= lang($langKey . '.' . $data['add-cta']) ?>" data-tooltip="bottom">
                    <?= icon('add') ?>
                </a>
            <?php endif; ?>
        </summary>
        <ul class="flex flex-col pb-4">
            <?php foreach ($data['items'] as $item):
                $isActive = $item === $activeItem;

                $isAllowed = true;
                if (array_key_exists('items-permissions', $data) && array_key_exists($item, $data['items-permissions'])) {
                    if (isset($podcastId)) {
                        $isAllowed = can_podcast(auth()->user(), $podcastId, $data['items-permissions'][$item]);
                    } else {
                        $isAllowed = auth()->user()->can($data['items-permissions'][$item]);
                    }
                }
                ?>
            <li class="inline-flex">
                <a class="relative w-full py-3 pl-14 pr-2 text-sm hover:opacity-100 before:absolute before:opacity-0 before:w-5 before:h-5 hover:bg-navigation-active focus:ring-inset focus:ring-accent<?= $isActive
                        ? ' before:opacity-100 font-semibold inline-flex items-center'
                        : ' hover:before:opacity-60 focus:before:opacity-60' ?><?= $isAllowed
                        ? ' before:content-chevronRightIcon before:-ml-5'
                        : ' before:content-prohibitedIcon before:-ml-6 before:opacity-60 pointer-events-none' ?>" href="<?= route_to($item, $podcastId ?? null, $episodeId ?? null) ?>"><?= lang(
                            $langKey . '.' . $item,
                        ) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </details>
    <?php endforeach; ?>
</nav>
