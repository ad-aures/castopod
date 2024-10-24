<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<x-Button variant="primary" type="submit" form="podcast-edit-form"><?= lang('Podcast.form.submit_edit') ?></x-Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form id="podcast-edit-form" action="<?= route_to('podcast-edit', $podcast->id) ?>" method="POST" enctype='multipart/form-data' class="flex flex-col items-start justify-end gap-4 xl:flex-row-reverse">
<?= csrf_field() ?>


<div class="z-40 flex flex-col w-full max-w-xs overflow-hidden shadow-sm xl:sticky bg-elevated border-3 border-subtle top-24 rounded-xl">
    <?php if ($podcast->banner_id !== null): ?>
        <a href="<?= route_to('podcast-banner-delete', $podcast->id) ?>" class="absolute p-1 text-red-700 bg-red-100 border-2 rounded-full hover:text-red-900 border-contrast top-2 right-2" title="<?= lang('Podcast.form.banner_delete') ?>" data-tooltip="bottom"><?= icon('delete-bin-fill') ?></a>
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

<x-Forms.Section
    title="<?= lang('Podcast.form.identity_section_title') ?>"
    subtitle="<?= lang('Podcast.form.identity_section_subtitle') ?>" >

<x-Forms.Field
    name="cover"
    label="<?= esc(lang('Podcast.form.cover')) ?>"
    helper="<?= esc(lang('Podcast.form.cover_size_hint')) ?>"
    type="file"
    accept=".jpg,.jpeg,.png" />

<x-Forms.Field
    name="title"
    label="<?= esc(lang('Podcast.form.title')) ?>"
    value="<?= esc($podcast->title) ?>"
    isRequired="true" />

<x-Forms.Field
    as="MarkdownEditor"
    name="description"
    label="<?= esc(lang('Podcast.form.description')) ?>"
    value="<?= esc($podcast->description_markdown) ?>"
    isRequired="true"
    disallowList="header,quote" />

    <x-Forms.RadioGroup
    label="<?= lang('Podcast.form.type.label') ?>"
    name="type"
    value="<?= $podcast->type ?>"
    options="<?= esc(json_encode([
        [
            'label'       => lang('Podcast.form.type.episodic'),
            'value'       => 'episodic',
            'description' => lang('Podcast.form.type.episodic_description'),
        ],
        [
            'label'       => lang('Podcast.form.type.serial'),
            'value'       => 'serial',
            'description' => lang('Podcast.form.type.serial_description'),
        ],
    ])) ?>"
    isRequired="true"
/>

</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Podcast.form.classification_section_title') ?>"
    subtitle="<?= lang('Podcast.form.classification_section_subtitle') ?>" >

    <x-Forms.Field
        as="Select"
        name="language"
        label="<?= esc(lang('Podcast.form.language')) ?>"
        value="<?= $podcast->language_code ?>"
        options="<?= esc(json_encode($languageOptions)) ?>"
        isRequired="true" />

    <x-Forms.Field
        as="Select"
        name="category"
        label="<?= esc(lang('Podcast.form.category')) ?>"
        value="<?= $podcast->category_id ?>"
        options="<?= esc(json_encode($categoryOptions)) ?>"
        isRequired="true" />

    <x-Forms.Field
        as="SelectMulti"
        name="other_categories"
        label="<?= esc(lang('Podcast.form.other_categories')) ?>"
        data-max-item-count="2"
        value="<?= esc(json_encode($podcast->other_categories_ids)) ?>"
        options="<?= esc(json_encode($categoryOptions)) ?>" />

    <x-Forms.RadioGroup
        label="<?= lang('Podcast.form.parental_advisory.label') ?>"
        hint="<?= lang('Podcast.form.parental_advisory.hint') ?>"
        name="parental_advisory"
        value="<?= $podcast->parental_advisory ?>"
        options="<?= esc(json_encode([
            [
                'label' => lang('Podcast.form.parental_advisory.undefined'),
                'value' => 'undefined',
            ],
            [
                'label' => lang('Podcast.form.parental_advisory.clean'),
                'value' => 'clean',
            ],
            [
                'label' => lang('Podcast.form.parental_advisory.explicit'),
                'value' => 'explicit',
            ],
        ])) ?>"
        isRequired="true"
    />
</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Podcast.form.author_section_title') ?>"
    subtitle="<?= lang('Podcast.form.author_section_subtitle') ?>" >

<x-Forms.Field
    name="owner_name"
    label="<?= esc(lang('Podcast.form.owner_name')) ?>"
    value="<?= esc($podcast->owner_name) ?>"
    hint="<?= esc(lang('Podcast.form.owner_name_hint')) ?>"
    isRequired="true" />

<x-Forms.Field
    name="owner_email"
    type="email"
    label="<?= esc(lang('Podcast.form.owner_email')) ?>"
    value="<?= esc($podcast->owner_email) ?>"
    hint="<?= esc(lang('Podcast.form.owner_email_hint')) ?>"
    isRequired="true" />

<x-Forms.Field
    name="publisher"
    label="<?= esc(lang('Podcast.form.publisher')) ?>"
    value="<?= esc($podcast->publisher) ?>"
    hint="<?= esc(lang('Podcast.form.publisher_hint')) ?>" />

<x-Forms.Field
    name="copyright"
    label="<?= esc(lang('Podcast.form.copyright')) ?>"
    value="<?= esc($podcast->copyright) ?>" />

</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Podcast.form.fediverse_section_title') ?>" >

<div class="flex flex-col">
    <x-Forms.Label for="handle" hint="<?= esc(lang('Podcast.form.handle_hint')) ?>"><?= lang('Podcast.form.handle') ?></x-Forms.Label>
    <div class="relative">
        <?= icon('at-line', [
            'class' => 'absolute inset-0 h-full text-xl opacity-40 left-3',
        ]) ?>
        <x-Forms.Input name="handle" value="<?= $podcast->handle ?>" class="w-full pl-8" isRequired="true" isReadonly="true" />
    </div>
</div>

<x-Forms.Field
    name="banner"
    label="<?= esc(lang('Podcast.form.banner')) ?>"
    helper="<?= esc(lang('Podcast.form.banner_size_hint')) ?>"
    type="file"
    accept=".jpg,.jpeg,.png" />

</x-Forms.Section>

<x-Forms.Section title="<?= lang('Podcast.form.premium') ?>">
    <x-Forms.Toggler class="mt-2" name="premium_by_default" value="<?= $podcast->is_premium_by_default ? 'yes' : '' ?>" hint="<?= esc(lang('Podcast.form.premium_by_default_hint')) ?>">
        <?= lang('Podcast.form.premium_by_default') ?></x-Forms.Toggler>
</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Podcast.form.location_section_title') ?>"
    subtitle="<?= lang('Podcast.form.location_section_subtitle') ?>" >

<x-Forms.Field
    name="location_name"
    label="<?= esc(lang('Podcast.form.location_name')) ?>"
    value="<?= esc($podcast->location_name) ?>"
    hint="<?= esc(lang('Podcast.form.location_name_hint')) ?>" />

</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Podcast.form.advanced_section_title') ?>"
    subtitle="<?= lang('Podcast.form.advanced_section_subtitle') ?>" >

<x-Forms.Field
name="new_feed_url"
type="url"
label="<?= esc(lang('Podcast.form.new_feed_url')) ?>"
hint="<?= esc(lang('Podcast.form.new_feed_url_hint')) ?>"
value="<?= esc($podcast->new_feed_url) ?>"
/>
<Forms.Toggler name="redirect_to_new_feed" value="yes" checked="<?= service('settings')
            ->get('Podcast.redirect_to_new_feed', 'podcast:' . $podcast->id) ? 'true' : 'false' ?>" hint="<?= esc(lang('Podcast.form.redirect_to_new_feed_hint')) ?>"><?= lang('Podcast.form.redirect_to_new_feed') ?></Forms.Toggler>

<hr class="border-subtle">

<x-Forms.Toggler class="mb-2" name="lock" value="<?= $podcast->is_locked ? 'yes' : '' ?>" hint="<?= esc(lang('Podcast.form.lock_hint')) ?>">
    <?= lang('Podcast.form.lock') ?>
</x-Forms.Toggler>
<x-Forms.Toggler class="mb-2" name="block" value="<?= $podcast->is_blocked ? 'yes' : ''  ?>" hint="<?= esc(lang('Podcast.form.block_hint')) ?>">
    <?= lang('Podcast.form.block') ?>
</x-Forms.Toggler>
<x-Forms.Toggler name="complete" value="<?= $podcast->is_completed ? 'yes' : '' ?>">
    <?= lang('Podcast.form.complete') ?>
</x-Forms.Toggler>

</x-Forms.Section>

</div>

</form>
<?php // @icon("delete-bin-fill")?>
<x-Button class="mt-8" variant="danger" uri="<?= route_to('podcast-delete', $podcast->id) ?>" iconLeft="delete-bin-fill"><?= lang('Podcast.delete') ?></x-Button>

<?= $this->endSection() ?>
