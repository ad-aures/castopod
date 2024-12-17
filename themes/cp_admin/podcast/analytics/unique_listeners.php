<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= esc($podcast->title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <x-Charts.XY class="col-span-1" title="<?= lang('Charts.unique_daily_listeners') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'Podcast',
        'UniqueListenersByDay',
    ) ?>"/>

    <x-Charts.XY class="col-span-1" title="<?= lang('Charts.unique_monthly_listeners') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'Podcast',
        'UniqueListenersByMonth',
    ) ?>"/>
</div>

<?= service('vite')
        ->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
