<?= helper('page') ?>
<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <title><?= $this->renderSection('title') ?></title>
    <meta name="description" content="Castopod is an open-source hosting platform made for podcasters who want engage and interact with their audience."/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <?= service('vite')->asset('styles/index.css', 'css') ?>
</head>

<body class="flex flex-col min-h-screen mx-auto bg-gray-100">
    <header class="bg-white border-b">
        <div class="container flex items-center justify-between px-2 py-4 mx-auto">
            <a href="<?= route_to('home') ?>" class="text-2xl"><?= isset($page)
    ? $page->title
    : 'Castopod' ?></a>
        </div>
    </header>
    <main class="container flex-1 px-4 py-10 mx-auto">
        <?= $this->renderSection('content') ?>
    </main>
    <footer class="px-2 py-4 bg-white border-t">
        <div class="container flex flex-col items-center justify-between mx-auto text-xs md:flex-row ">
            <?= render_page_links('inline-flex mb-4 md:mb-0') ?>
            <p class="flex flex-col items-center md:items-end">
                <?= lang('Common.powered_by', [
                    'castopod' =>
                        '<a class="underline hover:no-underline" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod</a>',
                ]) ?>
            </p>
        </div>
    </footer>    
</body>
