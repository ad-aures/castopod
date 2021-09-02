<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="mb-12 text-center">
<h2><?= lang('Charts.podcast_by_day') ?></h2>
<div class="chart-xy" id="by-day-graph" data-chart-type="xy-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'Podcast',
    'ByDay',
) ?>"></div>
</div>

<div class="mb-12 text-center">
<h2><?= lang('Charts.podcast_by_month') ?></h2>
<div class="chart-xy" id="by-month-graph" data-chart-type="xy-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'Podcast',
    'ByMonth',
) ?>"></div>
</div>

<div class="mb-12 text-center">
<h2><?= lang('Charts.podcast_by_bandwidth') ?></h2>
<div class="chart-xy" id="by-bandwidth-graph" data-chart-type="xy-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'Podcast',
    'BandwidthByDay',
) ?>"></div>
</div>

<?= service('vite')->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
