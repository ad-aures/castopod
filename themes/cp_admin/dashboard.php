<?= helper('components') ?>
<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Dashboard.home') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Dashboard.home') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex flex-wrap items-start gap-4">
    <DashboardCard href="<?= $onlyPodcastId === null ? route_to('podcast-list') : route_to('podcast-view', $onlyPodcastId) ?>" glyph="mic" title="<?= lang('Dashboard.podcasts.title') ?>" subtitle="<?= $podcastsData['last_published_at'] ? esc(lang('Dashboard.podcasts.last_published', [
        'lastPublicationDate' => local_date($podcastsData['last_published_at']),
    ], null, false)) : lang('Dashboard.podcasts.not_found') ?>"><?= $podcastsData['number_of_podcasts'] ?></DashboardCard>
    <DashboardCard href="<?= $onlyPodcastId === null ? '' : route_to('episode-list', $onlyPodcastId) ?>" glyph="play" title="<?= lang('Dashboard.episodes.title') ?>" subtitle="<?= $episodesData['last_published_at'] ? esc(lang('Dashboard.episodes.last_published', [
        'lastPublicationDate' => local_date($episodesData['last_published_at']),
    ], null, false)) : lang('Dashboard.episodes.not_found') ?>"><?= $episodesData['number_of_episodes'] ?></DashboardCard>
    <DashboardCard glyph="database" title="<?= lang('Dashboard.storage.title') ?>" subtitle="<?= lang('Dashboard.storage.subtitle', [
        'totalUploaded' => $storageData['total_uploaded'],
        'totalStorage' => $storageData['limit'],
    ]) ?>"><?= $storageData['percentage'] ?>%</DashboardCard>
</div>

<div class="grid grid-cols-1 gap-4 mt-4 lg:grid-cols-2">
    <Charts.XY class="col-span-1" title="<?= lang('Charts.total_storage_by_month') ?>" dataUrl="<?= route_to(
        'analytics-data-instance',
        'Podcast',
        'TotalStorageByMonth',
    ) ?>" />
    <Charts.XY class="col-span-1" title="<?= lang('Charts.total_bandwidth_by_month') ?>" dataUrl="<?= route_to(
        'analytics-data-instance',
        'Podcast',
        'TotalBandwidthByMonth',
    ) ?>" />
</div>


<?= service('vite')
    ->asset('js/charts.ts', 'js') ?>
<?= $this->endsection() ?>
