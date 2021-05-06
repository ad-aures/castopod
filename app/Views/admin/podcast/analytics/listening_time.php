<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="mb-12 text-center">
<h2><?= lang('Charts.daily_listening_time') ?></h2>
<div class="chart-xy" id="by-day-listening-time-graph" data-chart-type="xy-duration-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'Podcast',
    'TotalListeningTimeByDay',
) ?>"></div>
</div>

<div class="mb-12 text-center">
<h2><?= lang('Charts.monthly_listening_time') ?></h2>
<div class="chart-xy" id="by-month-listening-time-graph" data-chart-type="xy-duration-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'Podcast',
    'TotalListeningTimeByMonth',
) ?>"></div>
</div>

<script src="/assets/charts.js" type="module"></script>
<?= $this->endSection() ?>
