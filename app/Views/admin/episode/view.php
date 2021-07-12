<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= $episode->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $episode->title ?>    
<?= $this->endSection() ?>

<?= $this->section('headerLeft') ?>
<?= publication_pill(
    $episode->published_at,
    $episode->publication_status,
    'text-sm ml-2 align-middle',
) ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= publication_button(
    $podcast->id,
    $episode->id,
    $episode->publication_status,
) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
   
<div class="flex flex-wrap">
    <div class="w-full max-w-sm mb-6 md:mr-4">
        <img
            src="<?= $episode->image->medium_url ?>"
            alt="Episode cover"
            class="object-cover w-full"
        />
        <audio controls preload="auto" class="w-full mb-6">
        <source src="<?= $episode->audio_file_url ?>" type="<?= $episode->audio_file_mimetype ?>">
        Your browser does not support the audio tag.
        </audio>

        <div class="flex justify-around">
        <?= button(
            lang('Episode.edit'),
            route_to('episode-edit', $podcast->id, $episode->id),
            ['variant' => 'info', 'iconLeft' => 'edit'],
        ) ?>
        <?= button(
            lang('Episode.go_to_page'),
            route_to('episode', $podcast->name, $episode->slug),
            ['variant' => 'secondary', 'iconLeft' => 'external-link'],
        ) ?>
        <?= button(
            lang('Episode.delete'),
            route_to('episode-delete', $podcast->id, $episode->id),
            ['variant' => 'danger', 'iconLeft' => 'delete-bin'],
        ) ?>
        </div>
    </div>

    <section class="w-full max-w-sm prose">
    <?= location_link($episode->location, 'text-sm') ?>
    <?= $episode->description_html ?>
    </section>
</div>

    <div class="mb-12">
    <?= button(
        lang('Episode.embeddable_player.add'),
        route_to('embeddable-player-add', $podcast->id, $episode->id),
        ['variant' => 'info', 'iconLeft' => 'movie'],
        ['class' => 'mb-4'],
    ) ?>
    <?= button(
        lang('Episode.soundbites_form.title'),
        route_to('soundbites-edit', $podcast->id, $episode->id),
        ['variant' => 'info', 'iconLeft' => 'edit'],
        ['class' => 'mb-4'],
    ) ?>
    <?= button(
        lang('Person.episode_form.title'),
        route_to('episode-person-manage', $podcast->id, $episode->id),
        ['variant' => 'info', 'iconLeft' => 'folder-user'],
        ['class' => 'mb-4'],
    ) ?>
    <?php if (count($episode->soundbites) > 0): ?>
    <?= data_table(
        [
            [
                'header' => 'Play',
                'cell' => function ($soundbite): string {
                    return icon_button(
                        'play',
                        lang('Episode.soundbites_form.play'),
                        '',
                        ['variant' => 'primary'],
                        [
                            'class' => 'mb-1 mr-1',
                            'data-type' => 'play-soundbite',
                            'data-soundbite-start-time' =>
                                $soundbite->start_time,
                            'data-soundbite-duration' => $soundbite->duration,
                        ],
                    );
                },
            ],
            [
                'header' => lang('Episode.soundbites_form.start_time'),
                'cell' => function ($soundbite): string {
                    return format_duration($soundbite->start_time);
                },
            ],
            [
                'header' => lang('Episode.soundbites_form.duration'),
                'cell' => function ($soundbite): string {
                    return format_duration($soundbite->duration);
                },
            ],
            [
                'header' => lang('Episode.soundbites_form.label'),
                'cell' => function ($soundbite) {
                    return $soundbite->label;
                },
            ],
        ],
        $episode->soundbites,
    ) ?>
    <?php endif; ?>
    </div>

    <div class="mb-12 text-center">
    <h2><?= lang('Charts.episode_by_day') ?></h2>
    <div class="chart-xy" id="by-day-graph" data-chart-type="xy-chart" data-chart-url="<?= route_to(
        'analytics-filtered-data',
        $podcast->id,
        'PodcastByEpisode',
        'ByDay',
        $episode->id,
    ) ?>"></div>
    </div>
    
    <div class="mb-12 text-center">
    <h2><?= lang('Charts.episode_by_month') ?></h2>
    <div class="chart-xy" id="by-month-graph" data-chart-type="xy-chart" data-chart-url="<?= route_to(
        'analytics-filtered-data',
        $podcast->id,
        'PodcastByEpisode',
        'ByMonth',
        $episode->id,
    ) ?>"></div>
    </div>


<?= service('vite')->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
