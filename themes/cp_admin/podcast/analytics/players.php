<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= esc($podcast->title) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= esc($podcast->title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <Charts.Pie title="<?= lang('Charts.by_player_weekly') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'PodcastByPlayer',
        'ByAppWeekly',
    ) ?>" />
    <Charts.Pie title="<?= lang('Charts.by_service_weekly') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'PodcastByService',
        'ByServiceWeekly',
    ) ?>" />
    <Charts.Pie title="<?= lang('Charts.by_device_weekly') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'PodcastByPlayer',
        'ByDeviceWeekly',
    ) ?>" />
    <Charts.Pie title="<?= lang('Charts.by_os_weekly') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'PodcastByPlayer',
        'ByOsWeekly',
    ) ?>" />
    <Charts.XY class="col-span-2" title="<?= lang('Charts.podcast_bots') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'PodcastByPlayer',
        'Bots',
    ) ?>" />
</div>

<?= service('vite')
    ->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
