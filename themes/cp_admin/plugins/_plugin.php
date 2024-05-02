<article class="flex flex-col p-4 rounded-xl relative bg-elevated border-3 <?= $plugin->isActive() ? 'border-accent-base' : 'border-subtle' ?>">
    <?php if ($plugin->settings['general'] !== []): ?>
        <?php // @icon('equalizer-fill')?>
        <IconButton class="absolute top-0 right-0 mt-4 mr-4" uri="<?= route_to('plugins-general-settings', $plugin->getKey()) ?>" glyph="equalizer-fill"><?= lang('Plugins.settings', [
            'pluginName' => $plugin->getName(),
        ]) ?></IconButton>
    <?php endif; ?>
    <img class="rounded-full min-w-16 max-w-16 aspect-square" src="<?= $plugin->iconSrc ?>">
    <div class="flex flex-col mt-2">
        <h2 class="flex items-center text-xl font-bold font-display gap-x-2"><?= $plugin->getName() ?><span class="px-1 font-mono text-xs rounded-full bg-subtle"><?= $plugin->version ?></span></h2>
        <p class="text-gray-600"><?= $plugin->getDescription() ?></p>
    </div>
    <footer class="flex items-center justify-between mt-4">
        <a href="<?= $plugin->website ?>" class="inline-flex items-center text-sm font-semibold underline hover:no-underline gap-x-1" target="_blank" rel="noopener noreferrer"><?= icon('link', [
            'class' => 'text-gray-500',
        ]) . lang('Plugins.website') ?></a>
        
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
    </footer>
</article>