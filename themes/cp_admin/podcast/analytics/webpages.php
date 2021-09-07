<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $podcast->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <Charts.Pie title="<?= lang('Charts.by_domain_weekly') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'WebsiteByReferer',
        'ByDomainWeekly',
    ) ?>" />
    <Charts.Pie title="<?= lang('Charts.by_domain_yearly') ?>" dataUrl="<?= route_to(
        'analytics-data',
        $podcast->id,
        'WebsiteByReferer',
        'ByDomainYearly',
    ) ?>" />
    <Charts.Pie title="<?= lang('Charts.by_entry_page') ?>" dataUrl="<?= route_to(
        'analytics-full-data',
        $podcast->id,
        'WebsiteByEntryPage',
    ) ?>" />
    <Charts.Pie title="<?= lang('Charts.by_browser') ?>" dataUrl="<?= route_to(
        'analytics-full-data',
        $podcast->id,
        'WebsiteByBrowser',
    ) ?>" />
</div>



<?= service('vite')->asset('js/charts.ts', 'js') ?>
<?= $this->endSection() ?>
