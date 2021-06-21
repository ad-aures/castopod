<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />

    <title><?= lang('ActivityPub.' . $action . '.title', [
        'actorDisplayName' => $status->actor->display_name,
    ]) ?></title>
    <meta name="description" content="<?= $status->message ?>"/>
    <meta property="og:title" content="<?= lang(
        'ActivityPub.' . $action . '.title',
        [
            'actorDisplayName' => $status->actor->display_name,
        ],
    ) ?>"/>
    <meta property="og:locale" content="<?= service(
        'request',
    )->getLocale() ?>" />
    <meta property="og:site_name" content="<?= $status->actor->display_name ?>" />
    <meta property="og:url" content="<?= current_url() ?>" />
    <meta property="og:image" content="<?= $status->actor->avatar_image_url ?>" />
    <meta property="og:description" content="<?= $status->message ?>" />

    <link rel="stylesheet" href="/assets/index.css"/>
    <script src="/assets/podcast.js" type="module"></script>
</head>

<body class="min-h-screen mx-auto bg-pine-50">
    <header class="pt-8 pb-32 bg-pine-900">
        <h1 class="text-lg font-semibold text-center text-white"><?= lang(
            'ActivityPub.' . $action . '.subtitle',
        ) ?></h1>
    </header>
    <main class="flex-1 max-w-xl px-4 pb-8 mx-auto -mt-24">
        <?= $this->include('podcast/_partials/status') ?>

        <?= form_open(
            route_to('status-attempt-remote-action', $status->id, $action),
            ['method' => 'post', 'class' => 'flex flex-col mt-8'],
        ) ?>
        <?= csrf_field() ?>
        <?= view('_message_block') ?>

        <?= form_label(
            lang('ActivityPub.your_handle'),
            'handle',
            [],
            lang('ActivityPub.your_handle_hint'),
        ) ?>
        <?= form_input([
            'id' => 'handle',
            'name' => 'handle',
            'class' => 'form-input mb-4',
            'required' => 'required',
            'type' => 'text',
        ]) ?>

        <?= button(
            lang('ActivityPub.' . $action . '.submit'),
            '',
            ['variant' => 'primary'],
            ['type' => 'submit', 'class' => 'self-end'],
        ) ?>
        <?= form_close() ?>
    </main>
</body>
