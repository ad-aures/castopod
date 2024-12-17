<?= helper('page') ?>

<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<?= service('html_head')
    ->appendRawContent(service('vite')->asset('styles/index.css', 'css'))
    ->appendRawContent(service('vite')->asset('js/podcast.ts', 'js'))
?>

<body class="flex flex-col min-h-screen bg-base theme-<?= service('settings')
    ->get('App.theme') ?>">
    <header class="flex flex-col items-center mb-8">
        <h1 class="w-full pt-8 pb-32 text-lg font-semibold text-center text-white bg-header"><?= lang(
            'Fediverse.follow.subtitle',
        ) ?></h1>
        <div class="flex flex-col w-full -mt-24 overflow-hidden shadow max-w-fit bg-elevated rounded-xl">
            <img src="<?= get_podcast_banner_url($actor->podcast, 'small') ?>" alt="" class="w-full aspect-[3/1] bg-header" loading="lazy" />
            <div class="flex px-4 py-2">
                <img src="<?= $actor->avatar_image_url ?>" alt="<?= esc($actor->display_name) ?>"
                    class="w-16 h-16 mr-4 -mt-8 rounded-full ring-2 ring-background-elevated aspect-square" loading="lazy" />
                <div class="flex flex-col">
                    <p class="font-semibold"><?= esc($actor->display_name) ?></p>
                    <p class="text-sm text-skin-muted">
<span title="@<?= esc($actor->username) ?>@<?= esc($actor->domain) ?>" data-tooltip="bottom">@<?= esc($actor->username) ?>@<?= esc($actor->domain) ?></span></p>
                </div>
            </div>
        </div>
    </header>

    <main class="w-full max-w-md px-4 mx-auto">
        <form action="<?= route_to('attempt-follow', esc($actor->username)) ?>" method="POST" class="flex flex-col gap-y-2">
            <?= csrf_field() ?>
            <?= view('_message_block') ?>
            <x-Forms.Field
                name="handle"
                label="<?= esc(lang('Fediverse.your_handle')) ?>"
                hint="<?= esc(lang('Fediverse.your_handle_hint')) ?>"
                isRequired="true"
            />
            <?php // @icon("send-plane-2-fill")?>
            <x-Button variant="primary" type="submit" class="self-end" iconRight="send-plane-2-fill"><?= lang('Fediverse.follow.submit') ?></x-Button>
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
