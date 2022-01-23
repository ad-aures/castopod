<?php declare(strict_types=1);

?>

<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button variant="primary" type="submit" form="podcast-edit-form"><?= lang('Podcast.form.submit_edit') ?></Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form id="podcast-edit-form" action="<?= route_to('podcast-edit', $podcast->id) ?>" method="POST" enctype='multipart/form-data' class="flex flex-row-reverse flex-wrap items-start justify-end gap-4">
<?= csrf_field() ?>

<div class="sticky z-40 flex flex-col w-full max-w-xs overflow-hidden shadow-sm bg-elevated border-3 border-subtle top-24 rounded-xl">
    <?php if ($podcast->banner_id !== null): ?>
        <a href="<?= route_to('podcast-banner-delete', $podcast->id) ?>" class="absolute p-1 text-red-700 bg-red-100 border-2 rounded-full hover:text-red-900 border-contrast focus:ring-accent top-2 right-2" title="<?= lang('Podcast.form.banner_delete') ?>" data-tooltip="bottom"><?= icon('delete-bin') ?></a>
    <?php endif; ?>
    <img src="<?= $podcast->banner->small_url ?>" alt="" class="w-full aspect-[3/1] bg-header" loading="lazy" />
    <div class="flex px-4 py-2">
        <img src="<?= $podcast->cover->thumbnail_url ?>" alt="<?= $podcast->title ?>"
            class="w-16 h-16 mr-4 -mt-8 rounded-full ring-2 ring-background-elevated aspect-square" loading="lazy" />
        <div class="flex flex-col">
            <p class="font-semibold leading-none"><?= $podcast->title ?></p>
            <p class="text-sm text-skin-muted">@<?= $podcast->handle ?></p>
        </div>
    </div>
</div>

<div class="flex flex-col w-full max-w-xl gap-y-6">

<Forms.Section
    title="<?= lang('Podcast.form.identity_section_title') ?>"
    subtitle="<?= lang('Podcast.form.identity_section_subtitle') ?>" >

<Forms.Field
    name="cover"
    label="<?= lang('Podcast.form.cover') ?>"
    helper="<?= lang('Podcast.form.cover_size_hint') ?>"
    type="file"
    accept=".jpg,.jpeg,.png" />

<Forms.Field
    name="banner"
    label="<?= lang('Podcast.form.banner') ?>"
    helper="<?= lang('Podcast.form.banner_size_hint') ?>"
    type="file"
    accept=".jpg,.jpeg,.png" />

<Forms.Field
    name="title"
    label="<?= lang('Podcast.form.title') ?>"
    helper="<?= $podcast->link ?>"
    value="<?= $podcast->title ?>"
    required="true" />

<Forms.Field
    as="MarkdownEditor"
    name="description"
    label="<?= lang('Podcast.form.description') ?>"
    value="<?= htmlspecialchars($podcast->description) ?>"
    required="true" />

<fieldset>
    <legend><?= lang('Podcast.form.type.label') ?></legend>
    <div class="flex gap-2">
        <Forms.RadioButton
            value="episodic"
            name="type"
            hint="<?= lang('Podcast.form.type.episodic_hint') ?>"
            isChecked="<?= $podcast->type === 'episodic' ? 'true' : 'false' ?>" ><?= lang('Podcast.form.type.episodic') ?></Forms.RadioButton>
        <Forms.RadioButton
            value="serial"
            name="type"
            hint="<?= lang('Podcast.form.type.serial_hint') ?>"
            isChecked="<?= $podcast->type === 'serial' ? 'true' : 'false' ?>" ><?= lang('Podcast.form.type.serial') ?></Forms.RadioButton>
    </div>
</fieldset>

</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.classification_section_title') ?>"
    subtitle="<?= lang('Podcast.form.classification_section_subtitle') ?>" >

    <Forms.Field
        as="Select"
        name="language"
        label="<?= lang('Podcast.form.language') ?>"
        selected="<?= $podcast->language_code ?>"
        options="<?= esc(json_encode($languageOptions)) ?>"
        required="true" />

    <Forms.Field
        as="Select"
        name="category"
        label="<?= lang('Podcast.form.category') ?>"
        selected="<?= $podcast->category_id ?>"
        options="<?= esc(json_encode($categoryOptions)) ?>"
        required="true" />
    
    <Forms.Field
        as="MultiSelect"
        name="other_categories[]"
        label="<?= lang('Podcast.form.other_categories') ?>"
        data-max-item-count="2"
        selected="<?= esc(json_encode($podcast->other_categories_ids)) ?>"
        options="<?= esc(json_encode($categoryOptions)) ?>" />

    <fieldset class="mb-4">
        <legend><?= lang('Podcast.form.parental_advisory.label') .
                    hint_tooltip(lang('Podcast.form.parental_advisory.hint'), 'ml-1') ?></legend>
        <div class="flex gap-2">
            <Forms.RadioButton
                value="undefined"
                name="parental_advisory"
                isChecked="<?= $podcast->parental_advisory === null ? 'true' : 'false' ?>" ><?= lang('Podcast.form.parental_advisory.undefined') ?></Forms.RadioButton>
            <Forms.RadioButton
                value="clean"
                name="parental_advisory"
                isChecked="<?= $podcast->parental_advisory === 'clean' ? 'true' : 'false' ?>" ><?= lang('Podcast.form.parental_advisory.clean', ) ?></Forms.RadioButton>
            <Forms.RadioButton
                value="explicit"
                name="parental_advisory"
                isChecked="<?= $podcast->parental_advisory === 'explicit' ? 'true' : 'false' ?>" ><?= lang('Podcast.form.parental_advisory.explicit', ) ?></Forms.RadioButton>
        </div>
    </fieldset>
</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.author_section_title') ?>"
    subtitle="<?= lang('Podcast.form.author_section_subtitle') ?>" >

<Forms.Field
    name="owner_name"
    label="<?= lang('Podcast.form.owner_name') ?>"
    value="<?= $podcast->owner_name ?>"
    hint="<?= lang('Podcast.form.owner_name_hint') ?>"
    required="true" />

<Forms.Field
    name="owner_email"
    type="email"
    label="<?= lang('Podcast.form.owner_email') ?>"
    value="<?= $podcast->owner_email ?>"
    hint="<?= lang('Podcast.form.owner_email_hint') ?>"
    required="true" />

<Forms.Field
    name="publisher"
    label="<?= lang('Podcast.form.publisher') ?>"
    value="<?= $podcast->publisher ?>"
    hint="<?= lang('Podcast.form.publisher_hint') ?>" />

<Forms.Field
    name="copyright"
    label="<?= lang('Podcast.form.copyright') ?>"
    value="<?= $podcast->copyright ?>" />

</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.location_section_title') ?>"
    subtitle="<?= lang('Podcast.form.location_section_subtitle') ?>" >

<Forms.Field
    name="location_name"
    label="<?= lang('Podcast.form.location_name') ?>"
    value="<?= $podcast->location_name ?>"
    hint="<?= lang('Podcast.form.location_name_hint') ?>" />

</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.monetization_section_title') ?>"
    subtitle="<?= lang('Podcast.form.monetization_section_subtitle') ?>" >

<Forms.Field
    name="payment_pointer"
    label="<?= lang('Podcast.form.payment_pointer') ?>"
    value="<?= $podcast->payment_pointer ?>"
    hint="<?= lang('Podcast.form.payment_pointer_hint') ?>" />

<fieldset class="flex flex-col items-start p-4 rounded bg-base">
    <Heading tagName="legend" class="float-left" size="small"><?= lang('Podcast.form.partnership') ?></Heading>
    <div class="flex flex-col w-full clear-left gap-x-2 gap-y-4 md:flex-row">
        <div class="flex flex-col flex-shrink w-32">
            <Forms.Label for="partner_id" hint="<?= lang('Podcast.form.partner_id_hint') ?>" isOptional="true"><?= lang('Podcast.form.partner_id') ?></Forms.Label>
            <Forms.Input name="partner_id" value="<?= $podcast->partner_id ?>" />
        </div>
        <div class="flex flex-col flex-1">
            <Forms.Label for="partner_link_url" hint="<?= lang('Podcast.form.partner_link_url_hint') ?>" isOptional="true"><?= lang('Podcast.form.partner_link_url') ?></Forms.Label>
            <Forms.Input name="partner_link_url" value="<?= $podcast->partner_link_url ?>" />
        </div>
    </div>
    <div class="flex flex-col w-full mt-2">
        <Forms.Label for="partner_image_url" hint="<?= lang('Podcast.form.partner_image_url_hint') ?>" isOptional="true"><?= lang('Podcast.form.partner_image_url') ?></Forms.Label>
        <Forms.Input name="partner_image_url" value="<?= $podcast->partner_image_url ?>" />
    </div>
</fieldset>
</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.advanced_section_title') ?>"
    subtitle="<?= lang('Podcast.form.advanced_section_subtitle') ?>" >

<Forms.Field
    as="XMLEditor"
    name="custom_rss"
    label="<?= lang('Podcast.form.custom_rss') ?>"
    hint="<?= lang('Podcast.form.custom_rss_hint') ?>"
    content="<?= esc($podcast->custom_rss_string) ?>" />

</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.status_section_title') ?>" >
    <Forms.Toggler class="mb-2" name="lock" value="yes" checked="<?= $podcast->is_locked ? 'true' : 'false' ?>" hint="<?= lang('Podcast.form.lock_hint') ?>">
        <?= lang('Podcast.form.lock') ?>
    </Forms.Toggler>
    <Forms.Toggler class="mb-2" name="block" value="yes" checked="<?= $podcast->is_blocked ? 'true' : 'false'  ?>">
        <?= lang('Podcast.form.block') ?>
    </Forms.Toggler>
    <Forms.Toggler name="complete" value="yes" checked="<?= $podcast->is_completed ? 'true' : 'false' ?>">
        <?= lang('Podcast.form.complete') ?>
    </Forms.Toggler>
</Forms.Section>

<Button variant="primary" type="submit" class="self-end"><?= lang('Podcast.form.submit_edit') ?></Button>
</div>

</form>

<?= $this->endSection() ?>
