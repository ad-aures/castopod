<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.all_podcasts') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.monetization_other') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form id="podcast-edit-form" action="<?= route_to('podcast-monetization-edit', $podcast->id) ?>" method="POST" class="flex flex-col w-full max-w-xl gap-y-6">
<?= csrf_field() ?>
<x-Forms.Section
    title="<?= lang('Podcast.form.monetization_section_title') ?>"
    subtitle="<?= lang('Podcast.form.monetization_section_subtitle') ?>" >

<x-Forms.Field
    name="payment_pointer"
    label="<?= esc(lang('Podcast.form.payment_pointer')) ?>"
    value="<?= esc($podcast->payment_pointer) ?>"
    hint="<?= esc(lang('Podcast.form.payment_pointer_hint')) ?>" />

<fieldset class="flex flex-col items-start p-4 rounded bg-base">
    <x-Heading tagName="legend" class="float-left" size="small"><?= lang('Podcast.form.partnership') ?></x-Heading>
    <div class="flex flex-col w-full clear-left gap-x-2 gap-y-4 md:flex-row">
        <div class="flex flex-col flex-shrink w-32">
            <x-Forms.Label for="partner_id" hint="<?= esc(lang('Podcast.form.partner_id_hint')) ?>" isOptional="true"><?= lang('Podcast.form.partner_id') ?></x-Forms.Label>
            <x-Forms.Input name="partner_id" value="<?= esc($podcast->partner_id) ?>" />
        </div>
        <div class="flex flex-col flex-1">
            <x-Forms.Label for="partner_link_url" hint="<?= esc(lang('Podcast.form.partner_link_url_hint')) ?>" isOptional="true"><?= lang('Podcast.form.partner_link_url') ?></x-Forms.Label>
            <x-Forms.Input name="partner_link_url" value="<?= esc($podcast->partner_link_url) ?>" />
        </div>
    </div>
    <div class="flex flex-col w-full mt-2">
        <x-Forms.Label for="partner_image_url" hint="<?= esc(lang('Podcast.form.partner_image_url_hint')) ?>" isOptional="true"><?= lang('Podcast.form.partner_image_url') ?></x-Forms.Label>
        <x-Forms.Input name="partner_image_url" value="<?= esc($podcast->partner_image_url) ?>" />
    </div>
</fieldset>
</x-Forms.Section>

<x-Button variant="primary" type="submit" class="self-end"><?= lang('Common.forms.save') ?></x-Button>

</form>
<?= $this->endSection() ?>
