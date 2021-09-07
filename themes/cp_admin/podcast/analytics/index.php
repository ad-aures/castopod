<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <Charts.XY class="col-span-1" title="<?= lang('Charts.podcast_by_day') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'Podcast',
        'ByDay',
    ) ?>"/>

    <Charts.XY class="col-span-1" title="<?= lang('Charts.podcast_by_month') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'Podcast',
        'ByMonth',
    ) ?>"/>

    <Charts.XY class="col-span-1" title="<?= lang('Charts.podcast_by_bandwidth') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'Podcast',
        'BandwidthByDay',
    ) ?>"/>
</div>

<?= service('vite')->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
