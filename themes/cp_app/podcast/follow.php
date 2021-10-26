<?= helper('page') ?>

<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="<?= service('settings')
    ->get('App.siteIcon')['ico'] ?>" />
    <link rel="apple-touch-icon" href="<?= service('settings')->get('App.siteIcon')['180'] ?>">
    <link rel="manifest" href="<?= route_to('webmanifest') ?>">
    
    <title><?= lang('Podcast.followTitle', [
        'actorDisplayName' => $actor->display_name,
    ]) ?></title>
    <meta name="description" content="<?= $actor->summary ?>"/>
    <meta property="og:title" content="<?= lang('Podcast.followTitle', [
        'actorDisplayName' => $actor->display_name,
    ]) ?>"/>
    <meta property="og:locale" content="<?= service(
        'request',
    )->getLocale() ?>" />
    <meta property="og:url" content="<?= current_url() ?>" />
    <meta property="og:image" content="<?= $actor->avatar_image_url ?>" />
    <meta property="og:description" content="<?= $actor->summary ?>" />

    <?= service('vite')
        ->asset('styles/index.css', 'css') ?>
    <?= service('vite')
        ->asset('js/podcast.ts', 'js') ?>
</head>


<body class="flex flex-col min-h-screen bg-pine-50">
    <header class="flex flex-col items-center mb-8">
        <h1 class="w-full pt-8 pb-32 text-center text-white bg-pine-800"><?= lang(
            'Fediverse.follow.subtitle',
        ) ?></h1>
        <div class="flex flex-col w-full max-w-xs -mt-24 overflow-hidden bg-white shadow rounded-xl">
            <img src="<?= $actor->cover_image_url ?>" alt="" class="object-cover w-full h-32 bg-pine-800" />
            <div class="flex px-4 py-2">
                <img src="<?= $actor->avatar_image_url ?>" alt="<?= $actor->display_name ?>"
                    class="w-16 h-16 mr-4 -mt-8 rounded-full ring-2 ring-white" />
                <div class="">
                    <p class="font-semibold"><?= $actor->display_name ?></p>
                    <p class="text-sm text-gray-500">@<?= $actor->username ?></p>
                </div>
            </div>
        </div>
    </header>

    <main class="w-full max-w-md px-4 mx-auto">
        <form action="<?= route_to('attempt-follow', $actor->username) ?>" method="POST" class="flex flex-col">
            <?= csrf_field() ?>
            <?= view('_message_block') ?>

            <Forms.Field
                name="handle"
                label="<?= lang('Fediverse.your_handle') ?>"
                hint="<?= lang('Fediverse.your_handle_hint') ?>"
                required="true"
            />
            <Button variant="primary" type="submit" class="self-end" iconRight="send-plane"><?= lang('Fediverse.follow.submit') ?></Button>
        </form>
    </main>

    <footer
        class="container flex flex-col items-center px-2 py-4 mx-auto mt-auto text-xs border-t md:justify-between md:flex-row">
        <?= render_page_links('inline-flex mb-4 md:mb-0') ?>
        <p>
            <?= lang('Common.powered_by', [
                'castopod' =>
                    '<a class="inline-flex font-semibold hover:underline focus:ring-castopod" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod' . icon('social/castopod', 'ml-1 text-lg') . '</a>',
            ]) ?>
        </p>
    </footer>
</body>
