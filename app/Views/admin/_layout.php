<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <title><?= $this->renderSection('title') ?> | Castopod Admin</title>
    <meta name="description" content="Castopod is an open-source hosting platform made for podcasters who want engage and interact with their audience."/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link rel="stylesheet" href="/assets/admin.css"/>
    <link rel="stylesheet" href="/assets/index.css"/>
    <script src="/assets/admin.js" type="module" defer></script>
</head>

<body class="relative bg-gray-100 holy-grail-grid">
    <div id="sidebar-backdrop" role="button" tabIndex="0" aria-label="Close" class="fixed z-50 hidden w-full h-full bg-gray-900 bg-opacity-50 md:hidden"></div>
    <aside id="admin-sidebar" class="sticky top-0 z-50 flex flex-col w-64 max-h-screen transition duration-200 ease-in-out transform -translate-x-full bg-white border-r holy-grail-sidebar md:translate-x-0">
        <?php if (isset($podcast)): ?>
            <?= $this->include('admin/podcast/_sidebar') ?>
        <?php else: ?>
            <?= $this->include('admin/_sidebar') ?>
        <?php endif; ?>
    </aside>
    <main class="overflow-hidden holy-grail-main">
        <header class="text-white bg-gradient-to-tr from-gray-900 to-gray-800">
            <div class="container flex flex-wrap items-end justify-between px-2 py-10 mx-auto md:px-12 gap-y-6 gap-x-6">
                <div class="flex flex-col">
                    <?= render_breadcrumb('text-gray-300') ?>
                    <h1 class="text-3xl"><?= $this->renderSection(
                        'pageTitle'
                    ) ?></h1>
                </div>
                <div class="flex flex-wrap"><?= $this->renderSection(
                    'headerRight'
                ) ?></div>
            </div>
        </header>
        <div class="container px-2 py-8 mx-auto md:px-12">
            <?= view('_message_block') ?>
            <?= $this->renderSection('content') ?>
        </div>
    </main>
    <footer class="px-2 py-2 mx-auto text-xs text-right holy-grail-footer">
        <?= lang('Common.powered_by', [
            'castopod' =>
                '<a class="underline hover:no-underline" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod</a> v' .
                CP_VERSION,
        ]) ?>
    </footer>
    <button
        type="button"
        id="sidebar-toggler"
        class="fixed bottom-0 left-0 z-50 p-3 mb-3 ml-3 text-xl transition duration-300 ease-in-out bg-white border-2 rounded-full shadow-lg focus:outline-none md:hidden hover:bg-gray-100 focus:shadow-outline"
        style="transform: translateX(0px);"><?= icon('menu') ?></button>
</body>
