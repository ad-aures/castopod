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

<form action="<?= route_to('podcast-create') ?>" method="POST" enctype='multipart/form-data' class="flex flex-col w-full max-w-xl gap-y-6">
<?= csrf_field() ?>

<x-Forms.Section
    title="<?= lang('Podcast.form.identity_section_title') ?>"
    subtitle="<?= lang('Podcast.form.identity_section_subtitle') ?>" >

<x-Forms.Field
    name="cover"
    label="<?= esc(lang('Podcast.form.cover')) ?>"
    helper="<?= esc(lang('Podcast.form.cover_size_hint')) ?>"
    type="file"
    isRequired="true"
    accept=".jpg,.jpeg,.png" />

<x-Forms.Field
    name="title"
    label="<?= esc(lang('Podcast.form.title')) ?>"
    isRequired="true" />

<x-Forms.Field
    as="MarkdownEditor"
    name="description"
    label="<?= esc(lang('Podcast.form.description')) ?>"
    isRequired="true"
    disallowList="header,quote" />

<fieldset>
    <legend><?= lang('Podcast.form.type.label') ?></legend>
    <div class="flex gap-2">
        <x-Forms.RadioButton
            value="episodic"
            name="type"
            hint="<?= esc(lang('Podcast.form.type.episodic_hint')) ?>"
            isChecked="true'" ><?= lang('Podcast.form.type.episodic') ?></x-Forms.RadioButton>
        <x-Forms.RadioButton
            value="serial"
            name="type"
            hint="<?= esc(lang('Podcast.form.type.serial_hint')) ?>"
            isChecked="false" ><?= lang('Podcast.form.type.serial') ?></x-Forms.RadioButton>
    </div>
</fieldset>
<fieldset>
    <legend><?= lang('Podcast.form.medium.label') ?></legend>
    <div class="flex gap-2">
        <x-Forms.RadioButton
            value="podcast"
            name="medium"
            hint="<?= esc(lang('Podcast.form.medium.podcast_hint')) ?>"
            isChecked="true" ><?= lang('Podcast.form.medium.podcast') ?></x-Forms.RadioButton>
        <x-Forms.RadioButton
            value="music"
            name="medium"
            hint="<?= esc(lang('Podcast.form.medium.music_hint')) ?>"
            isChecked="false" ><?= lang('Podcast.form.medium.music') ?></x-Forms.RadioButton>
        <x-Forms.RadioButton
            value="audiobook"
            name="medium"
            hint="<?= esc(lang('Podcast.form.medium.audiobook_hint')) ?>"
            isChecked="false" ><?= lang('Podcast.form.medium.audiobook') ?></x-Forms.RadioButton>
    </div>
</fieldset>
</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Podcast.form.classification_section_title') ?>"
    subtitle="<?= lang('Podcast.form.classification_section_subtitle') ?>" >

    <x-Forms.Field
        as="Select"
        name="language"
        label="<?= esc(lang('Podcast.form.language')) ?>"
        selected="<?= $browserLang ?>"
        isRequired="true"
        options="<?= esc(json_encode($languageOptions)) ?>" />

    <x-Forms.Field
        as="Select"
        name="category"
        label="<?= esc(lang('Podcast.form.category')) ?>"
        isRequired="true"
        options="<?= esc(json_encode($categoryOptions)) ?>" />

    <x-Forms.Field
        as="MultiSelect"
        name="other_categories[]"
        label="<?= esc(lang('Podcast.form.other_categories')) ?>"
        data-max-item-count="2"
        options="<?= esc(json_encode($categoryOptions)) ?>" />

    <fieldset class="mb-4">
        <legend><?= lang('Podcast.form.parental_advisory.label') ?><x-Hint class="ml-1"><?= lang('Podcast.form.parental_advisory.hint') ?></x-Hint></legend>
        <div class="flex gap-2">
            <x-Forms.RadioButton
                value="undefined"
                name="parental_advisory"
                isChecked="true" ><?= lang('Podcast.form.parental_advisory.undefined') ?></x-Forms.RadioButton>
            <x-Forms.RadioButton
                value="clean"
                name="parental_advisory"
                isChecked="false" ><?= lang('Podcast.form.parental_advisory.clean') ?></x-Forms.RadioButton>
            <x-Forms.RadioButton
                value="explicit"
                name="parental_advisory"
                isChecked="false" ><?= lang('Podcast.form.parental_advisory.explicit') ?></x-Forms.RadioButton>
        </div>
    </fieldset>
</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Podcast.form.author_section_title') ?>"
    subtitle="<?= lang('Podcast.form.author_section_subtitle') ?>" >

<x-Forms.Field
    name="owner_name"
    label="<?= esc(lang('Podcast.form.owner_name')) ?>"
    hint="<?= esc(lang('Podcast.form.owner_name_hint')) ?>"
    isRequired="true" />

<x-Forms.Field
    name="owner_email"
    type="email"
    label="<?= esc(lang('Podcast.form.owner_email')) ?>"
    hint="<?= esc(lang('Podcast.form.owner_email_hint')) ?>"
    isRequired="true" />

<x-Forms.Toggler class="mt-2" name="is_owner_email_removed_from_feed" isChecked="true" hint="<?= esc(lang('Podcast.form.is_owner_email_removed_from_feed_hint')) ?>">
    <?= lang('Podcast.form.is_owner_email_removed_from_feed') ?></x-Forms.Toggler>

<x-Forms.Field
    name="publisher"
    label="<?= esc(lang('Podcast.form.publisher')) ?>"
    hint="<?= esc(lang('Podcast.form.publisher_hint')) ?>" />

<x-Forms.Field
    name="copyright"
    label="<?= esc(lang('Podcast.form.copyright')) ?>" />

</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Podcast.form.fediverse_section_title') ?>" >
    
    <div class="flex flex-col">
        <x-Forms.Label for="handle" hint="<?= esc(lang('Podcast.form.handle_hint')) ?>"><?= lang('Podcast.form.handle') ?></x-Forms.Label>
        <div class="relative">
            <?= icon('at-line', [
                'class' => 'absolute inset-0 h-full text-xl opacity-40 left-3',
            ]) ?>
            <x-Forms.Input name="handle" class="w-full pl-8" isRequired="true" />
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
    <x-Forms.Toggler class="mt-2" name="premium_by_default" isChecked="false" hint="<?= esc(lang('Podcast.form.premium_by_default_hint')) ?>">
        <?= lang('Podcast.form.premium_by_default') ?></x-Forms.Toggler>
</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Podcast.form.op3') ?>"
    subtitle="<?= lang('Podcast.form.op3_hint') ?>">

    <a href="https://op3.dev" target="_blank" rel="noopener noreferrer" class="inline-flex self-start text-xs font-semibold underline gap-x-1 text-skin-muted hover:no-underline"><?= icon('link', [
        'class' => 'text-sm',
    ]) ?>op3.dev</a>
    <x-Forms.Toggler name="enable_op3" isChecked="false" hint="<?= esc(lang('Podcast.form.op3_enable_hint')) ?>"><?= lang('Podcast.form.op3_enable') ?></x-Forms.Toggler>
</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Podcast.form.location_section_title') ?>"
    subtitle="<?= lang('Podcast.form.location_section_subtitle') ?>" >

<x-Forms.Field
    name="location_name"
    label="<?= esc(lang('Podcast.form.location_name')) ?>"
    hint="<?= esc(lang('Podcast.form.location_name_hint')) ?>" />

</x-Forms.Section>

<x-Forms.Section
    title="<?= lang('Podcast.form.advanced_section_title') ?>" >

<x-Forms.Field
    as="XMLEditor"
    name="custom_rss"
    label="<?= esc(lang('Podcast.form.custom_rss')) ?>"
    hint="<?= esc(lang('Podcast.form.custom_rss_hint')) ?>"
    rows="8" />

<x-Forms.Field
    as="Textarea"
    name="verify_txt"
    label="<?= esc(lang('Podcast.form.verify_txt')) ?>"
    hint="<?= esc(lang('Podcast.form.verify_txt_hint')) ?>"
    helper="<?= esc(lang('Podcast.form.verify_txt_helper')) ?>"
    rows="5" />

<x-Forms.Toggler class="mb-2" name="lock" isChecked="true" hint="<?= esc(lang('Podcast.form.lock_hint')) ?>">
    <?= lang('Podcast.form.lock') ?>
</x-Forms.Toggler>
<x-Forms.Toggler class="mb-2" name="block" isChecked="false" hint="<?= esc(lang('Podcast.form.block_hint')) ?>">
    <?= lang('Podcast.form.block') ?>
</x-Forms.Toggler>
<x-Forms.Toggler name="complete" isChecked="false">
    <?= lang('Podcast.form.complete') ?>
</x-Forms.Toggler>

</x-Forms.Section>

<x-Button variant="primary" type="submit" class="self-end"><?= lang('Podcast.form.submit_create') ?></x-Button>

</form>

<?= $this->endSection() ?>
