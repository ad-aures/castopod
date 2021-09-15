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

<form id="podcast-edit-form" action="<?= route_to('podcast-edit', $podcast->id) ?>" method="POST" enctype='multipart/form-data' class="flex flex-col">
<?= csrf_field() ?>

<Forms.Section
    class="mb-8"
    title="<?= lang('Podcast.form.identity_section_title') ?>"
    subtitle="<?= lang('Podcast.form.identity_section_subtitle') ?>" >

<Forms.Field
    name="image"
    label="<?= lang('Podcast.form.image') ?>"
    helperText="<?= lang('Common.forms.image_size_hint') ?>"
    type="file"
    accept=".jpg,.jpeg,.png" />

<Forms.Field
    name="title"
    label="<?= lang('Podcast.form.title') ?>"
    helperText="<?= $podcast->link ?>"
    value="<?= $podcast->title ?>"
    required="true" />

<Forms.Field
    as="MarkdownEditor"
    name="description"
    label="<?= lang('Podcast.form.description') ?>"
    value="<?= $podcast->title ?>"
    required="true" />

<fieldset>
    <legend><?= lang('Podcast.form.type.label') .
                hint_tooltip(lang('Podcast.form.type.hint'), 'ml-1') ?></legend>
    <div class="flex gap-2">
        <Forms.RadioButton
            value="episodic"
            name="type"
            isChecked="<?= $podcast->type === 'episodic' ? 'true' : 'false' ?>" ><?= lang('Podcast.form.type.episodic') ?></Forms.RadioButton>
        <Forms.RadioButton
            value="serial"
            name="type"
            isChecked="<?= $podcast->type === 'serial' ? 'true' : 'false' ?>" ><?= lang('Podcast.form.type.serial') ?></Forms.RadioButton>
    </div>
</fieldset>

</Forms.Section>

<Forms.Section
    class="mb-8"
    title="<?= lang('Podcast.form.classification_section_title') ?>"
    subtitle="<?= lang('Podcast.form.classification_section_subtitle') ?>" >

    <Forms.Field
        as="Select"
        name="language"
        label="<?= lang('Podcast.form.language') ?>"
        selected="<?= $podcast->language_code ?>"
        required="true"
        options="<?= esc(json_encode($languageOptions)) ?>" />

    <Forms.Field
        as="Select"
        name="category"
        label="<?= lang('Podcast.form.category') ?>"
        selected="<?= $podcast->category_id ?>"
        required="true"
        options="<?= esc(json_encode($categoryOptions)) ?>" />

    <Forms.Field
        as="MultiSelect"
        name="other_categories[]"
        label="<?= lang('Podcast.form.other_categories') ?>"
        selected="<?= json_encode(old('other_categories', $podcast->other_categories_ids)) ?>"
        data-max-item-count="2"
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
    class="mb-8"
    title="<?= lang('Podcast.form.author_section_title') ?>"
    subtitle="<?= lang('Podcast.form.author_section_subtitle') ?>" >

<Forms.Field
    name="owner_name"
    label="<?= lang('Podcast.form.owner_name') ?>"
    value="<?= $podcast->owner_name ?>"
    hintText="<?= lang('Podcast.form.owner_name_hint') ?>"
    required="true" />

<Forms.Field
    name="owner_email"
    type="email"
    label="<?= lang('Podcast.form.owner_email') ?>"
    value="<?= $podcast->owner_email ?>"
    hintText="<?= lang('Podcast.form.owner_email_hint') ?>"
    required="true" />

<Forms.Field
    name="publisher"
    label="<?= lang('Podcast.form.publisher') ?>"
    value="<?= $podcast->publisher ?>"
    hintText="<?= lang('Podcast.form.publisher_hint') ?>" />

<Forms.Field
    name="copyright"
    label="<?= lang('Podcast.form.copyright') ?>"
    value="<?= $podcast->copyright ?>" />

</Forms.Section>

<Forms.Section
    class="mb-8"
    title="<?= lang('Podcast.form.location_section_title') ?>"
    subtitle="<?= lang('Podcast.form.location_section_subtitle') ?>" >

<Forms.Field
    name="location_name"
    label="<?= lang('Podcast.form.location_name') ?>"
    value="<?= $podcast->location_name ?>"
    hintText="<?= lang('Podcast.form.location_name_hint') ?>" />

</Forms.Section>

<Forms.Section
    class="mb-8"
    title="<?= lang('Podcast.form.monetization_section_title') ?>"
    subtitle="<?= lang('Podcast.form.monetization_section_subtitle') ?>" >

<Forms.Field
    name="payment_pointer"
    label="<?= lang('Podcast.form.payment_pointer') ?>"
    value="<?= $podcast->payment_pointer ?>"
    hintText="<?= lang('Podcast.form.payment_pointer_hint') ?>" />

<fieldset class="flex flex-col items-start p-4 bg-gray-100 rounded">
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
    class="mb-8"
    title="<?= lang('Podcast.form.advanced_section_title') ?>"
    subtitle="<?= lang('Podcast.form.advanced_section_subtitle') ?>" >

<Forms.Field
    as="XMLEditor"
    name="custom_rss"
    label="<?= lang('Podcast.form.custom_rss') ?>"
    value="<?= $podcast->custom_rss_string ?>"
    hintText="<?= lang('Podcast.form.custom_rss_hint') ?>" />

</Forms.Section>

<Forms.Section
    class="mb-8"
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

</form>

<?= $this->endSection() ?>
