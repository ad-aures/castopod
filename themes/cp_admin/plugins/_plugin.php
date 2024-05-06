<article class="flex flex-col p-4 rounded-xl relative bg-elevated border-3 <?= $plugin->isActive() ? 'border-accent-base' : 'border-subtle' ?>">
    <?php if ($plugin->getSettings() !== []): ?>
        <?php // @icon('equalizer-fill')?>
        <IconButton class="absolute top-0 right-0 mt-4 mr-4" uri="<?= route_to('plugins-general-settings', $plugin->getKey()) ?>" glyph="equalizer-fill"><?= lang('Plugins.settings', [
            'pluginName' => $plugin->getName(),
        ]) ?></IconButton>
    <?php endif; ?>
    <img class="rounded-full min-w-16 max-w-16 aspect-square" src="<?= $plugin->getIconSrc() ?>">
    <div class="flex flex-col items-start mt-2">
        <h2 class="flex items-center text-xl font-bold font-display gap-x-2"><?= $plugin->getName() ?><span class="px-1 font-mono text-xs rounded-full bg-subtle"><?= $plugin->getVersion() ?></span></h2>
        <p class="font-mono text-xs tracking-wide bg-gray-100"><a href="<?= route_to('plugins-vendor', $plugin->getVendor()) ?>" class="underline underline-offset-2 decoration-2 decoration-dotted hover:decoration-solid decoration-accent"><?= $plugin->getVendor() ?></a>/<?= $plugin->getPackage() ?></p>
        <p class="mt-2 text-gray-600"><?= $plugin->getDescription() ?></p>
    </div>
    <footer class="flex items-center justify-between mt-4">
        <a href="<?= $plugin->getHomepage() ?>" class="inline-flex items-center text-sm font-semibold underline hover:no-underline gap-x-1" target="_blank" rel="noopener noreferrer"><?= icon('link', [
            'class' => 'text-gray-500',
        ]) . lang('Plugins.website') ?></a>
        <div class="flex gap-x-2">
            <?php if($plugin->isActive()): ?>
                <form class="flex justify-end" method="POST" action="<?= route_to('plugins-deactivate', $plugin->getKey()) ?>">
                    <?= csrf_field() ?>
                    <Button type="submit" variant="danger" size="small"><?= lang('Plugins.deactivate') ?></Button>
                </form>
            <?php else: ?>
                <form class="flex justify-end" method="POST" action="<?= route_to('plugins-activate', $plugin->getKey()) ?>">
                    <?= csrf_field() ?>
                    <Button type="submit" variant="secondary" size="small"><?= lang('Plugins.activate') ?></Button>
                </form>
            <?php endif; ?>
            <button class="p-2 rounded-full" id="more-dropdown-<?= $plugin->getKey() ?>" data-dropdown="button" data-dropdown-target="more-dropdown-<?= $plugin->getKey() ?>-menu" aria-haspopup="true" aria-expanded="false" title="<?= lang('Common.more') ?>"><?= icon('more-2-fill') ?></button>
            <?php $items = [[
                'type'  => 'link',
                'title' => icon('delete-bin-fill', [
                    'class' => 'text-gray-500',
                ]) . lang('Plugins.uninstall'),
                'uri'   => route_to('plugins-uninstall', $plugin->getKey()),
                'class' => 'font-semibold text-red-600',
            ]]; ?>
            <DropdownMenu id="more-dropdown-<?= $plugin->getKey() ?>-menu" labelledby="more-dropdown-<?= $plugin->getKey() ?>" placement="top-end" offsetY="-32" items="<?= esc(json_encode($items)) ?>" />
        </div>
    </footer>
</article>