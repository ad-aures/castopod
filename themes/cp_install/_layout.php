<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<?= service('html_head')->title(lang('Install.title')) ?>

<body class="flex flex-col min-h-screen mx-auto bg-base">
    <header class="border-b border-subtle">
        <div class="container flex items-center justify-between px-2 py-4 mx-auto">
            <?= lang('Install.title') ?>
        </div>
    </header>
    <main class="container flex flex-col items-center justify-center flex-1 px-4 py-10 mx-auto">
        <?= view('_message_block') ?>
        <?= $this->renderSection('content') ?>
    </main>
    <footer class="container px-2 py-4 mx-auto text-sm text-right border-t border-subtle">
        <small><?= lang('Common.powered_by', [
            'castopod' => '<a class="inline-flex font-semibold hover:underline" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod' . icon('social:castopod', [
                'class' => 'ml-1 text-lg',
            ]) . '</a>',
        ], null, false) ?></small>
    </footer>
</body>
