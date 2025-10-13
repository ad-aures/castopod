<?= helper('page') ?>

<!DOCTYPE html>
<html lang="<?= service('request')
    ->getLocale() ?>">

<?= service('html_head') ?>

<body class="flex flex-col min-h-screen mx-auto md:min-h-full md:grid md:grid-cols-podcast bg-base theme-<?= service('settings')
    ->get('App.theme') ?>">
    <?php if (can_user_interact()): ?>
        <div class="col-span-full">
            <?= $this->include('_admin_navbar') ?>
        </div>
    <?php endif; ?>

    <nav class="flex items-center justify-between h-10 col-start-2 text-white bg-header">
        <a href="<?= route_to('podcast-episodes', esc($podcast->handle)) ?>" class="flex items-center h-full min-w-0 px-2 gap-x-2" title="<?= lang('Episode.back_to_episodes', [
            'podcast' => esc($podcast->title),
        ]) ?>">
            <?= icon('arrow-left-line', [
                'class' => 'text-lg flex-shrink-0',
            ]) ?>
            <div class="flex items-center min-w-0 gap-x-2">
                <img class="w-8 h-8 rounded-full" src="<?= $episode->podcast->cover->tiny_url ?>" alt="<?= esc($episode->podcast->title) ?>" loading="lazy" />
                <div class="flex flex-col overflow-hidden">
                    <span class="text-sm font-semibold leading-none truncate"><?= esc($episode->podcast->title) ?></span>
                    <span class="text-xs"><?= lang('Podcast.fediverseFollowers', [
                        'numberOfFollowers' => $podcast->actor->followers_count,
                    ]) ?></span>
                </div>
            </div>
        </a>
        <div class="inline-flex items-center self-end h-full px-2 gap-x-2">
            <?php if (in_array(true, array_column($podcast->fundingPlatforms, 'is_visible'), true)): ?>
                <button class="p-2 text-red-600 bg-white rounded-full shadow hover:text-red-500" data-toggle="funding-links" data-toggle-class="hidden" title="<?= lang('Podcast.funding') ?>"><?= icon('heart-fill') ?></button>
            <?php endif; ?>
            <?= anchor_popup(
                route_to('follow', esc($podcast->handle)),
                icon(
                    'social:castopod',
                    [
                        'class' => 'mr-2 text-xl text-black/75 group-hover:text-black',
                    ],
                ) . lang('Podcast.follow'),
                [
                    'width'  => 420,
                    'height' => 620,
                    'class'  => 'group inline-flex items-center px-3 leading-8 text-xs tracking-wider font-semibold text-black uppercase rounded-full shadow bg-white',
                ],
            ) ?>
        </div>
    </nav>
    <header class="relative z-50 flex flex-col col-start-2 px-8 pt-8 pb-4 overflow-hidden bg-accent-base/75 gap-y-4">
        <div class="absolute top-0 left-0 w-full h-full bg-center bg-no-repeat bg-cover blur-lg mix-blend-overlay filter grayscale" style="background-image: url('<?= get_podcast_banner_url($episode->podcast, 'small') ?>');"></div>
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-background-header to-transparent"></div>
        <div class="z-10 flex flex-col items-start gap-y-2 gap-x-4 sm:flex-row">
            <div class="relative flex-shrink-0">
                <?= explicit_badge($episode->parental_advisory === 'explicit', 'rounded absolute left-0 bottom-0 ml-2 mb-2 bg-black/75 text-accent-contrast') ?>
                <?php if ($episode->is_premium): ?>
                    <?= icon('exchange-dollar-fill', [
                        'class' => 'absolute left-0 w-8 pl-2 text-2xl rounded-r-full rounded-tl-lg top-2 text-accent-contrast bg-accent-base',
                    ]) ?>
                <?php endif; ?>
                <img src="<?= $episode->cover->medium_url ?>" alt="<?= esc($episode->title) ?>" class="flex-shrink-0 rounded-md shadow-xl h-36 aspect-square" loading="lazy" />
            </div>
            <div class="flex flex-col items-start w-full min-w-0 text-white">
                <?= episode_numbering($episode->number, $episode->season_number, 'text-sm leading-none font-semibold px-1 py-1 text-white/90 border !no-underline border-subtle', true) ?>
                <h1 class="inline-flex items-baseline max-w-lg mt-2 text-2xl font-bold sm:leading-none sm:text-3xl font-display line-clamp-2" title="<?= esc($episode->title) ?>"><?= esc($episode->title) ?></h1>
                <div class="flex items-center w-full mt-4 gap-x-8">
                <?php if ($episode->persons !== []): ?>
                    <button class="flex items-center flex-shrink-0 text-xs font-semibold gap-x-2 hover:underline" data-toggle="persons-list" data-toggle-class="hidden">
                        <span class="inline-flex flex-row-reverse">
                            <?php $i = 0; ?>
                            <?php foreach ($episode->persons as $person): ?>
                                <img src="<?= get_avatar_url($person, 'thumbnail') ?>" alt="<?= esc($person->full_name) ?>" class="object-cover w-8 h-8 -ml-4 border-2 rounded-full aspect-square border-background-header last:ml-0" loading="lazy" />
                                <?php $i++;
                                if ($i === 3) {
                                    break;
                                }?>
                            <?php endforeach; ?>
                        </span>
                        <?= lang('Episode.persons', [
                            'personsCount' => count($episode->persons),
                        ]) ?>
                    </button>
                <?php endif; ?>
                <?php if ($episode->location): ?>
                    <?= location_link($episode->location, 'text-xs font-semibold p-2') ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="z-10 inline-flex items-center text-white gap-x-4">
            <play-episode-button
                id="<?= $episode->id ?>"
                imageSrc="<?= $episode->cover->thumbnail_url ?>"
                title="<?= esc($episode->title) ?>"
                podcast="<?= esc($episode->podcast->title) ?>"
                src="<?= $episode->audio->file_url ?>"
                mediaType="<?= $episode->audio->file_mimetype ?>"
                playLabel="<?= lang('Common.play_episode_button.play') ?>"
                playingLabel="<?= lang('Common.play_episode_button.playing') ?>"></play-episode-button>
            <div class="text-xs">
                <?php if ($episode->published_at):  ?>
                    <?= relative_time($episode->published_at) ?>
                <?php else: ?>
                    <?= lang('Episode.preview.not_published') ?>
                <?php endif; ?>
                <span class="mx-1">•</span>
                <time datetime="PT<?= round($episode->audio->duration, 3) ?>S">
                    <?= format_duration_symbol((int) $episode->audio->duration) ?>
                </time>
            </div>
        </div>
    </header>
    <div class="col-start-2 px-8 py-4 text-white bg-header">
        <h2 class="text-xs font-bold tracking-wider uppercase whitespace-pre-line font-display"><?= lang('Episode.description') ?></h2>
        <?php if (substr_count($episode->description_markdown, "\n") > 6 || strlen($episode->description) > 500): ?>
            <x-SeeMore class="max-w-xl prose-sm text-white"><?= $episode->description_html ?></x-SeeMore>
        <?php else: ?>
            <div class="max-w-xl prose-sm text-white"><?= $episode->description_html ?></div>
        <?php endif; ?>
    </div>
    <?= $this->include('episode/_partials/navigation') ?>
    <?= $this->include('podcast/_partials/premium_banner') ?>
    <div class="flex flex-wrap items-center min-h-[2.5rem] col-start-2 p-1 mt-2 md:mt-4 rounded-conditional-full gap-y-2 sm:flex-row bg-accent-base text-accent-contrast" role="alert">
        <div class="flex flex-wrap gap-4 pl-2">
            <div class="inline-flex items-center gap-2 font-semibold tracking-wide uppercase">
                <?= icon('eye-fill') ?>
                <span class="text-xs"><?= lang('Episode.preview.title') ?></span>
            </div>
            <p class="text-sm">
                <?= lang('Episode.preview.text', [
                    'publication_status' => $episode->publication_status,
                    'publication_date'   => $episode->published_at ? local_datetime($episode->published_at) : null,
                ], null, false); ?>
            </p>
        </div>
        <?php if (auth()->loggedIn()): ?>
            <?php if (in_array($episode->publication_status, ['scheduled', 'with_podcast'], true)): ?>
                <?php // @icon("upload-cloud-fill")?>
                <x-Button
                    iconLeft="upload-cloud-fill"
                    variant="primary"
                    size="small"
                    class="ml-auto"
                    uri="<?= route_to('episode-publish_edit', $episode->podcast_id, $episode->id) ?>"><?= lang('Episode.preview.publish_edit') ?></x-Button>
            <?php else: ?>
                <?php // @icon("upload-cloud-fill")?>
                <x-Button
                    iconLeft="upload-cloud-fill"
                    variant="secondary"
                    size="small"
                    class="ml-auto"
                    uri="<?= route_to('episode-publish', $episode->podcast_id, $episode->id) ?>"><?= lang('Episode.preview.publish') ?></x-Button>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="relative grid items-start flex-1 col-start-2 grid-cols-podcastMain gap-x-6">
        <main class="w-full col-start-1 row-start-1 py-6 col-span-full md:col-span-1">
            <?= $this->renderSection('content') ?>
        </main>
        <div data-sidebar-toggler="backdrop" class="absolute top-0 left-0 z-10 hidden w-full h-full bg-backdrop/75 md:hidden" role="button" tabIndex="0" aria-label="<?= lang('Common.close') ?>"></div>
        <?= $this->include('podcast/_partials/sidebar') ?>
    </div>
    <?= view('_persons_modal', [
        'title' => lang('Episode.persons_list', [
            'episodeTitle' => esc($episode->title),
        ]),
        'persons' => $episode->persons,
    ]) ?>
    <?php if (in_array(true, array_column($podcast->fundingPlatforms, 'is_visible'), true)): ?>
        <?= $this->include('podcast/_partials/funding_links_modal') ?>
    <?php endif; ?>
</body>
