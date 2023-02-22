<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= esc($podcast->title) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= esc($podcast->title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <Charts.XY class="col-span-1" title="<?= lang('Charts.daily_listening_time') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'Podcast',
        'TotalListeningTimeByDay',
    ) ?>"/>

    <Charts.XY class="col-span-1" title="<?= lang('Charts.monthly_listening_time') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'Podcast',
        'TotalListeningTimeByMonth',
    ) ?>"/>
</div>

<?= service('vite')
    ->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
