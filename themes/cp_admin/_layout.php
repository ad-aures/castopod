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

<body class="relative grid items-start min-h-screen bg-pine-50 grid-cols-admin grid-rows-admin">
    <div id="sidebar-backdrop" role="button" tabIndex="0" aria-label="Close" class="fixed z-50 hidden w-full h-full bg-gray-900 bg-opacity-50 md:hidden"></div>
    <?= $this->include('_partials/_nav_header') ?>
    <?= $this->include('_partials/_nav_aside') ?>
    <main class="relative max-w-full col-start-1 row-start-2 col-span-full md:col-start-2 md:col-span-1">
        <header class="z-40 flex items-center px-4 bg-white border-b md:px-12 sticky-header-outer border-pine-100">
            <div class="flex flex-col justify-end w-full -mt-4 sticky-header-inner">
                <?= render_breadcrumb('text-gray-800 text-xs items-center flex') ?>
                <div class="flex justify-between py-1">
                    <div class="flex flex-wrap items-center overflow-x-hidden">
                        <Heading tagName="h1" size="large" class="truncate"><?= $this->renderSection('pageTitle') ?></Heading>
                        <?= $this->renderSection('headerLeft') ?>
                    </div>
                    <div class="flex flex-shrink-0 gap-1"><?= $this->renderSection('headerRight') ?></div>
                </div>
            </div>
        </header>
        <div class="px-2 py-8 mx-auto md:px-12">
            <?= view('_message_block') ?>
            <?= $this->renderSection('content') ?>
        </div>
    </main>
    <button
        type="button"
        id="sidebar-toggler"
        class="fixed bottom-0 left-0 z-50 p-3 mb-3 ml-3 text-xl transition duration-300 ease-in-out bg-white border-2 rounded-full shadow-lg md:hidden hover:bg-gray-100 focus:ring-castopod"
        style="transform: translateX(0px);"><?= icon('menu') ?></button>
</body>