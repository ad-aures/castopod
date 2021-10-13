<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <title><?= $this->renderSection('title') ?> | Castopod Admin</title>
    <meta name="description" content="Castopod is an open-source hosting platform made for podcasters who want engage and interact with their audience."/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />

    <?= service('vite')
        ->asset('styles/index.css', 'css') ?>
    <?= service('vite')
        ->asset('js/admin.ts', 'js') ?>
    <?= service('vite')
        ->asset('js/admin-audio-player.ts', 'js') ?>
</head>

<body class="relative bg-pine-50 holy-grail-grid">
    <div id="sidebar-backdrop" role="button" tabIndex="0" aria-label="Close" class="fixed z-50 hidden w-full h-full bg-gray-900 bg-opacity-50 md:hidden"></div>
    <?= $this->include('_partials/_nav_header') ?>
    <aside id="admin-sidebar" class="sticky z-50 flex flex-col text-white transition duration-200 ease-in-out transform -translate-x-full border-r top-10 border-pine-900 bg-pine-800 holy-grail__sidebar md:translate-x-0">
        <?php if (isset($podcast) && isset($episode)): ?>
            <?= $this->include('episode/_sidebar') ?>
        <?php elseif (isset($podcast)): ?>
            <?= $this->include('podcast/_sidebar') ?>
        <?php else: ?>
            <?= $this->include('_sidebar') ?>
        <?php endif; ?>
        <footer class="px-2 py-2 mx-auto text-xs text-right">
            <?= lang('Common.powered_by', [
                'castopod' =>
                    '<a class="inline-flex font-semibold hover:underline" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod' . icon('social/castopod', 'ml-1 text-lg') . '</a> ' .
                    CP_VERSION,
            ]) ?>
        </footer>
    </aside>
    <main class="relative holy-grail__main">
        <header class="z-40 flex items-center px-4 bg-white border-b md:px-12 sticky-header-outer border-pine-100">
            <div class="container flex flex-col justify-end mx-auto -mt-4 sticky-header-inner">
                <?= render_breadcrumb('text-gray-800 text-xs items-center flex') ?>
                <div class="flex justify-between py-1">
                    <div class="flex flex-wrap items-center">
                        <Heading tagName="h1" size="large"><?= $this->renderSection('pageTitle') ?></Heading>
                        <?= $this->renderSection('headerLeft') ?>
                    </div>
                    <div class="flex gap-1"><?= $this->renderSection('headerRight') ?></div>
                </div>
            </div>
        </header>
        <div class="container px-2 py-8 mx-auto md:px-12">
            <?= view('_message_block') ?>
            <?= $this->renderSection('content') ?>
        </div>
    </main>
    <button
        type="button"
        id="sidebar-toggler"
        class="fixed bottom-0 left-0 z-50 p-3 mb-3 ml-3 text-xl transition duration-300 ease-in-out bg-white border-2 rounded-full shadow-lg focus:outline-none md:hidden hover:bg-gray-100 focus:ring"
        style="transform: translateX(0px);"><?= icon('menu') ?></button>
</body>