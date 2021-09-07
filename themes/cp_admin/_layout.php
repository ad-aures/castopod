<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <title><?= $this->renderSection('title') ?> | Castopod Admin</title>
    <meta name="description" content="Castopod is an open-source hosting platform made for podcasters who want engage and interact with their audience."/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />

    <?= service('vite')->asset('styles/index.css', 'css') ?>
    <?= service('vite')->asset('js/admin.ts', 'js') ?>
    <?= service('vite')->asset('js/audio-player.ts', 'js') ?>
</head>

<body class="relative bg-pine-50 holy-grail-grid">
    <div id="sidebar-backdrop" role="button" tabIndex="0" aria-label="Close" class="fixed z-50 hidden w-full h-full bg-gray-900 bg-opacity-50 md:hidden"></div>
    <header class="sticky top-0 z-50 flex items-center justify-between h-10 text-white border-b holy-grail__header bg-pine-800 border-pine-900">
        <div class="inline-flex items-center h-full">
            <a href="<?= route_to(
                'admin',
            ) ?>" class="inline-flex items-center h-full px-2 border-r border-pine-900">
                <?= (isset($podcast) ? icon('arrow-left', 'mr-2') : '') . svg('castopod-logo', 'h-6') ?>
            </a>
            <a href="<?= route_to(
                'home',
            ) ?>" class="inline-flex items-center h-full px-6 text-sm font-semibold outline-none hover:underline focus:ring">
                    <?= lang('AdminNavigation.go_to_website') ?>
                    <?= icon('external-link', 'ml-1 opacity-60') ?>
            </a>
        </div>
        <button
            type="button"
            class="inline-flex items-center h-full px-6 mt-auto font-semibold outline-none focus:ring"
            id="my-account-dropdown"
            data-dropdown="button"
            data-dropdown-target="my-account-dropdown-menu"
            aria-haspopup="true"
            aria-expanded="false">
                <?= icon('account-circle', 'text-2xl opacity-60 mr-2') ?>
                <?= user()->username ?>
                <?= icon('caret-down', 'ml-auto text-2xl') ?>
        </button>
        <nav
            id="my-account-dropdown-menu"
            class="absolute z-50 flex flex-col py-2 text-black whitespace-no-wrap bg-white border-black rounded border-[3px]"
            aria-labelledby="my-accountDropdown"
            data-dropdown="menu"
            data-dropdown-placement="bottom-end">
                <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
                    'my-account',
                ) ?>"><?= lang('AdminNavigation.account.my-account') ?></a>
                <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
                    'change-password',
                ) ?>"><?= lang('AdminNavigation.account.change-password') ?></a>
                <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
                    'logout',
                ) ?>"><?= lang('AdminNavigation.account.logout') ?></a>
        </nav>
    </header>
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
                    '<a class="underline hover:no-underline" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod</a> ' .
                    CP_VERSION,
            ]) ?>
        </footer>
    </aside>
    <main class="holy-grail__main">
        <header class="bg-white">
            <div class="container flex flex-wrap items-end justify-between px-2 py-10 mx-auto md:px-12 gap-y-6 gap-x-6">
                <div class="flex flex-col">
                    <?= render_breadcrumb('text-gray-800 text-xs') ?>
                    <div class="flex flex-wrap items-center">
                        <h1 class="text-3xl font-bold font-display"><?= $this->renderSection(
                            'pageTitle',
                        ) ?></h1>
                        <?= $this->renderSection('headerLeft') ?>
                    </div>
                </div>
                <div class="flex flex-wrap"><?= $this->renderSection(
                    'headerRight',
                ) ?></div>
            </div>
        </header>
        <div class="container px-2 py-8 mx-auto md:px-12">
            <!-- view('App\Views\_message_block') -->
            <?= $this->renderSection('content') ?>
        </div>
    </main>
    <button
        type="button"
        id="sidebar-toggler"
        class="fixed bottom-0 left-0 z-50 p-3 mb-3 ml-3 text-xl transition duration-300 ease-in-out bg-white border-2 rounded-full shadow-lg focus:outline-none md:hidden hover:bg-gray-100 focus:ring"
        style="transform: translateX(0px);"><?= icon('menu') ?></button>
</body>
