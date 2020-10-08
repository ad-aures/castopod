<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h2><?= lang('Charts.podcast_by_day') ?></h2>
<div class="h-64" id="by-day-graph" data-chart-type="xy-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'Podcast',
    'ByDay'
) ?>"></div>

<h2><?= lang('Charts.podcast_by_month') ?></h2>
<div class="h-64" id="by-month-graph" data-chart-type="xy-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'Podcast',
    'ByMonth'
) ?>"></div>

<h2><?= lang('Charts.unique_daily_listeners') ?></h2>
<div class="h-64" id="by-day-listeners-graph" data-chart-type="xy-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'Podcast',
    'UniqueListenersByDay'
) ?>"></div>

<h2><?= lang('Charts.unique_monthly_listeners') ?></h2>
<div class="h-64" id="by-month-listeners-graph" data-chart-type="xy-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'Podcast',
    'UniqueListenersByMonth'
) ?>"></div>

<h2><?= lang('Charts.episodes_by_day') ?></h2>
<div class="h-64" id="by-age-graph" data-chart-type="xy-series-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'PodcastByEpisode',
    'ByDay'
) ?>"></div>

<h2><?= lang('Charts.by_player') ?></h2>
<div class="h-64" id="by-app-pie" data-chart-type="pie-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'PodcastByPlayer',
    'ByApp'
) ?>"></div>

<h2><?= lang('Charts.by_browser') ?></h2>
<div class="h-64" id="by-browser-pie" data-chart-type="pie-chart" data-chart-url="<?= route_to(
    'analytics-full-data',
    $podcast->id,
    'WebsiteByBrowser'
) ?>"></div>

<h2><?= lang('Charts.by_country') ?></h2>
<div class="h-64" id="by-country-pie" data-chart-type="pie-chart" data-chart-url="<?= route_to(
    'analytics-full-data',
    $podcast->id,
    'PodcastByCountry'
) ?>"></div>

<h2><?= lang('Charts.by_domain') ?></h2>
<div class="h-64" id="by-domain-pie" data-chart-type="pie-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'WebsiteByReferer',
    'ByDomain'
) ?>"></div>

<script src="/assets/charts.js" type="module"></script>
<?= $this->endSection() ?>
