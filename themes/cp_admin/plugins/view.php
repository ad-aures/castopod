<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= $plugin->getName() ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $plugin->getName() ?>
<?= $this->endSection() ?>

<?= $this->section('headerLeft') ?>
<?php if($plugin->isActive()): ?>
    <x-Pill variant="success" icon="check-fill" class="lowercase"><?= lang('Plugins.active') ?></x-Pill>
<?php else: ?>
    <x-Pill variant="default" icon="close-fill" class="lowercase"><?= lang('Plugins.inactive') ?></x-Pill>
<?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php if($plugin->isActive()): ?>
    <form class="flex justify-end" method="POST" action="<?= route_to('plugins-deactivate', $plugin->getVendor(), $plugin->getPackage()) ?>">
        <?= csrf_field() ?>
        <x-Button type="submit" variant="danger"><?= lang('Plugins.deactivate') ?></x-Button>
    </form>
<?php else: ?>
    <form class="flex justify-end" method="POST" action="<?= route_to('plugins-activate', $plugin->getVendor(), $plugin->getPackage()) ?>">
        <?= csrf_field() ?>
        <x-Button type="submit" variant="secondary"><?= lang('Plugins.activate') ?></x-Button>
    </form>
<?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-col items-start justify-center gap-8 mx-auto xl:flex-row-reverse">
    <aside class="w-full pb-8 border-b xl:sticky xl:max-w-xs top-28 border-subtle xl:border-none">
        <h2 class="mb-2 text-2xl font-bold font-display"><?= lang('Plugins.about') ?></h2>
        <p><?= $plugin->getDescription() ?></p>
        <a href="<?= $plugin->getHomepage() ?>" class="inline-flex items-center mt-2 font-semibold hover:underline gap-x-2"><?= icon('link') . $plugin->getHomepage() ?></a>
        <?php if ($plugin->getKeywords() !== []): ?>
            <div class="mt-2">
                <?php foreach ($plugin->getKeywords() as $keyword): ?>
                    <span class="px-2 text-sm rounded-full bg-subtle"><?= $keyword ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <ul class="flex flex-col gap-2 mt-4">
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
    </aside>
    <section class="max-w-2xl prose prose-headings:font-display">
        <?= $plugin->getReadmeHTML() ?>
    </section>
</div>
<?= $this->endSection() ?>