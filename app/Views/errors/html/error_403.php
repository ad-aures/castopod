<?= helper(['components', 'svg']) ?>
<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>403 Forbidden</title>
    <link rel='stylesheet' type='text/css' href='<?= route_to('themes-colors-css') ?>' />
    <?= service('vite')->asset('styles/index.css', 'css') ?>
</head>

<body class="flex flex-col items-center justify-center min-h-screen px-2 text-center bg-base theme-<?= service('settings')
        ->get('App.theme') ?>">
    <?= svg('castopod-mascot_confused', 'h-64') ?>
    <h1 class="mt-4 text-3xl font-bold font-display md:text-4xl lg:text-5xl">403 - Forbidden</h1>

    <p class="mb-6 text-lg text-skin-muted md:text-xl lg:text-2xl">
        <?php if (isset($message) && $message !== '(null)'): ?>
            <?= esc($message) ?>
        <?php else: ?>
            You do not have sufficient permissions to access that page.
        <?php endif; ?>
    </p>
    <a href="<?= previous_url() ?>" class="inline-flex items-center justify-center px-3 py-1 text-sm font-semibold rounded-full shadow-xs text-accent-contrast md:px-4 md:py-2 md:text-base bg-accent-base hover:bg-accent-hover"><?= lang('Common.go_back') ?></a>
</body>

</html>
