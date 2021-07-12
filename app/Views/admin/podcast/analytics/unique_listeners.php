<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="mb-12 text-center">
<h2><?= lang('Charts.unique_daily_listeners') ?></h2>
<div class="chart-xy" id="by-day-listeners-graph" data-chart-type="xy-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'Podcast',
    'UniqueListenersByDay',
) ?>"></div>
</div>

<div class="mb-12 text-center">
<h2><?= lang('Charts.unique_monthly_listeners') ?></h2>
<div class="chart-xy" id="by-month-listeners-graph" data-chart-type="xy-chart" data-chart-url="<?= route_to(
    'analytics-data',
    $podcast->id,
    'Podcast',
    'UniqueListenersByMonth',
) ?>"></div>
</div>

<?= service('vite')->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
