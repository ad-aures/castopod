<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= esc($podcast->title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <x-Charts.XY class="col-span-1" title="<?= lang('Charts.podcast_by_day') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'Podcast',
        'ByDay',
    ) ?>"/>

    <x-Charts.XY class="col-span-1" title="<?= lang('Charts.podcast_by_month') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'Podcast',
        'ByMonth',
    ) ?>"/>

    <x-Charts.XY class="col-span-1" title="<?= lang('Charts.podcast_by_bandwidth') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'Podcast',
        'BandwidthByDay',
    ) ?>"/>
</div>

<?= service('vite')
    ->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
