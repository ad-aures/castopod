<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />

    <title><?= lang('Fediverse.' . $action . '.title', [
        'actorDisplayName' => $post->actor->display_name,
    ]) ?></title>
    <meta name="description" content="<?= $post->message ?>"/>
    <meta property="og:title" content="<?= lang(
        'Fediverse.' . $action . '.title',
        [
            'actorDisplayName' => $post->actor->display_name,
        ],
    ) ?>"/>
    <meta property="og:locale" content="<?= service(
        'request',
    )->getLocale() ?>" />
    <meta property="og:site_name" content="<?= $post->actor->display_name ?>" />
    <meta property="og:url" content="<?= current_url() ?>" />
    <meta property="og:image" content="<?= $post->actor->avatar_image_url ?>" />
    <meta property="og:description" content="<?= $post->message ?>" />

    <?= service('vite')
        ->asset('styles/index.css', 'css') ?>
    <?= service('vite')
        ->asset('js/podcast.ts', 'js') ?>
</head>

<body class="min-h-screen mx-auto bg-pine-50">
    <header class="pt-8 pb-32 bg-pine-800">
        <h1 class="text-lg font-semibold text-center text-white"><?= lang(
            'Fediverse.' . $action . '.subtitle',
        ) ?></h1>
    </header>
    <main class="flex-1 max-w-xl px-4 pb-8 mx-auto -mt-24">
        <?= $this->include('podcast/_partials/post') ?>

        <?= form_open(
            route_to('post-attempt-remote-action', $post->id, $action),
            [
                'method' => 'post',
                'class' => 'flex flex-col mt-8',
            ],
        ) ?>
        <?= csrf_field() ?>
        <?= view('_message_block') ?>

        <?= form_label(
            lang('Fediverse.your_handle'),
            'handle',
            [],
            lang('Fediverse.your_handle_hint'),
        ) ?>
        <?= form_input([
            'id' => 'handle',
            'name' => 'handle',
            'class' => 'form-input mb-4',
            'required' => 'required',
            'type' => 'text',
        ]) ?>

        <?= button(
            lang('Fediverse.' . $action . '.submit'),
            '',
            [
                'variant' => 'primary',
            ],
            [
                'type' => 'submit',
                'class' => 'self-end',
            ],
        ) ?>
        <?= form_close() ?>
    </main>
</body>
