<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Settings.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Settings.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-col gap-y-4">

<form action="<?= route_to('settings-instance') ?>" method="POST" enctype="multipart/form-data" class="max-w-xl">
<?= csrf_field() ?>

<Forms.Section
    title="<?= lang('Settings.instance.title') ?>">

    <Forms.Field
        name="site_name"
        label="<?= lang('Settings.instance.site_name') ?>"
        value="<?= esc(service('settings')
    ->get('App.siteName')) ?>"
        required="true" />

    <Forms.Field
        as="Textarea"
        name="site_description"
        label="<?= lang('Settings.instance.site_description') ?>"
        value="<?= esc(service('settings')
    ->get('App.siteDescription')) ?>"
        required="true"
        rows="4" />

    <div class="flex items-center">
        <Forms.Field
            name="site_icon"
            type="file"
            label="<?= lang('Settings.instance.site_icon') ?>"
            hint="<?= lang('Settings.instance.site_icon_hint') ?>"
            helper="<?= lang('Settings.instance.site_icon_helper') ?>"
            accept=".png,.jpeg,.jpg"
            class="flex-1"
            />
        <?php if (config('App')->siteIcon['ico'] !== service('settings')->get('App.siteIcon')['ico']): ?>
        <div class="relative ml-2">
            <a href="<?= route_to('settings-instance-delete-icon') ?>" class="absolute p-1 text-red-700 bg-red-100 border-2 rounded-full hover:text-red-900 border-contrast -top-3 -right-3 focus:ring-accent" title="<?= lang('Settings.instance.site_icon_delete') ?>" data-tooltip="top"><?= icon('delete-bin') ?></a>
            <img src="<?= service('settings')->get('App.siteIcon')['64'] ?>" alt="<?= esc(service('settings')->get('App.siteName')) ?> Favicon" class="w-10 h-10 aspect-square" loading="lazy" />
        </div>
        <?php endif; ?>
    </div>

    <Button variant="primary" type="submit" class="self-end"><?= lang('Settings.instance.submit') ?></Button>

</Forms.Section>

</form>

<form action="<?= route_to('settings-images-regenerate') ?>" method="POST" class="flex flex-col w-full max-w-xl gap-y-4">
<?= csrf_field() ?>

<Forms.Section
    title="<?= lang('Settings.images.title') ?>"
    subtitle="<?= lang('Settings.images.subtitle') ?>" >

    <Button variant="primary" type="submit" iconLeft="refresh"><?= lang('Settings.images.regenerate') ?></Button>

</Forms.Section>

</form>

<form action="<?= route_to('settings-housekeeping-run') ?>" method="POST" class="flex flex-col w-full max-w-xl gap-y-4">
<?= csrf_field() ?>

<Forms.Section
    title="<?= lang('Settings.housekeeping.title') ?>"
    subtitle="<?= lang('Settings.housekeeping.subtitle') ?>" >

    <Forms.Toggler name="reset_counts" value="yes" size="small" checked="false" hint="<?= lang('Settings.housekeeping.reset_counts_helper') ?>"><?= lang('Settings.housekeeping.reset_counts') ?></Forms.Toggler>
    <Forms.Toggler name="rewrite_media" value="yes" size="small" checked="false" hint="<?= lang('Settings.housekeeping.rewrite_media_helper') ?>"><?= lang('Settings.housekeeping.rewrite_media') ?></Forms.Toggler>
    <Forms.Toggler name="rename_episodes_files" value="yes" size="small" checked="false" hint="<?= lang('Settings.housekeeping.rename_episodes_files_hint') ?>"><?= lang('Settings.housekeeping.rename_episodes_files') ?></Forms.Toggler>
    <Forms.Toggler name="clear_cache" value="yes" size="small" checked="false" hint="<?= lang('Settings.housekeeping.clear_cache_helper') ?>"><?= lang('Settings.housekeeping.clear_cache') ?></Forms.Toggler>

    <Button variant="primary" type="submit" iconLeft="home-gear"><?= lang('Settings.housekeeping.run') ?></Button>

</Forms.Section>

</form>

</div>

<?= $this->endSection() ?>
