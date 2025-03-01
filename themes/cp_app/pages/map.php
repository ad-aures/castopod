<?= helper('page') ?>
<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>" class="h-full">

<?= service('html_head')
    ->title(lang('Page.map.title') . service('settings')->get('App.siteTitleSeparator') . service('settings')->get('App.siteName'))
    ->description(lang('Page.map.description', [
        'siteName' => esc(service('settings')
            ->get('App.siteName')),
    ]))
?>

<body class="flex flex-col h-full min-h-screen mx-auto bg-base theme-<?= service('settings')
    ->get('App.theme') ?>">
    <?php if (auth()->loggedIn()): ?>
        <?= $this->include('_admin_navbar') ?>
    <?php endif; ?>

    <header class="py-8 border-b border-subtle bg-elevated">
        <div class="container flex flex-col items-start px-2 py-4 mx-auto">
            <a href="<?= route_to('home') ?>"
            class="inline-flex items-center mb-2 text-sm"><?= icon(
                'arrow-left-line',
                [
                    'class' => 'mr-2',
                ],
            ) . lang('Page.back_to_home') ?></a>
            <x-Heading tagName="h1" size="large"><?= lang('Page.map.title') ?></x-Heading>
        </div>
    </header>
    <main class="flex-1 w-full h-full">
        <div id="map" data-episodes-map-data-url="<?= url_to('episodes-markers') ?>" class="z-10 w-full h-full"></div>
    </main>
    <footer class="container flex justify-between px-2 py-4 mx-auto text-sm text-right">
        <?= render_page_links() ?>
        <small><?= lang('Common.powered_by', [
                    'castopod' => '<a class="inline-flex font-semibold hover:underline" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod' . icon('social:castopod', [
                        'class' => 'ml-1 text-lg',
                    ]) . '</a>',
                ], null, false) ?></small>
    </footer> 
</body>
