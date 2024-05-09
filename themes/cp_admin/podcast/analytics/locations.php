<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= esc($podcast->title) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= esc($podcast->title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <x-Charts.Pie title="<?= lang('Charts.by_country_weekly') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'PodcastByCountry',
        'Weekly',
    ) ?>" />
    <x-Charts.Pie title="<?= lang('Charts.by_country_yearly') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'PodcastByCountry',
        'Yearly',
    ) ?>" />
    <x-Charts.Map class="col-span-2" title="<?= lang('Charts.podcast_by_region') ?>" dataUrl="<?= route_to(
        'analytics-full-data',
        $podcast->id,
        'PodcastByRegion',
    ) ?>" />
</div>


<?= service('vite')
    ->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
