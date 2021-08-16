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
    route_to('episode-oembed-json', $podcast->handle, $episode->slug),
) ?>" title="<?= $episode->title ?> oEmbed json" />
<link rel="alternate" type="text/xml+oembed" href="<?= base_url(
    route_to('episode-oembed-xml', $podcast->handle, $episode->slug),
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
        $podcast->handle,
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
                    <?= relative_time($episode->published_at) ?>
                    <span class="mx-1">•</span>
                    <time datetime="PT<?= $episode->audio_file_duration ?>S">
                        <?= format_duration($episode->audio_file_duration) ?>
                    </time>
                </div>
                <?= location_link($episode->location, 'text-sm mb-4') ?>
                <?= person_list($episode->persons) ?>
                <?= play_episode_button($episode->id, $episode->image->thumbnail_url, $episode->title, $podcast->title, $episode->audio_file_web_url, $episode->audio_file_mimetype) ?>
            </div>
        </div>
    </header>

    <div class="tabset">
        <input type="radio" name="tabset" id="comments" aria-controls="comments" checked="checked" />
        <label for="comments"><?= lang('Episode.comments') . ' (' . $episode->comments_count . ')' ?></label>
        
        <input type="radio" name="tabset" id="activity" aria-controls="activity" />
        <label for="activity"><?= lang('Episode.activity') . ' ('. $episode->posts_count .')' ?></label>

        <input type="radio" name="tabset" id="description" aria-controls="description" />
        <label for="description"><?= lang('Episode.description') ?></label>

        <div class="tab-panels">
            <section id="comments" class="space-y-6 tab-panel">
            <?= form_open(route_to('comment-attempt-create', $podcast->id, $episode->id), [
                    'class' => 'flex p-4',
                ]) ?>
                <?= csrf_field() ?>

                <?= view('_message_block') ?>

                <img src="<?= interact_as_actor()
                    ->avatar_image_url ?>" alt="<?= interact_as_actor()->display_name ?>" class="w-12 h-12 mr-4 rounded-full" />
                <div class="flex flex-col flex-1 min-w-0">
                    <?= form_textarea(
                        [
                            'id' => 'message',
                            'name' => 'message',
                            'class' => 'form-textarea mb-2',
                            'required' => 'required',
                            'placeholder' => lang(
                                'Comment.form.episode_message_placeholder',
                            ),
                        ],
                        old('message', '', false),
                        [
                            'rows' => 2,
                        ],
                    ) ?>

                    <?= button(
                        lang('Comment.form.submit'),
                        '',
                        ['variant' => 'primary', 'size' => 'small'],
                        ['type' => 'submit', 'class' => 'self-end'],
                    ) ?>
                </div>
                <?= form_close() ?>
                <?php foreach ($episode->comments as $comment): ?>
                    <?= view('podcast/_partials/comment_authenticated', ['comment' => $comment]) ?>
                <?php endforeach; ?>
            </section>
            <section id="activity" class="space-y-8 tab-panel">
                <?= form_open(route_to('post-attempt-create', $podcast->handle), [
                    'class' => 'flex p-4 bg-white shadow rounded-xl',
                ]) ?>
                <?= csrf_field() ?>

                <?= view('_message_block') ?>

                <img src="<?= interact_as_actor()
                    ->avatar_image_url ?>" alt="<?= interact_as_actor()->display_name ?>" class="w-12 h-12 mr-4 rounded-full" />
                <div class="flex flex-col flex-1 min-w-0">
                    <?= form_textarea(
                        [
                            'id' => 'message',
                            'name' => 'message',
                            'class' => 'form-textarea mb-2',
                            'required' => 'required',
                            'placeholder' => lang(
                                'Post.form.episode_message_placeholder',
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
                        lang('Post.form.submit'),
                        '',
                        ['variant' => 'primary', 'size' => 'small'],
                        ['type' => 'submit', 'class' => 'self-end'],
                    ) ?>
                </div>
                <?= form_close() ?>
                <hr class="my-4 border border-pine-100">
                <?php foreach ($episode->posts as $post): ?>
                    <?= view('podcast/_partials/post_authenticated', [
                        'post' => $post,
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
