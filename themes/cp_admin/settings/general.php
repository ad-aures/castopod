<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Settings.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Settings.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('settings-instance') ?>" method="POST" class="flex flex-col gap-y-4" enctype="multipart/form-data">
<?= csrf_field() ?>

<Forms.Section
    title="<?= lang('Settings.form.site_section_title') ?>">

    <Forms.Field
        name="site_name"
        label="<?= lang('Settings.form.site_name') ?>"
        value="<?= service('settings')
    ->get('App.siteName') ?>"
        required="true" />

    <Forms.Field
        as="Textarea"
        name="site_description"
        label="<?= lang('Settings.form.site_description') ?>"
        value="<?= service('settings')
    ->get('App.siteDescription') ?>"
        required="true"
        rows="4" />

    <div class="flex items-center">
        <Forms.Field
            name="site_icon"
            type="file"
            label="<?= lang('Settings.form.site_icon') ?>"
            hint="<?= lang('Settings.form.site_icon_hint') ?>"
            helper="<?= lang('Settings.form.site_icon_helper') ?>"
            accept=".png,.jpeg,.jpg"
            class="flex-1"
            />
        <?php if (config('App')->siteIcon['ico'] !== service('settings')->get('App.siteIcon')['ico']): ?>
        <div class="relative ml-2">
            <a href="<?= route_to('settings-instance-delete-icon') ?>" class="absolute p-1 text-red-700 bg-red-100 border-2 rounded-full hover:text-red-900 border-contrast -top-3 -right-3 focus:ring-accent" title="<?= lang('Settings.form.site_icon_delete') ?>" data-tooltip="top"><?= icon('delete-bin') ?></a>
            <img src="<?= service('settings')->get('App.siteIcon')['64'] ?>" alt="<?= service('settings')->get('App.siteName') ?> Favicon" class="w-10 h-10" />
        </div>
        <?php endif; ?>
    </div>

    <Button variant="primary" type="submit" class="self-end"><?= lang('Settings.form.submit') ?></Button>

</Forms.Section>

</form>

<?= $this->endSection() ?>
