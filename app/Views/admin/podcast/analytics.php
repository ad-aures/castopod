<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="h-64" id="by-app-pie" data-chart-type="pie-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'PodcastsByPlayer',
    'ByApp'
) ?>"></div>
<div class="h-64" id="by-day-graph" data-chart-type="xy-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'Podcasts',
    'ByDay'
) ?>"></div>
<div class="h-64" id="by-age-graph" data-chart-type="xy-series-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'PodcastsByEpisode',
    'ByDay'
) ?>"></div>

<script src="/assets/charts.js" type="module"></script>
<?= $this->endSection() ?>
