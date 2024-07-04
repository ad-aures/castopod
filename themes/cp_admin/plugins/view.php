<?php use Modules\Plugins\Core\PluginStatus;

?>

<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= $plugin->getTitle() ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $plugin->getTitle() ?>
<?= $this->endSection() ?>

<?= $this->section('headerLeft') ?>
<?php if($plugin->getStatus() === PluginStatus::ACTIVE): ?>
    <?php // @icon('check-fill')?>
    <x-Pill variant="success" icon="check-fill" class="lowercase"><?= lang('Plugins.active') ?></x-Pill>
<?php elseif($plugin->getStatus() === PluginStatus::INACTIVE): ?>
    <?php // @icon('close-fill')?>
    <x-Pill variant="default" icon="close-fill" class="lowercase"><?= lang('Plugins.inactive') ?></x-Pill>
<?php elseif($plugin->getStatus() === PluginStatus::INVALID): ?>
    <?php // @icon('alert-fill')?>
    <x-Pill variant="warning" icon="alert-fill" class="lowercase"><?= lang('Plugins.invalid') ?></x-Pill>
<?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php if($plugin->getStatus() === PluginStatus::ACTIVE): ?>
    <form class="flex justify-end gap-x-2" method="POST" action="<?= route_to('plugins-deactivate', $plugin->getVendor(), $plugin->getPackage()) ?>">
        <?= csrf_field() ?>
        <x-Button type="submit" variant="danger"><?= lang('Plugins.deactivate') ?></x-Button>
        <?php if ($plugin->getSettingsFields('general') !== []): ?>
        <?php // @icon('equalizer-fill')?>
        <x-Button class="ring-2 ring-inset ring-gray-600" iconLeft="equalizer-fill" uri="<?= route_to('plugins-settings-general', $plugin->getVendor(), $plugin->getPackage()) ?>"><?= lang('Plugins.settings') ?></x-Button>
        <?php endif; ?>
    </form>
<?php elseif($plugin->getStatus() === PluginStatus::INVALID): ?>
    <form class="flex justify-end gap-x-2" method="POST" action="<?= route_to('plugins-activate', $plugin->getVendor(), $plugin->getPackage()) ?>">
        <?= csrf_field() ?>
        <x-Button type="submit" variant="secondary"><?= lang('Plugins.activate') ?></x-Button>
        <?php if ($plugin->getSettingsFields('general') !== []): ?>
        <?php // @icon('equalizer-fill')?>
        <x-Button class="ring-2 ring-inset ring-gray-600" iconLeft="equalizer-fill" uri="<?= route_to('plugins-settings-general', $plugin->getVendor(), $plugin->getPackage()) ?>"><?= lang('Plugins.settings') ?></x-Button>
        <?php endif; ?>
    </form>
<?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php if ($plugin->getStatus() === PluginStatus::INVALID): ?>
    <x-Alert title="<?= lang('Plugins.errors.manifestError') ?>" variant="warning" class="mb-12">
        <ul>
            <?php foreach ($plugin->getErrors() as $key => $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </x-Alert>
<?php endif; ?>

<div class="flex flex-col items-start justify-center gap-8 mx-auto xl:flex-row-reverse">
    <aside class="w-full pb-8 border-b xl:sticky xl:max-w-xs top-28 border-subtle xl:border-none">
        <h2 class="mb-2 text-2xl font-bold font-display"><?= lang('Plugins.about') ?></h2>
        <p class="relative max-w-sm text-skin-muted"><?= $plugin->getDescription() ?? '<span class="absolute inset-0 px-2 m-auto text-sm lowercase shadow-sm w-fit h-fit bg-base">' . lang('Plugins.noDescription') . '</span><span class="block w-full h-4 mt-1 bg-subtle"></span><span class="block w-full h-4 mt-1 bg-subtle"></span><span class="block w-4/5 h-4 mt-1 bg-subtle"></span>' ?></p>
        <?php if ($plugin->getHomepage()): ?>
            <a href="<?= $plugin->getHomepage() ?>" class="inline-flex items-center mt-2 font-semibold hover:underline gap-x-2"><?= icon('link') . $plugin->getHomepage() ?></a>
        <?php endif; ?>
        <?php if ($plugin->getKeywords() !== []): ?>
            <div class="mt-2">
                <?php foreach ($plugin->getKeywords() as $keyword): ?>
                    <span class="px-2 text-sm rounded-full bg-subtle"><?= $keyword ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <ul class="flex flex-col gap-2 mt-4">
            <li class="inline-flex items-center font-mono text-sm gap-x-2"><?= icon('box-2-line', [
                'class' => 'text-gray-500 text-xl',
            ]) . $plugin->getVersion() ?></li>
            <?php if ($plugin->getRepository()): ?>
                <li><a href="<?= $plugin->getRepository()->url ?>" class="inline-flex items-center text-sm gap-x-2 hover:underline" target="_blank" rel="noopener noreferrer"><?= icon('git-repository-fill', [
                    'class' => 'text-gray-500 text-xl',
                ]) . lang('Plugins.repository') ?></a></li>
            <?php endif; ?>
            <li class="inline-flex items-center text-sm gap-x-2"><?= icon('scales-3-fill', [
                'class' => 'text-gray-500 text-xl',
            ]) . $plugin->getLicense() ?></li>
        </ul>
        <?php if ($plugin->getAuthors() !== []): ?>
            <h3 class="mt-6 text-lg font-bold font-display"><?= lang('Plugins.authors') ?></h3>
            <ul>
                <?php foreach ($plugin->getAuthors() as $author): ?>
                    <li>
                        <?= $author->name ?>
                        <?php if ($author->email): ?>
                            <?php // @icon('mail-fill')?>
                            <x-IconButton glyph="mail-fill" uri="mailto:<?= $author->email ?>" size="small" isExternal="true"><?= lang('Plugins.author_email', [
                                'authorName' => $author->name,
                            ]) ?></x-IconButton>
                        <?php endif; ?>
                        <?php if ($author->url): ?>
                            <?php // @icon('earth-fill')?>
                            <x-IconButton glyph="earth-fill" uri="<?= $author->url ?>" size="small" isExternal="true"><?= lang('Plugins.author_homepage', [
                                'authorName' => $author->name,
                            ]) ?></x-IconButton>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <?php if ($plugin->getHooks() !== []): ?>
            <h3 class="mt-6 text-lg font-bold font-display"><?= lang('Plugins.declaredHooks') ?></h3>
            <ul>
                <?php foreach ($plugin->getHooks() as $hook): ?>
                    <li><?= $hook ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </aside>
    <pf-tabs class="w-full max-w-3xl border rounded-t-lg rounded-b-lg xl:-mt-8 xl:rounded-t-none bg-elevated border-subtle" style="--pf-c-tabs__item--m-current__link--after--BorderColor:#009486">
        <pf-tab slot="tab"><?= icon('article-line', [
            'slot' => 'icon',
        ]) ?>README.md</pf-tab>
    <?php if($plugin->getReadmeHTML()): ?>
        <pf-tab-panel class="p-4 prose md:p-6 xl:p-12 prose-headings:font-display">
            <?= $plugin->getReadmeHTML() ?>
        </pf-tab-panel>
    <?php else: ?>
        <pf-tab-panel class="p-4 md:p-6 xl:p-12">
            <div class="flex flex-col items-center justify-center min-h-96">
                <?= icon('article-line', [
                    'class' => 'text-gray-300 text-6xl',
                ]) ?>
                <p class="mt-2 font-semibold text-skin-muted"><?= lang('Plugins.noReadme') ?></p>
            </div>
        </pf-tab-panel>
    <?php endif; ?>
    <?php if($plugin->getLicenseHTML()): ?>
        <pf-tab slot="tab"><?= icon('scales-3-fill', [
            'slot' => 'icon',
        ]) ?>LICENSE.md</pf-tab>
        <pf-tab-panel class="p-4 prose md:p-6 xl:p-12 prose-headings:font-display">
            <?= $plugin->getLicenseHTML() ?>
        </pf-tab-panel>
    <?php endif; ?>
    </pf-tabs>
</div>
<?= $this->endSection() ?>