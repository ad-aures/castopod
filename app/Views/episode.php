<?= helper('page') ?>
<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="UTF-8"/>
    <title><?= $episode->title ?></title>
    <meta name="description" content="<?= $episode->description ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<?php if (
    !empty($podcast->payment_pointer)
): ?>    <meta name="monetization" content="<?= $podcast->payment_pointer ?>">                    
<?php endif; ?>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link rel="stylesheet" href="/assets/index.css"/>
    <link rel="canonical" href="<?= current_url() ?>" />
    <script src="/assets/podcast.js" type="module" defer></script>
    <meta property="og:title" content="<?= $episode->title ?>" />
    <meta property="og:locale" content="<?= $podcast->language_code ?>" />
    <meta property="og:site_name" content="<?= $podcast->title ?>" />
    <meta property="og:url" content="<?= current_url() ?>" />
    <meta property="article:published_time" content="<?= $episode->published_at ?>" />
    <meta property="article:modified_time" content="<?= $episode->updated_at ?>" />
    <meta property="og:image" content="<?= $episode->image->large_url ?>" />
    <meta property="og:image:width" content="<?= config('Images')
        ->largeSize ?>" />
    <meta property="og:image:height" content="<?= config('Images')
        ->largeSize ?>" />
    <meta property="og:audio" content="<?= $episode->enclosure_opengraph_url ?>" />
    <meta property="og:audio:type" content="<?= $episode->enclosure_mimetype ?>" />
    <meta property="og:description" content="<?= $episode->description ?>" />
    <meta name="twitter:card" content="summary_large_image" />
</head>

<body class="flex flex-col min-h-screen mx-auto">
    <header class="border-b bg-gradient-to-tr from-gray-900 to-gray-800">
        <div class="container flex items-start px-2 py-2 mx-auto">
          <img
            class="w-12 h-12 mr-2 rounded cover"
            src="<?= $podcast->image->thumbnail_url ?>"
            alt="<?= $podcast->title ?>"
          />
          <a
            href="<?= route_to('podcast', $podcast->name) ?>"
            class="flex flex-col text-lg leading-tight text-white"
            title="<?= lang('Episode.back_to_podcast') ?>">
            <?= $podcast->title ?>
            <span class="text-sm text-gray-300">
                @<?= $podcast->name ?>
            </span>
          </a>
        </div>
    </header>
    <main class="container flex-1 mx-auto">
      <nav class="flex items-center px-2 py-4">
            <?php if ($previousEpisode): ?>
                <a class="flex items-center text-xs leading-snug text-gray-600 hover:text-gray-900" href="<?= $previousEpisode->link ?>" title="<?= $previousEpisode->title ?>">
                    <?= icon('chevron-left', 'mr-2') ?>
                    <div class="flex flex-col">
                        <?= $previousEpisode->season_number ==
                        $episode->season_number
                            ? lang('Episode.previous_episode')
                            : lang('Episode.previous_season') ?>
                        <span class="w-40 font-semibold truncate"><?= $previousEpisode->title ?></span>
                    </div>
                </a>
            <?php endif; ?>
            <?php if ($nextEpisode): ?>
                <a class="flex items-center ml-auto text-xs leading-snug text-right text-gray-600 hover:text-gray-900" href="<?= $nextEpisode->link ?>" title="<?= $nextEpisode->title ?>">
                    <div class="flex flex-col">
                        <?= $nextEpisode->season_number ==
                        $episode->season_number
                            ? lang('Episode.next_episode')
                            : lang('Episode.next_season') ?>
                        <span class="w-40 font-semibold truncate"><?= $nextEpisode->title ?></span>
                    </div>
                    <?= icon('chevron-right', 'ml-2') ?>
                </a>
            <?php endif; ?>
      </nav>
      <header class="flex flex-col items-center px-4 md:items-stretch md:justify-center md:flex-row">
        <img src="<?= $episode->image->medium_url ?>"
        alt="<?= $episode->title ?>" class="object-cover w-full max-w-xs mb-2 rounded-lg md:mb-0 md:mr-4" />
        <div class="flex flex-col w-full max-w-sm">
          <h1 class="text-lg font-semibold md:text-2xl"><?= $episode->title ?></h1>
          <?= episode_numbering(
              $episode->number,
              $episode->season_number,
              'text-gray-600'
          ) ?>
          <div class="text-sm">
              <time
              pubdate
              datetime="<?= $episode->published_at->format(DateTime::ATOM) ?>"
              title="<?= $episode->published_at ?>">
              <?= lang('Common.mediumDate', [$episode->published_at]) ?>
              </time>
              <span class="mx-1">•</span>
              <time datetime="PT<?= $episode->enclosure_duration ?>S">
                <?= format_duration($episode->enclosure_duration) ?>
              </time>
          </div>
          <div class="flex mt-2 mb-1 space-x-2">
            <?php foreach ($persons as $person): ?>
                <?php if (!empty($person['information_url'])): ?>
                    <a href="<?= $person[
                        'information_url'
                    ] ?>" target="_blank" rel="noreferrer noopener">
                <?php endif; ?>
                <img src="<?= $person['thumbnail_url'] ?>" alt="<?= $person[
    'full_name'
] ?>" title="[<?= $person['full_name'] ?>] <?= $person[
    'roles'
] ?>" class="object-cover w-12 h-12 rounded-full" />
                <?php if (!empty($person['information_url'])): ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
          </div>
          <?= location_link(
              $episode->location_name,
              $episode->location_geo,
              $episode->location_osmid,
              'self-start mt-2 mb-2'
          ) ?>
          <audio controls preload="none" class="w-full mt-auto">
            <source src="<?= $episode->enclosure_web_url ?>" type="<?= $episode->enclosure_type ?>">
            Your browser does not support the audio tag.
          </audio>
        </div>
      </header>      
      <section class="w-full max-w-3xl px-2 py-6 mx-auto prose md:px-6">
      <?= $episode->description_html ?>
      </section>
    </main>
    <footer class="px-2 py-4 border-t ">
        <div class="container flex flex-col items-center justify-between mx-auto text-xs md:flex-row ">
            <?= render_page_links('inline-flex mb-4 md:mb-0') ?>
            <div class="flex flex-col items-end">
                <p><?= $podcast->copyright ?></p>
                <p><?= lang('Common.powered_by', [
                    'castopod' =>
                        '<a class="underline hover:no-underline" href="https://castopod.org" target="_blank" rel="noreferrer noopener">Castopod</a>',
                ]) ?></p>
            </div>
        </div>
    </footer>
</body>