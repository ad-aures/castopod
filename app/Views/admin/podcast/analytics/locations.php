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
        <h2><?= lang('Charts.by_country_weekly') ?></h2>
        <div class="chart-pie" id="by-country-pie" data-chart-type="pie-chart" data-chart-url="<?= route_to(
            'analytics-data',
            $podcast->id,
            'PodcastByCountry',
            'Weekly',
        ) ?>"></div>
    </div>

    <div class="mb-12 mr-6 text-center">
        <h2><?= lang('Charts.by_country_yearly') ?></h2>
        <div class="chart-pie" id="by-country-by-year-pie" data-chart-type="pie-chart" data-chart-url="<?= route_to(
            'analytics-data',
            $podcast->id,
            'PodcastByCountry',
            'Yearly',
        ) ?>"></div>
    </div>
</div>

<div class="mb-12 mr-6 text-center">
<h2><?= lang('Charts.podcast_by_region') ?></h2>
<div class="chart-map" id="by-region-map" data-chart-type="map-chart" data-chart-url="<?= route_to(
    'analytics-full-data',
    $podcast->id,
    'PodcastByRegion',
) ?>"></div>
</div>


<script src="/assets/charts.js" type="module"></script>
<?= $this->endSection() ?>
