<?= $this->extend('Modules\Admin\Views\_layout') ?>

<?= $this->section('title') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="lg:divide-x lg:grid lg:grid-cols-2">
    
    <div class="mb-12 mr-6 text-center">
        <h2><?= lang('Charts.by_domain_weekly') ?></h2>
        <div class="chart-pie" id="by-domain-weekly-pie" data-chart-type="pie-chart" data-chart-url="<?= route_to(
            'analytics-data',
            $podcast->id,
            'WebsiteByReferer',
            'ByDomainWeekly',
        ) ?>"></div>
    </div>


    <div class="mb-12 mr-6 text-center">
        <h2><?= lang('Charts.by_domain_yearly') ?></h2>
        <div class="chart-pie" id="by-domain-yearly-pie" data-chart-type="pie-chart" data-chart-url="<?= route_to(
            'analytics-data',
            $podcast->id,
            'WebsiteByReferer',
            'ByDomainYearly',
        ) ?>"></div>
    </div>


    <div class="mb-12 mr-6 text-center">
        <h2><?= lang('Charts.by_entry_page') ?></h2>
        <div class="chart-pie" id="by-entry-page-pie" data-chart-type="pie-chart" data-chart-url="<?= route_to(
            'analytics-full-data',
            $podcast->id,
            'WebsiteByEntryPage',
        ) ?>"></div>
    </div>

    
    <div class="mb-12 mr-6 text-center">
        <h2><?= lang('Charts.by_browser') ?></h2>
        <div class="chart-pie" id="by-browser-pie" data-chart-type="pie-chart" data-chart-url="<?= route_to(
            'analytics-full-data',
            $podcast->id,
            'WebsiteByBrowser',
        ) ?>"></div>
    </div>
    
</div>



<?= service('vite')->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
