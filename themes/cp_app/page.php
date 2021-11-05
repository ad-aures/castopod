<?= helper('page') ?>
<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <title><?= $page->title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/x-icon" href="<?= service('settings')
    ->get('App.siteIcon')['ico'] ?>" />
    <link rel="apple-touch-icon" href="<?= service('settings')->get('App.siteIcon')['180'] ?>">
    <link rel="manifest" href="<?= route_to('webmanifest') ?>">
    <?= service('vite')
        ->asset('styles/index.css', 'css') ?>
    <?= service('vite')
        ->asset('js/app.ts', 'js') ?>
</head>

<body class="flex flex-col min-h-screen mx-auto bg-base">
    <?php if (service('authentication')->check()): ?>
        <?= $this->include('_admin_navbar') ?>
    <?php endif; ?>

    <header class="py-8 border-b bg-elevated border-subtle">
        <div class="container flex flex-col items-start px-2 py-4 mx-auto">
            <a href="<?= route_to('home') ?>"
            class="inline-flex items-center mb-2 focus:ring-accent"><?= icon(
            'arrow-left',
            'mr-2',
        ) . lang('Page.back_to_home') ?></a>
            <h1 class="text-3xl font-semibold"><?= $page->title ?></h1>
        </div>
    </header>
    <main class="container flex-1 px-4 py-10 mx-auto">
        <div class="prose prose-brand">
            <?= $page->content_html ?>
        </div>
    </main>
    <footer class="container flex justify-between px-2 py-4 mx-auto text-sm text-right border-t border-subtle">
        <?= render_page_links() ?>
        <small><?= lang('Common.powered_by', [
            'castopod' =>
                '<a class="inline-flex font-semibold hover:underline focus:ring-accent" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod' . icon('social/castopod', 'ml-1 text-lg') . '</a>',
        ]) ?></small>
    </footer>
</body>
