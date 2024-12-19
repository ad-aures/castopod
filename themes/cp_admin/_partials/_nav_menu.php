<nav class="flex flex-col flex-1 py-4 overflow-y-auto">
    <?php foreach ($navigation as $section => $data):
        if ($data['items'] === []) {
            continue;
        }

        $activeSection = '';
        $activeItem = '';
        foreach ($data['items'] as $item) {
            $href = str_starts_with($item, '/') ? $item : route_to($item, $podcastId ?? null, $episodeId ?? null);
            // TODO: use glob to show active section when current url starts with item
            if (url_is($href)) {
                $activeItem = $item;
                $activeSection = $section;
            }
        }
        $isSectionActive = $section === $activeSection;
        ?>
    <details <?= $isSectionActive ? 'open="open"' : '' ?> class="<?= $isSectionActive ? 'bg-navigation-active' : '' ?> [&[open]>summary::after]:rotate-90">
        <summary class="inline-flex items-center w-full h-12 px-4 py-2 font-semibold after:w-5 after:h-5 after:transition-transform after:content-chevronRightIcon after:ml-2 after:opacity-60 after:text-white">
            <div class="inline-flex items-center mr-auto">
            <?= icon($data['icon'], [
                'class' => 'opacity-60 text-2xl mr-4',
            ]) ?>
            <?= lang($langKey . '.' . $section) ?>
            <?php if (array_key_exists('count', $data)): ?>
                <a href="<?= route_to($data['count-route'], $podcastId ?? null, $episodeId ?? null) ?>" class="px-2 ml-2 text-xs font-normal rounded-full <?= $activeSection ? 'bg-navigation' : 'bg-navigation-active' ?>"><?= $data['count'] ?></a>
                <?php endif; ?>
            </div>
            <?php if(array_key_exists('add-cta', $data)): ?>
                <a href="<?= route_to($data['add-cta'], $podcastId ?? null, $episodeId ?? null)  ?>" class="p-2 rounded-full shadow bg-accent-base" title="<?= lang($langKey . '.' . $data['add-cta']) ?>" data-tooltip="bottom">
                    <?= icon('add-fill') ?>
                </a>
            <?php endif; ?>
        </summary>
        <ul class="flex flex-col pb-4">
            <?php foreach ($data['items'] as $key => $item):
                $isActive = $item === $activeItem;

                $label = (array_key_exists('items-labels', $data) && array_key_exists($item, $data['items-labels'])) ? $data['items-labels'][$item] : lang($langKey . '.' . $item);
                $href = str_starts_with($item, '/') ? $item : route_to($item, $podcastId ?? null, $episodeId ?? null);

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
                <?php if ($isAllowed): ?> 
                    <a class="line-clamp-1 leading-9 relative w-full py-1 pl-14 pr-2 text-sm hover:opacity-100 before:content-chevronRightIcon before:absolute before:top-2 before:-ml-5 before:opacity-0 before:w-5 before:h-5 hover:bg-navigation-active<?= $isActive
                        ? ' before:opacity-100 font-semibold'
                        : ' hover:before:opacity-60 focus:before:opacity-60' ?>" href="<?= $href ?>"><?= $label ?></a>
                <?php else: ?>
                    <span data-tooltip="right" title="<?= lang('Navigation.not-authorized') ?>" class="relative w-full py-3 pr-2 text-sm cursor-not-allowed line-clamp-2 before:inset-y-0 before:my-auto pl-14 hover:opacity-100 before:absolute before:content-prohibitedIcon before:-ml-5 before:opacity-60 before:w-4 before:h-4 hover:bg-navigation-active"><?= $label ?></span>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </details>
    <?php endforeach; ?>
</nav>
