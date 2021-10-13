<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <title>Castopod</title>
    <meta name="description" content="Castopod is an open-source hosting platform made for podcasters who want engage and interact with their audience."/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <?= service('vite')
        ->asset('styles/index.css', 'css') ?>
    <?= service('vite')
        ->asset('js/install.ts', 'js') ?>
</head>

<body class="flex flex-col min-h-screen mx-auto">
    <header class="border-b">
        <div class="container flex items-center justify-between px-2 py-4 mx-auto">
            <?= lang('Install.title') ?>
        </div>
    </header>
    <main class="container flex flex-col items-center justify-center flex-1 px-4 py-10 mx-auto">
        <!-- view('_message_block') -->
        <?= $this->renderSection('content') ?>
    </main>
    <footer class="container px-2 py-4 mx-auto text-sm text-right border-t">
        <small><?= lang('Common.powered_by', [
            'castopod' =>
                '<a class="inline-flex font-semibold hover:underline" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod' . icon('social/castopod', 'ml-1 text-lg') . '</a>',
        ]) ?></small>
    </footer>
</body>
