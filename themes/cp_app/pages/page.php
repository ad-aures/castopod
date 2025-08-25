<?= helper('page') ?>
<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<?= service('html_head')
    ->title($page->title . service('settings')->get('App.siteTitleSeparator') . service('settings')->get('App.siteName'))
    ->appendRawContent(service('vite')->asset('styles/index.css', 'css'))
?>

<body class="flex flex-col min-h-screen mx-auto bg-base theme-<?= service('settings')
    ->get('App.theme') ?>">
    <?php if (auth()->loggedIn()): ?>
        <?= $this->include('_admin_navbar') ?>
    <?php endif; ?>

    <header class="py-8 border-b bg-elevated border-subtle">
        <div class="container flex flex-col items-start px-2 py-4 mx-auto">
            <a href="<?= route_to('home') ?>"
            class="inline-flex items-center mb-2 text-sm"><?= icon(
                'arrow-left-line',
                [
                    'class' => 'mr-2',
                ],
            ) . lang('Page.back_to_home') ?></a>
            <x-Heading tagName="h1" size="large"><?= esc($page->title) ?></x-Heading>
        </div>
    </header>
    <main class="container flex-1 px-4 py-6 mx-auto">
    <div class="prose prose-brand">
        <?= $page->content_html ?>
    </div>
    </main>
    <footer class="container flex justify-between px-2 py-4 mx-auto text-sm text-right border-t border-subtle">
        <?= render_page_links() ?>
        <small><?= lang('Common.powered_by', [
            'castopod' => '<a class="underline hover:no-underline" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod</a>',
        ], null, false) ?></small>
    </footer>
</body>
