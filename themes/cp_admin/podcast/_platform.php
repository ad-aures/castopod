<article class="relative flex-col items-start p-4 rounded-lg bg-elevated border-3 <?= $platform->link_url ? 'border-accent-base' : 'border-subtle' ?>">
    <?= $platform->link_url ? anchor(
        route_to(
            'podcast-platform-remove',
            $platform->podcast_id,
            $platform->type,
            $platform->slug,
        ),
        icon('delete-bin-fill', [
            'class' => 'mx-auto',
        ]),
        [
            'class'        => 'absolute right-0 top-0 -mt-4 -mr-4 p-2 border-red-700 border-2 bg-red-100 rounded-full text-red-700 hover:text-red-900',
            'data-tooltip' => 'bottom',
            'title'        => lang('Platforms.remove', [
                'platformName' => $platform->label,
            ]),
        ],
    )
        : '' ?>
    <div class="flex items-center gap-x-2">
        <?= icon(
            sprintf('%s:%s', $platform->type, $platform->slug),
            [
                'class' => 'text-skin-muted text-4xl',
            ],
        ) ?>
        <h2 class="text-xl font-semibold"><?= $platform->label ?></h2>
    </div>
    <div class="flex flex-col flex-1 mt-4">
            <div class="inline-flex ml-8 -mt-6 gap-x-1">
                <a
                href="<?= $platform->home_url ?>" class="px-3 py-1 text-xs font-semibold leading-6 underline rounded-full text-accent-base hover:no-underline"
                target="_blank" rel="noopener noreferrer" title="<?= lang('Platforms.home_url', [
                    'platformName' => $platform->label,
                ]) ?>" data-tooltip="bottom"><?= lang('Platforms.website') ?></a>
                <?php if ($platform->submit_url !== null): ?>
                    <a
                    href="<?= $platform->submit_url ?>" class="px-3 py-1 text-xs font-semibold leading-6 underline rounded-full text-accent-base hover:no-underline"
                    target="_blank" rel="noopener noreferrer" title="<?= lang('Platforms.submit_url', [
                        'platformName' => $platform->label,
                    ]) ?>" data-tooltip="bottom"><?= lang('Platforms.register') ?></a>
                <?php endif; ?>
            </div>
            <fieldset class="flex flex-col">
                <x-Forms.Field
                    label="<?= esc(lang('Platforms.your_link')) ?>"
                    class="w-full mt-4"
                    id="<?= esc($platform->slug) . '_link_url' ?>"
                    name="<?= 'platforms[' . esc($platform->slug) . '][url]' ?>"
                    value="<?= esc($platform->link_url) ?>"
                    type="url"
                    placeholder="https://…" />
                <x-Forms.Field
                    label="<?= esc(lang("Platforms.your_id.{$platform->type}")) ?>"
                    class="w-full mt-2"
                    id="<?= esc($platform->slug) . '_account_id' ?>"
                    name="<?= 'platforms[' . esc($platform->slug) . '][account_id]' ?>"
                    value="<?= esc($platform->account_id) ?>"
                    placeholder="<?= lang("Platforms.description.{$platform->type}") ?>" />
                <x-Forms.Toggler size="small" class="mt-4 text-sm" id="<?= esc($platform->slug) . '_visible' ?>" name="<?= 'platforms[' . esc($platform->slug) . '][visible]'?>" value="<?= $platform->is_visible ? 'yes' : '' ?>"><?= lang('Platforms.visible') ?></x-Forms.Toggler>
        </fieldset>
    </div>
</article>
