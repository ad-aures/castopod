<?php

use Modules\Plugins\Core\PluginStatus;

?>
<article class="flex flex-col p-4 rounded-xl relative bg-elevated border-3 <?= $plugin->getStatus() === PluginStatus::ACTIVE ? 'border-accent-base' : 'border-subtle' ?>">
    <div class="self-end -mb-6">
    <?php if($plugin->getStatus() === PluginStatus::ACTIVE): ?>
        <?php // @icon('check-fill')?>
        <x-Pill variant="success" icon="check-fill" class="lowercase" size="small"><?= lang('Plugins.active') ?></x-Pill>
    <?php elseif($plugin->getStatus() === PluginStatus::INACTIVE): ?>
        <?php // @icon('close-fill')?>
        <x-Pill variant="default" icon="close-fill" class="lowercase" size="small"><?= lang('Plugins.inactive') ?></x-Pill>
    <?php elseif($plugin->getStatus() === PluginStatus::INVALID): ?>
        <?php // @icon('alert-fill')?>
        <x-Pill variant="warning" icon="alert-fill" class="lowercase" size="small"><?= lang('Plugins.invalid') ?></x-Pill>
    <?php endif; ?>
    </div>
    <img class="rounded-full min-w-16 max-w-16 aspect-square" src="<?= $plugin->getIconSrc() ?>">
    <div class="flex flex-col items-start mt-2 mb-6">
        <h2 class="flex items-center text-xl font-bold font-display gap-x-2" title="<?= $plugin->getName() ?>"><a class="line-clamp-1" href="<?= route_to('plugins-view', $plugin->getVendor(), $plugin->getPackage()) ?>" class="hover:underline decoration-accent"><?= $plugin->getName() ?></a></h2>
        <p class="inline-flex font-mono text-xs">
            <span class="inline-flex tracking-wide bg-gray-100">
                <a href="<?= route_to('plugins-vendor', $plugin->getVendor()) ?>" class="underline underline-offset-2 decoration-2 decoration-dotted hover:decoration-solid decoration-accent"><?= $plugin->getVendor() ?></a>
                <span>/</span>
                <a class="underline underline-offset-2 decoration-2 decoration-dotted hover:decoration-solid decoration-accent" href="<?= route_to('plugins-view', $plugin->getVendor(), $plugin->getPackage()) ?>"><?= $plugin->getPackage() ?></a></span>
            <span class="mx-1">•</span><span class="px-1 font-mono text-xs"><?= $plugin->getVersion() ?></span>
        </p>
        <p class="relative w-full max-w-sm mt-2 text-skin-muted line-clamp-3"><?= $plugin->getDescription() ?? '<span class="absolute inset-0 px-2 m-auto text-sm lowercase shadow-sm w-fit h-fit bg-elevated">' . lang('Plugins.noDescription') . '</span><span class="block w-full h-4 mt-1 bg-gray-100"></span><span class="block w-full h-4 mt-1 bg-gray-100"></span><span class="block w-4/5 h-4 mt-1 bg-gray-100"></span>' ?></p>
    </div>
    <footer class="flex items-center justify-between mt-auto">
        <div class="flex gap-x-2">
            <?php if ($plugin->getHomepage()): ?>
                <?php // @icon('earth-fill')?>
                <x-IconButton glyph="earth-fill" uri="<?= $plugin->getHomepage() ?>" isExternal="true"><?= lang('Plugins.website') ?></x-IconButton>    
            <?php endif; ?>
            <?php if ($plugin->getRepository()): ?>
                <?php // @icon('git-repository-fill')?>
                <x-IconButton glyph="git-repository-fill" uri="<?= $plugin->getRepository()->url ?>" isExternal="true"><?= lang('Plugins.repository') ?></x-IconButton>    
            <?php endif; ?>
        </div>
        <div class="flex gap-x-2">
        <?php if($plugin->getStatus() === PluginStatus::ACTIVE): ?>
            <form class="flex justify-end" method="POST" action="<?= route_to('plugins-deactivate', $plugin->getVendor(), $plugin->getPackage()) ?>">
                <?= csrf_field() ?>
                <x-Button type="submit" variant="danger" size="small"><?= lang('Plugins.deactivate') ?></x-Button>
            </form>
        <?php elseif($plugin->getStatus() === PluginStatus::INACTIVE): ?>
            <form class="flex flex-col items-end justify-end gap-2" method="POST" action="<?= route_to('plugins-activate', $plugin->getVendor(), $plugin->getPackage()) ?>">
                <?= csrf_field() ?>
                <x-Button type="submit" variant="secondary" size="small"><?= lang('Plugins.activate') ?></x-Button>
            </form>
        <?php endif; ?>
            <?php if ($plugin->getSettingsFields('general') !== []): ?>
                <?php // @icon('equalizer-fill')?>
                <x-IconButton uri="<?= route_to('plugins-settings-general', $plugin->getVendor(), $plugin->getPackage()) ?>" glyph="equalizer-fill"><?= lang('Plugins.settings') ?></x-IconButton>
            <?php endif; ?>
            <button class="p-2 rounded-full" id="more-dropdown-<?= $plugin->getKey() ?>" data-dropdown="button" data-dropdown-target="more-dropdown-<?= $plugin->getKey() ?>-menu" aria-haspopup="true" aria-expanded="false" title="<?= lang('Common.more') ?>"><?= icon('more-2-fill') ?></button>
            <?php $items = [
                [
                    'type'  => 'link',
                    'title' => lang('Plugins.view'),
                    'uri'   => route_to('plugins-view', $plugin->getVendor(), $plugin->getPackage()),
                ],
                [
                    'type' => 'separator',
                ],
                [
                    'type'  => 'link',
                    'title' => icon('delete-bin-fill', [
                        'class' => 'text-gray-500',
                    ]) . lang('Plugins.uninstall'),
                    'uri'   => route_to('plugins-uninstall', $plugin->getVendor(), $plugin->getPackage()),
                    'class' => 'font-semibold text-red-600',
                ],
            ]; ?>
            <x-DropdownMenu id="more-dropdown-<?= $plugin->getKey() ?>-menu" labelledby="more-dropdown-<?= $plugin->getKey() ?>" placement="bottom-end" offsetY="-32" items="<?= esc(json_encode($items)) ?>" />
        </div>
    </footer>
</article>