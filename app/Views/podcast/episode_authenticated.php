<?= $this->extend('podcast/_layout_authenticated') ?>

<?= $this->section('meta-tags') ?>
<title><?= $episode->title ?></title>
<meta name="description" content="<?= htmlspecialchars(
    $episode->description,
) ?>" />
<link rel="canonical" href="<?= $episode->link ?>" />
<meta property="og:title" content="<?= $episode->title ?>" />
<meta property="og:description" content="<?= $episode->description ?>" />
<meta property="og:locale" content="<?= $podcast->language_code ?>" />
<meta property="og:site_name" content="<?= $podcast->title ?>" />
<meta property="og:url" content="<?= current_url() ?>" />
<meta property="og:image" content="<?= $episode->image->large_url ?>" />
<meta property="og:image:width" content="<?= config('Images')->largeSize ?>" />
<meta property="og:image:height" content="<?= config('Images')->largeSize ?>" />
<meta property="og:description" content="$description" />
<meta property="article:published_time" content="<?= $episode->published_at ?>" />
<meta property="article:modified_time" content="<?= $episode->updated_at ?>" />
<meta property="og:audio" content="<?= $episode->audio_file_opengraph_url ?>" />
<meta property="og:audio:type" content="<?= $episode->audio_file_mimetype ?>" />
<link rel="alternate" type="application/json+oembed" href="<?= base_url(
    route_to('episode-oembed-json', $podcast->name, $episode->slug),
) ?>" title="<?= $episode->title ?> oEmbed json" />
<link rel="alternate" type="text/xml+oembed" href="<?= base_url(
    route_to('episode-oembed-xml', $podcast->name, $episode->slug),
) ?>" title="<?= $episode->title ?> oEmbed xml" />
<meta name="twitter:title" content="<?= $episode->title ?>" />
<meta name="twitter:description" content="<?= $episode->description ?>" />
<meta name="twitter:image" content="<?= $episode->image->large_url ?>" />
<meta name="twitter:card" content="player" />
<meta property="twitter:audio:partner" content="<?= $podcast->publisher ?>" />
<meta property="twitter:audio:artist_name" content="<?= $podcast->owner_name ?>" />
<meta name="twitter:player" content="<?= $episode->getEmbeddablePlayerUrl(
    'light',
) ?>" />
<meta name="twitter:player:width" content="600" />
<meta name="twitter:player:height" content="200" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto">
    <a href="<?= route_to(
        'podcast-episodes',
        $podcast->name,
    ) ?>" class="inline-flex items-center px-4 py-2 mb-2 text-sm"><?= icon(
    'arrow-left',
    'mr-2 mb- text-lg',
) . lang('Episode.back_to_episodes', ['podcast' => $podcast->title]) ?></a>
    <header class="flex flex-col px-6 mb-4 rounded-b-xl">
        <div class="flex flex-wrap items-start">
            <img src="<?= $episode->image
                ->medium_url ?>" alt="<?= $episode->title ?>" class="mb-4 mr-6 rounded-xl w-52" />
            <div class="flex flex-col items-start flex-1 mb-4" style="min-width: 14rem">
                <h1 class="text-xl font-bold leading-none font-display line-clamp-2"><?= $episode->title ?></h1>
                <?= episode_numbering(
                    $episode->number,
                    $episode->season_number,
                    'text-gray-700',
                ) ?>
                <div class="mb-4 text-xs">
                    <time pubdate datetime="<?= $episode->published_at->format(
                        DateTime::ATOM,
                    ) ?>" title="<?= $episode->published_at ?>">
                        <?= lang('Common.mediumDate', [
                            $episode->published_at,
                        ]) ?>
                    </time>
                    <span class="mx-1">•</span>
                    <time datetime="PT<?= $episode->audio_file_duration ?>S">
                        <?= format_duration($episode->audio_file_duration) ?>
                    </time>
                </div>
                <div class="mb-2 space-x-4 text-sm">
                    <?= anchor(
                        route_to('episode', $podcast->name, $episode->slug),
                        icon('chat', 'text-xl mr-1 text-gray-400') .
                            $episode->notes_total,
                        [
                            'class' =>
                                'inline-flex items-center hover:underline',
                            'title' => lang('Episode.total_notes', [
                                'numberOfTotalNotes' => $episode->notes_total,
                            ]),
                        ],
                    ) ?>
                    <?= anchor(
                        route_to('episode', $podcast->name, $episode->slug),
                        icon('repeat', 'text-xl mr-1 text-gray-400') .
                            $episode->reblogs_total,
                        [
                            'class' =>
                                'inline-flex items-center hover:underline',
                            'title' => lang('Episode.total_reblogs', [
                                'numberOfTotalReblogs' =>
                                    $episode->reblogs_total,
                            ]),
                        ],
                    ) ?>
                    <?= anchor(
                        route_to('episode', $podcast->name, $episode->slug),
                        icon('heart', 'text-xl mr-1 text-gray-400') .
                            $episode->favourites_total,
                        [
                            'class' =>
                                'inline-flex items-center hover:underline',
                            'title' => lang('Episode.total_favourites', [
                                'numberOfTotalFavourites' =>
                                    $episode->favourites_total,
                            ]),
                        ],
                    ) ?>
                </div>
                <?php if ($episode->location !== null): ?>
                    <?= location_link($episode->location, 'text-sm mb-4') ?>
                <?php endif; ?>
                <?php if ($episodePersons): ?>
                    <div class="flex w-full space-x-2 overflow-y-auto">
                        <?php foreach ($episodePersons as $person): ?>
                            <?php if ($person['information_url']): ?>
                                <a href="<?= $person[
                                    'information_url'
                                ] ?>" target="_blank" rel="noreferrer noopener" class="flex-shrink-0">
                                    <img src="<?= $person[
                                        'thumbnail_url'
                                    ] ?>" alt="<?= $person[
    'full_name'
] ?>" class="object-cover w-12 h-12 rounded-full" data-toggle="tooltip" data-placement="bottom" title="[<?= $person[
    'full_name'
] ?>] <?= $person['roles'] ?>" /></a>
                            <?php else: ?>
                                <img src="<?= $person[
                                    'thumbnail_url'
                                ] ?>" alt="<?= $person[
    'full_name'
] ?>" class="object-cover w-12 h-12 rounded-full" data-toggle="tooltip" data-placement="bottom" title="[<?= $person[
    'full_name'
] ?>] <?= $person['roles'] ?>" />
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <audio controls preload="none" class="w-full mt-auto">
            <source src="<?= $episode->audio_file_web_url ?>" type="<?= $episode->audio_file_mimetype ?>">
            Your browser does not support the audio tag.
        </audio>
    </header>

    <div class="tabset">
        <input type="radio" name="tabset" id="activity" aria-controls="activity" checked="checked" />
        <label for="activity"><?= lang('Episode.activity') ?></label>

        <input type="radio" name="tabset" id="description" aria-controls="description" />
        <label for="description"><?= lang('Episode.description') ?></label>

        <div class="tab-panels">
            <section id="activity" class="space-y-8 tab-panel">
                <?= form_open(route_to('note-attempt-create', $podcast->name), [
                    'class' => 'flex p-4 bg-white shadow rounded-xl',
                ]) ?>
                <?= csrf_field() ?>

                <?= view('_message_block') ?>

                <img src="<?= interact_as_actor()
                    ->avatar_image_url ?>" alt="<?= interact_as_actor()
    ->display_name ?>" class="w-12 h-12 mr-4 rounded-full" />
                <div class="flex flex-col flex-1 min-w-0">
                    <?= form_textarea(
                        [
                            'id' => 'message',
                            'name' => 'message',
                            'class' => 'form-textarea mb-2',
                            'required' => 'required',
                            'placeholder' => lang(
                                'Note.form.episode_message_placeholder',
                            ),
                        ],
                        old('message', '', false),
                        [
                            'rows' => 2,
                        ],
                    ) ?>
                    <?= form_input([
                        'id' => 'episode_url',
                        'name' => 'episode_url',
                        'value' => $episode->link,
                        'type' => 'hidden',
                    ]) ?>
                    <?= button(
                        lang('Note.form.submit'),
                        '',
                        ['variant' => 'primary', 'size' => 'small'],
                        ['type' => 'submit', 'class' => 'self-end'],
                    ) ?>
                </div>
                <?= form_close() ?>
                <hr class="my-4 border border-pine-100">
                <?php foreach ($episode->notes as $note): ?>
                    <?= view('podcast/_partials/note_authenticated', [
                        'note' => $note,
                    ]) ?>
                <?php endforeach; ?>
            </section>
            <section id="description" class="prose tab-panel">
                <?= $episode->getDescriptionHtml('-+Website+-') ?>
            </section>
        </div>
    </div>
</div>

<?= $this->endSection()
?>
