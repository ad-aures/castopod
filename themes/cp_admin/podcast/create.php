<?php declare(strict_types=1);

?>

<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.create') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.create') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('podcast-create') ?>" method="POST" enctype='multipart/form-data' class="flex flex-col gap-y-6">
<?= csrf_field() ?>

<Forms.Section
    title="<?= lang('Podcast.form.identity_section_title') ?>"
    subtitle="<?= lang('Podcast.form.identity_section_subtitle') ?>" >

<Forms.Field
    name="cover"
    label="<?= lang('Podcast.form.cover') ?>"
    helper="<?= lang('Podcast.form.cover_size_hint') ?>"
    type="file"
    required="true"
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
    required="true" />

<div class="flex flex-col">
    <Forms.Label for="handle" hint="<?= lang('Podcast.form.handle_hint') ?>"><?= lang('Podcast.form.handle') ?></Forms.Label>
    <div class="relative">
        <Icon glyph="at" class="absolute inset-0 h-full text-xl opacity-40 left-3" />
        <Forms.Input name="handle" class="w-full pl-8" required="true" />
    </div>
</div>

<Forms.Field
    as="MarkdownEditor"
    name="description"
    label="<?= lang('Podcast.form.description') ?>"
    required="true" />

<fieldset>
    <legend><?= lang('Podcast.form.type.label') ?></legend>
    <div class="flex gap-2">
        <Forms.RadioButton
            value="episodic"
            name="type"
            hint="<?= lang('Podcast.form.type.episodic_hint') ?>"
            isChecked="true'" ><?= lang('Podcast.form.type.episodic') ?></Forms.RadioButton>
        <Forms.RadioButton
            value="serial"
            name="type"
            hint="<?= lang('Podcast.form.type.serial_hint') ?>"
            isChecked="false" ><?= lang('Podcast.form.type.serial') ?></Forms.RadioButton>
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
        selected="<?= $browserLang ?>"
        required="true"
        options="<?= esc(json_encode($languageOptions)) ?>" />

    <Forms.Field
        as="Select"
        name="category"
        label="<?= lang('Podcast.form.category') ?>"
        required="true"
        options="<?= esc(json_encode($categoryOptions)) ?>" />

    <Forms.Field
        as="MultiSelect"
        name="other_categories[]"
        label="<?= lang('Podcast.form.other_categories') ?>"
        data-max-item-count="2"
        options="<?= esc(json_encode($categoryOptions)) ?>" />

    <fieldset class="mb-4">
        <legend><?= lang('Podcast.form.parental_advisory.label') .
                    hint_tooltip(lang('Podcast.form.parental_advisory.hint'), 'ml-1') ?></legend>
        <div class="flex gap-2">
            <Forms.RadioButton
                value="undefined"
                name="parental_advisory"
                isChecked="true" ><?= lang('Podcast.form.parental_advisory.undefined') ?></Forms.RadioButton>
            <Forms.RadioButton
                value="clean"
                name="parental_advisory"
                isChecked="false" ><?= lang('Podcast.form.parental_advisory.clean', ) ?></Forms.RadioButton>
            <Forms.RadioButton
                value="explicit"
                name="parental_advisory"
                isChecked="false" ><?= lang('Podcast.form.parental_advisory.explicit', ) ?></Forms.RadioButton>
        </div>
    </fieldset>
</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.author_section_title') ?>"
    subtitle="<?= lang('Podcast.form.author_section_subtitle') ?>" >

<Forms.Field
    name="owner_name"
    label="<?= lang('Podcast.form.owner_name') ?>"
    hint="<?= lang('Podcast.form.owner_name_hint') ?>"
    required="true" />

<Forms.Field
    name="owner_email"
    type="email"
    label="<?= lang('Podcast.form.owner_email') ?>"
    hint="<?= lang('Podcast.form.owner_email_hint') ?>"
    required="true" />

<Forms.Field
    name="publisher"
    label="<?= lang('Podcast.form.publisher') ?>"
    hint="<?= lang('Podcast.form.publisher_hint') ?>" />

<Forms.Field
    name="copyright"
    label="<?= lang('Podcast.form.copyright') ?>" />

</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.location_section_title') ?>"
    subtitle="<?= lang('Podcast.form.location_section_subtitle') ?>" >

<Forms.Field
    name="location_name"
    label="<?= lang('Podcast.form.location_name') ?>"
    hint="<?= lang('Podcast.form.location_name_hint') ?>" />

</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.monetization_section_title') ?>"
    subtitle="<?= lang('Podcast.form.monetization_section_subtitle') ?>" >

<Forms.Field
    name="payment_pointer"
    label="<?= lang('Podcast.form.payment_pointer') ?>"
    hint="<?= lang('Podcast.form.payment_pointer_hint') ?>" />

<fieldset class="flex flex-col items-start p-4 rounded bg-base">
    <Heading tagName="legend" class="float-left" size="small"><?= lang('Podcast.form.partnership') ?></Heading>
    <div class="flex flex-col w-full clear-left gap-x-2 gap-y-4 md:flex-row">
        <div class="flex flex-col flex-shrink w-32">
            <Forms.Label for="partner_id" hint="<?= lang('Podcast.form.partner_id_hint') ?>" isOptional="true"><?= lang('Podcast.form.partner_id') ?></Forms.Label>
            <Forms.Input name="partner_id" />
        </div>
        <div class="flex flex-col flex-1">
            <Forms.Label for="partner_link_url" hint="<?= lang('Podcast.form.partner_link_url_hint') ?>" isOptional="true"><?= lang('Podcast.form.partner_link_url') ?></Forms.Label>
            <Forms.Input name="partner_link_url" />
        </div>
    </div>
    <div class="flex flex-col w-full mt-2">
        <Forms.Label for="partner_image_url" hint="<?= lang('Podcast.form.partner_image_url_hint') ?>" isOptional="true"><?= lang('Podcast.form.partner_image_url') ?></Forms.Label>
        <Forms.Input name="partner_image_url" />
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
    hint="<?= lang('Podcast.form.custom_rss_hint') ?>" />

</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.status_section_title') ?>" >
    <Forms.Toggler class="mb-2" name="lock" value="yes" checked="true" hint="<?= lang('Podcast.form.lock_hint') ?>">
        <?= lang('Podcast.form.lock') ?>
    </Forms.Toggler>
    <Forms.Toggler class="mb-2" name="block" value="yes" checked="false">
        <?= lang('Podcast.form.block') ?>
    </Forms.Toggler>
    <Forms.Toggler name="complete" value="yes" checked="false">
        <?= lang('Podcast.form.complete') ?>
    </Forms.Toggler>
</Forms.Section>

<Button variant="primary" type="submit" class="self-end"><?= lang('Podcast.form.submit_create') ?></Button>

</form>

<?= $this->endSection() ?>
