<?= helper(['components', 'svg']) ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>404 Page Not Found</title>
    <?= service('vite')->asset('styles/index.css', 'css') ?>
</head>

<body class="flex flex-col items-center justify-center min-h-screen px-2 text-center bg-base">
    <?= svg('castopod-mascot_confused', 'h-64') ?>
    <h1 class="text-3xl font-bold font-display md:text-4xl lg:text-5xl">404 - File Not Found</h1>

    <p class="mb-6 text-lg text-skin-muted md:text-xl lg:text-2xl">
        <?php if (isset($message) && $message !== '(null)'): ?>
            <?= esc($message) ?>
        <?php else: ?>
            Sorry! Cannot seem to find the page you were looking for.
        <?php endif; ?>
    </p>
    <button class="inline-flex items-center justify-center px-3 py-1 text-sm font-semibold rounded-full shadow-xs text-accent-contrast focus:ring-accent md:px-4 md:py-2 md:text-base bg-accent-base hover:bg-accent-hover"><?= lang('Common.go_back') ?></button>
</body>

</html>
