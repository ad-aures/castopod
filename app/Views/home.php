<?= helper('page') ?>
<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <title>Castopod</title>
    <meta name="description" content="Castopod is an open-source hosting platform made for podcasters who want engage and interact with their audience."/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <?= service('vite')->asset('styles/index.css', 'css') ?>
</head>

<body class="flex flex-col min-h-screen mx-auto bg-pine-50">
    <header class="py-8 text-white border-b bg-pine-900">
        <div class="container flex items-center justify-between px-2 py-4 mx-auto">
            <a href="<?= route_to(
                'home',
            ) ?>" class="inline-flex items-baseline text-3xl font-semibold font-display"><?= 'castopod' .
    svg('castopod-logo', 'h-6 ml-2') ?></a>
        </div>
    </header>
    <main class="container flex-1 px-4 py-10 mx-auto">
        <h1 class="mb-2 text-xl"><?= lang('Home.all_podcasts') ?> (<?= count(
     $podcasts,
 ) ?>)</h1>
        <section class="grid gap-4 grid-cols-podcasts">
            <?php if ($podcasts): ?>
                <?php foreach ($podcasts as $podcast): ?>
                    <a href="<?= $podcast->link ?>" class="w-full">
                        <article class="w-full h-full overflow-hidden bg-white border shadow rounded-xl hover:bg-gray-100 hover:shadow">
                            <img alt="<?= $podcast->title ?>"
                            src="<?= $podcast->image->medium_url ?>"
                            class="object-cover w-full h-48 mb-2" />
                            <h2 class="px-2 font-semibold leading-tight truncate"><?= $podcast->title ?></h2>
                            <p class="px-2 pb-2 text-gray-600">@<?= $podcast->handle ?></p>
                        </article>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="italic"><?= lang('Home.no_podcast') ?></p>
            <?php endif; ?>
        </section>
    </main>
    <footer class="container flex justify-between px-2 py-4 mx-auto text-sm text-right border-t">
        <?= render_page_links() ?>
        <small><?= lang('Common.powered_by', [
            'castopod' =>
                '<a class="underline hover:no-underline" href="https://castopod.org/" target="_blank" rel="noreferrer noopener">Castopod</a>',
        ]) ?></small>
    </footer>
</body>
