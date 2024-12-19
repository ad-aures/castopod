<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Settings.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-col gap-y-4">

<form action="<?= route_to('settings-instance') ?>" method="POST" enctype="multipart/form-data" class="max-w-xl">
<?= csrf_field() ?>

<x-Forms.Section
    title="<?= lang('Settings.instance.title') ?>">

    <x-Forms.Field
        name="site_name"
        label="<?= esc(lang('Settings.instance.site_name')) ?>"
        value="<?= esc(service('settings')
    ->get('App.siteName')) ?>"
        isRequired="true" />

    <x-Forms.Field
        as="Textarea"
        name="site_description"
        label="<?= esc(lang('Settings.instance.site_description')) ?>"
        value="<?= esc(service('settings')
    ->get('App.siteDescription')) ?>"
        isRequired="true"
        rows="4" />

    <div class="flex items-center">
        <x-Forms.Field
            name="site_icon"
            type="file"
            label="<?= esc(lang('Settings.instance.site_icon')) ?>"
            hint="<?= esc(lang('Settings.instance.site_icon_hint')) ?>"
            helper="<?= esc(lang('Settings.instance.site_icon_helper')) ?>"
            accept=".png,.jpeg,.jpg"
            class="flex-1"
            />
        <?php if (config('App')->siteIcon['ico'] !== service('settings')->get('App.siteIcon')['ico']): ?>
        <div class="relative ml-2">
            <a href="<?= route_to('settings-instance-delete-icon') ?>" class="absolute p-1 text-red-700 bg-red-100 border-2 rounded-full hover:text-red-900 border-contrast -top-3 -right-3" title="<?= lang('Settings.instance.site_icon_delete') ?>" data-tooltip="top"><?= icon('delete-bin-fill') ?></a>
            <img src="<?= get_site_icon_url('64') ?>" alt="<?= esc(service('settings')->get('App.siteName')) ?> Favicon" class="w-10 h-10 aspect-square" loading="lazy" />
        </div>
        <?php endif; ?>
    </div>

    <x-Button variant="primary" type="submit" class="self-end"><?= lang('Settings.instance.submit') ?></x-Button>

</x-Forms.Section>

</form>

<form action="<?= route_to('settings-images-regenerate') ?>" method="POST" class="flex flex-col w-full max-w-xl gap-y-4">
<?= csrf_field() ?>

<x-Forms.Section
    title="<?= lang('Settings.images.title') ?>"
    subtitle="<?= lang('Settings.images.subtitle') ?>">
    <?php // @icon("refresh-fill")?>
    <x-Button variant="primary" type="submit" iconLeft="refresh-fill"><?= lang('Settings.images.regenerate') ?></x-Button>

</x-Forms.Section>

</form>

<form action="<?= route_to('settings-housekeeping-run') ?>" method="POST" class="flex flex-col w-full max-w-xl gap-y-4">
<?= csrf_field() ?>

<x-Forms.Section
    title="<?= lang('Settings.housekeeping.title') ?>"
    subtitle="<?= lang('Settings.housekeeping.subtitle') ?>" >

    <x-Forms.Toggler name="reset_counts" size="small" hint="<?= esc(lang('Settings.housekeeping.reset_counts_helper')) ?>"><?= lang('Settings.housekeeping.reset_counts') ?></x-Forms.Toggler>
    <x-Forms.Toggler name="rename_episodes_files" size="small" hint="<?= esc(lang('Settings.housekeeping.rename_episodes_files_hint')) ?>"><?= lang('Settings.housekeeping.rename_episodes_files') ?></x-Forms.Toggler>
    <x-Forms.Toggler name="clear_cache" size="small" hint="<?= esc(lang('Settings.housekeeping.clear_cache_helper')) ?>"><?= lang('Settings.housekeeping.clear_cache') ?></x-Forms.Toggler>
    <?php // @icon("home-gear-fill")?>
    <x-Button variant="primary" type="submit" iconLeft="home-gear-fill"><?= lang('Settings.housekeeping.run') ?></x-Button>

</x-Forms.Section>

</form>

</div>

<?= $this->endSection() ?>
