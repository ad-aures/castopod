<?= helper('page') ?>

<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<?= service('html_head') ?>

<body class="overflow-hidden flex flex-col min-h-screen mx-auto md:min-h-full md:grid md:grid-cols-podcast bg-base theme-<?= service('settings')
    ->get('App.theme') ?>">
    <?php if (can_user_interact()): ?>
        <div class="col-span-full">
            <?= $this->include('_admin_navbar') ?>
        </div>
    <?php endif; ?>

    <div class="fixed z-50 flex flex-col items-center justify-center w-full h-full px-4 bg-accent-base/30 backdrop-blur-md">
        <a class="absolute w-full h-full" href="<?= current_url() === previous_url() ? route_to('podcast-activity', $podcast->handle) : previous_url() ?>"><span class="sr-only"><?= lang('Common.go_back') ?></span></a>
        <form class="z-10 flex flex-col items-center w-full max-w-lg p-8 text-center rounded-lg shadow-xl bg-elevated" action="<?= route_to('premium-podcast-unlock', $podcast->handle) ?>" method="POST">
            <?= csrf_field() ?>
            <?= icon('lock-fill', [
                'class' => 'p-4 text-6xl rounded-full bg-base text-accent-base',
            ]) ?>
            <x-Heading tagName="h1" size="large" class="mt-2"><?= lang('PremiumPodcasts.unlock_form.title') ?></x-Heading>
            <p class="max-w-sm text-skin-muted"><?= lang('PremiumPodcasts.unlock_form.subtitle', [
                'podcastTitle' => esc($podcast->title),
            ]) ?></p>
            <?= view('_message_block') ?>
            <x-Forms.Field
                class="self-stretch mt-4 text-left"
                name="token"
                type="password"
                label="<?= esc(lang('PremiumPodcasts.unlock_form.token')) ?>"
                hint="<?= lang('PremiumPodcasts.unlock_form.token_hint', [
                    'podcastTitle' => esc($podcast->title),
                ]) ?>"
                isRequired="true"
            />
            <?php // @icon("lock-unlock-fill")?>
            <x-Button type="submit" variant="primary" iconLeft="lock-unlock-fill" class="self-center mt-2"><?= lang('PremiumPodcasts.unlock_form.submit') ?></x-Button>
            <?php if ($subscriptionLink = service('settings')
                ->get('Subscription.link', 'podcast:' . $podcast->id)): ?>
                <p class="max-w-xs mt-4 text-xs">
                    <?= lang('PremiumPodcasts.unlock_form.call_to_action', [
                        'podcastTitle' => esc($podcast->title),
                    ]) ?>
                    <a href="<?= $subscriptionLink ?>" target="_blank" rel="noopener noreferrer" class="font-semibold underline hover:no-underline"><?= lang('PremiumPodcasts.unlock_form.subscribe_cta') ?></a>
                </p>
            <?php endif; ?>
        </form>
    </div>

    <header class="relative flex flex-col-reverse justify-between w-full col-start-2 bg-top bg-no-repeat bg-cover sm:flex-row sm:items-end bg-header aspect-[3/1]" style="background-image: url('<?= get_podcast_banner_url($podcast, 'medium') ?>');">
        <div class="absolute bottom-0 left-0 w-full h-full backdrop-gradient mix-blend-multiply"></div>
        <div class="flex items-center pl-4 -mb-6 md:pl-8 md:-mb-8 gap-x-4">
            <img src="<?= $podcast->cover->thumbnail_url ?>" alt="<?= esc($podcast->title) ?>" class="z-[45] h-24 rounded-full sm:h-28 md:h-36 ring-3 ring-background-elevated aspect-square" loading="lazy" />
            <div class="relative flex flex-col text-white -top-3 sm:top-0 md:top-2">
                <div class="text-lg font-bold leading-none line-clamp-2 md:leading-none md:text-2xl font-display"><?= esc($podcast->title) ?><span class="ml-1 font-sans text-base font-normal">@<?= esc($podcast->handle) ?></span></div>
                <div>
                    <?= explicit_badge($podcast->parental_advisory === 'explicit', 'mr-1') ?>
                    <span class="text-xs"><?= lang('Podcast.fediverseFollowers', [
                        'numberOfFollowers' => $podcast->actor->followers_count,
                    ]) ?></span>
                </div>
            </div>
        </div>
        <div class="inline-flex items-center self-end mt-2 mr-2 sm:mb-4 sm:mr-4 gap-x-2">
            <?php if (in_array(true, array_column($podcast->fundingPlatforms, 'is_visible'), true)): ?>
                <button class="p-2 text-red-600 bg-white rounded-full shadow hover:text-red-500" data-toggle="funding-links" data-toggle-class="hidden" data-tooltip="bottom" title="<?= lang('Podcast.funding') ?>"><?= icon('heart-fill') ?></button>
            <?php endif; ?>
        </div>
    </header>
    <?= $this->include('podcast/_partials/navigation') ?>
    <div class="relative grid items-start flex-1 col-start-2 grid-cols-podcastMain gap-x-6">
        <main class="w-full max-w-xl col-start-1 row-start-1 py-6 mx-auto col-span-full md:col-span-1"></main>
        <?= $this->include('podcast/_partials/sidebar') ?>
    </div>

    <?php if (in_array(true, array_column($podcast->fundingPlatforms, 'is_visible'), true)): ?>
        <?= $this->include('podcast/_partials/funding_links_modal') ?>
    <?php endif; ?>

</body>
