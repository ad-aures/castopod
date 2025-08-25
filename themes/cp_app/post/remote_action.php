<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<?= service('html_head')
    ->appendRawContent(service('vite')->asset('styles/index.css', 'css'))
    ->appendRawContent(service('vite')->asset('js/podcast.ts', 'js'))
?>

<body class="flex flex-col min-h-screen mx-auto bg-base theme-<?= service('settings')
    ->get('App.theme') ?>">
    <header class="pt-8 pb-32 bg-header">
        <h1 class="text-lg font-semibold text-center text-white"><?= lang(
            'Fediverse.' . $action . '.subtitle',
        ) ?></h1>
    </header>
    <main class="flex-1 max-w-xl px-4 pb-8 mx-auto -mt-24">
        <?= view('post/_partials/card', [
            'index'   => 1,
            'podcast' => $podcast,
            'post'    => $post,
        ]) ?>

        <form action="<?= route_to('post-attempt-remote-action', $post->id, $action) ?>" method="POST" class="flex flex-col mt-8 gap-y-2">
            <?= csrf_field() ?>
            <?= view('_message_block') ?>

            <x-Forms.Field
                name="handle"
                label="<?= esc(lang('Fediverse.your_handle')) ?>"
                hint="<?= esc(lang('Fediverse.your_handle_hint')) ?>"
                isRequired="true" />
            <?php // @icon("send-plane-2-fill")?>
            <x-Button variant="primary" type="submit" class="self-end" iconRight="send-plane-2-fill"><?= lang('Fediverse.' . $action . '.submit') ?></x-Button>
        </form>
    </main>
    <footer
        class="flex-col w-full px-2 py-4 mt-auto text-xs text-center border-t text-skin-muted border-subtle">
        <?= lang('Common.powered_by', [
            'castopod' => '<a class="inline-flex font-semibold hover:underline" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod' . icon('social:castopod', [
                'class' => 'ml-1 text-lg',
            ]) . '</a>',
        ], null, false) ?>
    </footer>
</body>
