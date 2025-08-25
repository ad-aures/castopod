<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= esc($podcast->title) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= esc($podcast->title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <Charts.Bar title="<?= lang('Charts.by_weekday') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'Podcast',
        'ByWeekday',
    ) ?>" />
    <Charts.Bar title="<?= lang('Charts.by_hour') ?>" dataUrl="<?= route_to(
        'analytics-full-data',
        $podcast->id,
        'PodcastByHour',
    ) ?>" />
</div>

<?= service('vite')
    ->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
