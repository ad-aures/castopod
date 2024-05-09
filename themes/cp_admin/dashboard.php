<?= helper('components') ?>
<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Dashboard.home') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Dashboard.home') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex flex-col items-stretch gap-4 lg:flex-row">
    <?php // @icon('mic-fill')?>
    <x-DashboardCard href="<?= $onlyPodcastId === null ? route_to('podcast-list') : route_to('podcast-view', $onlyPodcastId) ?>" glyph="mic-fill" title="<?= lang('Dashboard.podcasts.title') ?>" subtitle="<?= $podcastsData['last_published_at'] ? esc(lang('Dashboard.podcasts.last_published', [
        'lastPublicationDate' => local_date($podcastsData['last_published_at']),
    ], null, false)) : lang('Dashboard.podcasts.not_found') ?>"><?= $podcastsData['number_of_podcasts'] ?></x-DashboardCard>
    <?php // @icon('play-fill')?>
    <x-DashboardCard href="<?= $onlyPodcastId === null ? '' : route_to('episode-list', $onlyPodcastId) ?>" glyph="play-fill" title="<?= lang('Dashboard.episodes.title') ?>" subtitle="<?= $episodesData['last_published_at'] ? esc(lang('Dashboard.episodes.last_published', [
        'lastPublicationDate' => local_date($episodesData['last_published_at']),
    ], null, false)) : lang('Dashboard.episodes.not_found') ?>"><?= $episodesData['number_of_episodes'] ?></x-DashboardCard>
    <?php // @icon('database-2-fill')?>
    <x-DashboardCard glyph="database-2-fill" title="<?= lang('Dashboard.storage.title') ?>" subtitle="<?= lang('Dashboard.storage.subtitle', [
        'totalUploaded' => $storageData['total_uploaded'],
        'totalStorage'  => $storageData['limit'],
    ]) ?>"><?= $storageData['percentage'] ?>%</x-DashboardCard>
</div>

<div class="grid grid-cols-1 gap-4 mt-4 lg:grid-cols-2">
    <x-Charts.XY class="col-span-1" title="<?= lang('Charts.total_storage_by_month') ?>" dataUrl="<?= route_to(
        'analytics-data-instance',
        'Podcast',
        'TotalStorageByMonth',
    ) ?>" />
    <x-Charts.XY class="col-span-1" title="<?= lang('Charts.total_bandwidth_by_month') ?>" subtitle="<?= $bandwidthLimit !== null ? lang('Charts.total_bandwidth_by_month_limit', [
        'totalBandwidth' => $bandwidthLimit,
    ]) : '' ?>" dataUrl="<?= route_to(
        'analytics-data-instance',
        'Podcast',
        'TotalBandwidthByMonth',
    ) ?>" />
</div>


<?= service('vite')
    ->asset('js/charts.ts', 'js') ?>
<?= $this->endsection() ?>
