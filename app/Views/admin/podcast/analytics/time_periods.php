<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="lg:divide-x lg:grid lg:grid-cols-2">
    <div class="mb-12 mr-6 text-center">
        <h2><?= lang('Charts.by_weekday') ?></h2>
        <div class="chart-xy" id="by-weekday-barchart" data-chart-type="bar-chart" data-chart-url="<?= route_to(
            'analytics-data',
            $podcast->id,
            'Podcast',
            'ByWeekday',
        ) ?>"></div>
    </div>

    <div class="mb-12 mr-6 text-center">
        <h2><?= lang('Charts.by_hour') ?></h2>
        <div class="chart-xy" id="by-hour-barchart" data-chart-type="bar-chart" data-chart-url="<?= route_to(
            'analytics-full-data',
            $podcast->id,
            'PodcastByHour',
        ) ?>"></div>
    </div>

</div>

<?= service('vite')->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
