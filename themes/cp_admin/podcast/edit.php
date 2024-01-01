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

<form id="podcast-edit-form" action="<?= route_to('podcast-edit', $podcast->id) ?>" method="POST" enctype='multipart/form-data' class="flex flex-col items-start justify-end gap-4 xl:flex-row-reverse">
<?= csrf_field() ?>

<div class="z-40 flex flex-col w-full max-w-xs overflow-hidden shadow-sm xl:sticky bg-elevated border-3 border-subtle top-24 rounded-xl">
    <?php if ($podcast->banner_id !== null): ?>
        <a href="<?= route_to('podcast-banner-delete', $podcast->id) ?>" class="absolute p-1 text-red-700 bg-red-100 border-2 rounded-full hover:text-red-900 border-contrast focus:ring-accent top-2 right-2" title="<?= lang('Podcast.form.banner_delete') ?>" data-tooltip="bottom"><?= icon('delete-bin') ?></a>
    <?php endif; ?>
    <img src="<?= get_podcast_banner_url($podcast, 'small') ?>" alt="" class="w-full aspect-[3/1] bg-header" loading="lazy" />
    <div class="flex px-4 py-2">
        <img src="<?= $podcast->cover->thumbnail_url ?>" alt="<?= esc($podcast->title) ?>"
            class="w-16 h-16 mr-4 -mt-8 rounded-full ring-2 ring-background-elevated aspect-square" loading="lazy" />
        <div class="flex flex-col">
            <p class="font-semibold leading-none"><?= esc($podcast->title) ?></p>
            <p class="text-sm text-skin-muted">@<?= esc($podcast->handle) ?></p>
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
    name="title"
    label="<?= lang('Podcast.form.title') ?>"
    value="<?= esc($podcast->title) ?>"
    required="true" />

<Forms.Field
    as="MarkdownEditor"
    name="description"
    label="<?= lang('Podcast.form.description') ?>"
    value="<?= esc($podcast->description_markdown) ?>"
    required="true"
    disallowList="header,quote" />

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
                isChecked="<?= $podcast->parental_advisory === 'clean' ? 'true' : 'false' ?>" ><?= lang('Podcast.form.parental_advisory.clean') ?></Forms.RadioButton>
            <Forms.RadioButton
                value="explicit"
                name="parental_advisory"
                isChecked="<?= $podcast->parental_advisory === 'explicit' ? 'true' : 'false' ?>" ><?= lang('Podcast.form.parental_advisory.explicit') ?></Forms.RadioButton>
        </div>
    </fieldset>
</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.author_section_title') ?>"
    subtitle="<?= lang('Podcast.form.author_section_subtitle') ?>" >

<Forms.Field
    name="owner_name"
    label="<?= lang('Podcast.form.owner_name') ?>"
    value="<?= esc($podcast->owner_name) ?>"
    hint="<?= lang('Podcast.form.owner_name_hint') ?>"
    required="true" />

<Forms.Field
    name="owner_email"
    type="email"
    label="<?= lang('Podcast.form.owner_email') ?>"
    value="<?= esc($podcast->owner_email) ?>"
    hint="<?= lang('Podcast.form.owner_email_hint') ?>"
    required="true" />

<Forms.Toggler class="mt-2" name="is_owner_email_removed_from_feed" value="yes" checked="<?= $podcast->is_owner_email_removed_from_feed ? 'true' : 'false' ?>" hint="<?= lang('Podcast.form.is_owner_email_removed_from_feed_hint') ?>">
    <?= lang('Podcast.form.is_owner_email_removed_from_feed') ?></Forms.Toggler>

<Forms.Field
    name="publisher"
    label="<?= lang('Podcast.form.publisher') ?>"
    value="<?= esc($podcast->publisher) ?>"
    hint="<?= lang('Podcast.form.publisher_hint') ?>" />

<Forms.Field
    name="copyright"
    label="<?= lang('Podcast.form.copyright') ?>"
    value="<?= esc($podcast->copyright) ?>" />

</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.fediverse_section_title') ?>" >

<div class="flex flex-col">
    <Forms.Label for="handle" hint="<?= lang('Podcast.form.handle_hint') ?>"><?= lang('Podcast.form.handle') ?></Forms.Label>
    <div class="relative">
        <Icon glyph="at" class="absolute inset-0 h-full text-xl opacity-40 left-3" />
        <Forms.Input name="handle" value="<?= $podcast->handle ?>" class="w-full pl-8" required="true" readonly="true" />
    </div>
</div>

<Forms.Field
    name="banner"
    label="<?= lang('Podcast.form.banner') ?>"
    helper="<?= lang('Podcast.form.banner_size_hint') ?>"
    type="file"
    accept=".jpg,.jpeg,.png" />

</Forms.Section>

<Forms.Section title="<?= lang('Podcast.form.premium') ?>">
    <Forms.Toggler class="mt-2" name="premium_by_default" value="yes" checked="<?= $podcast->is_premium_by_default ? 'true' : 'false' ?>" hint="<?= lang('Podcast.form.premium_by_default_hint') ?>">
        <?= lang('Podcast.form.premium_by_default') ?></Forms.Toggler>
</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.op3') ?>"
    subtitle="<?= lang('Podcast.form.op3_hint') ?>">

    <a href="https://op3.dev" target="_blank" rel="noopener noreferrer" class="inline-flex self-start text-xs font-semibold underline gap-x-1 text-skin-muted hover:no-underline focus:ring-accent"><Icon glyph="link" class="text-sm"/>op3.dev</a>
    <Forms.Toggler name="enable_op3" value="yes" checked="<?= service('settings')
            ->get('Analytics.enableOP3', 'podcast:' . $podcast->id) ? 'true' : 'false' ?>" hint="<?= lang('Podcast.form.op3_enable_hint') ?>"><?= lang('Podcast.form.op3_enable') ?></Forms.Toggler>
</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.location_section_title') ?>"
    subtitle="<?= lang('Podcast.form.location_section_subtitle') ?>" >

<Forms.Field
    name="location_name"
    label="<?= lang('Podcast.form.location_name') ?>"
    value="<?= esc($podcast->location_name) ?>"
    hint="<?= lang('Podcast.form.location_name_hint') ?>" />

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

    <Forms.Field
    name="new_feed_url"
    type="url"
    label="<?= lang('Podcast.form.new_feed_url') ?>"
    hint="<?= lang('Podcast.form.new_feed_url_hint') ?>"
    value="<?= esc($podcast->new_feed_url) ?>"
    />

    <Forms.Toggler class="mb-2" name="lock" value="yes" checked="<?= $podcast->is_locked ? 'true' : 'false' ?>" hint="<?= lang('Podcast.form.lock_hint') ?>">
        <?= lang('Podcast.form.lock') ?>
    </Forms.Toggler>
    <Forms.Toggler class="mb-2" name="block" value="yes" checked="<?= $podcast->is_blocked ? 'true' : 'false'  ?>" hint="<?= lang('Podcast.form.block_hint') ?>">
        <?= lang('Podcast.form.block') ?>
    </Forms.Toggler>
    <Forms.Toggler name="complete" value="yes" checked="<?= $podcast->is_completed ? 'true' : 'false' ?>">
        <?= lang('Podcast.form.complete') ?>
    </Forms.Toggler>
</Forms.Section>

</div>

</form>

<Button class="mt-8" variant="danger" uri="<?= route_to('podcast-delete', $podcast->id) ?>" iconLeft="delete-bin"><?= lang('Podcast.delete') ?></Button>

<?= $this->endSection() ?>
