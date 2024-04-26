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

<Forms.Section
    title="<?= lang('Podcast.form.identity_section_title') ?>"
    subtitle="<?= lang('Podcast.form.identity_section_subtitle') ?>" >

<Forms.Field
    name="cover"
    label="<?= esc(lang('Podcast.form.cover')) ?>"
    helper="<?= esc(lang('Podcast.form.cover_size_hint')) ?>"
    type="file"
    required="true"
    accept=".jpg,.jpeg,.png" />

<Forms.Field
    name="title"
    label="<?= esc(lang('Podcast.form.title')) ?>"
    required="true" />

<Forms.Field
    as="MarkdownEditor"
    name="description"
    label="<?= esc(lang('Podcast.form.description')) ?>"
    required="true"
    disallowList="header,quote" />

<fieldset>
    <legend><?= lang('Podcast.form.type.label') ?></legend>
    <div class="flex gap-2">
        <Forms.RadioButton
            value="episodic"
            name="type"
            hint="<?= esc(lang('Podcast.form.type.episodic_hint')) ?>"
            isChecked="true'" ><?= lang('Podcast.form.type.episodic') ?></Forms.RadioButton>
        <Forms.RadioButton
            value="serial"
            name="type"
            hint="<?= esc(lang('Podcast.form.type.serial_hint')) ?>"
            isChecked="false" ><?= lang('Podcast.form.type.serial') ?></Forms.RadioButton>
    </div>
</fieldset>
<fieldset>
    <legend><?= lang('Podcast.form.medium.label') ?></legend>
    <div class="flex gap-2">
        <Forms.RadioButton
            value="podcast"
            name="medium"
            hint="<?= esc(lang('Podcast.form.medium.podcast_hint')) ?>"
            isChecked="true" ><?= lang('Podcast.form.medium.podcast') ?></Forms.RadioButton>
        <Forms.RadioButton
            value="music"
            name="medium"
            hint="<?= esc(lang('Podcast.form.medium.music_hint')) ?>"
            isChecked="false" ><?= lang('Podcast.form.medium.music') ?></Forms.RadioButton>
        <Forms.RadioButton
            value="audiobook"
            name="medium"
            hint="<?= esc(lang('Podcast.form.medium.audiobook_hint')) ?>"
            isChecked="false" ><?= lang('Podcast.form.medium.audiobook') ?></Forms.RadioButton>
    </div>
</fieldset>
</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.classification_section_title') ?>"
    subtitle="<?= lang('Podcast.form.classification_section_subtitle') ?>" >

    <Forms.Field
        as="Select"
        name="language"
        label="<?= esc(lang('Podcast.form.language')) ?>"
        selected="<?= $browserLang ?>"
        required="true"
        options="<?= esc(json_encode($languageOptions)) ?>" />

    <Forms.Field
        as="Select"
        name="category"
        label="<?= esc(lang('Podcast.form.category')) ?>"
        required="true"
        options="<?= esc(json_encode($categoryOptions)) ?>" />

    <Forms.Field
        as="MultiSelect"
        name="other_categories[]"
        label="<?= esc(lang('Podcast.form.other_categories')) ?>"
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
                isChecked="false" ><?= lang('Podcast.form.parental_advisory.clean') ?></Forms.RadioButton>
            <Forms.RadioButton
                value="explicit"
                name="parental_advisory"
                isChecked="false" ><?= lang('Podcast.form.parental_advisory.explicit') ?></Forms.RadioButton>
        </div>
    </fieldset>
</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.author_section_title') ?>"
    subtitle="<?= lang('Podcast.form.author_section_subtitle') ?>" >

<Forms.Field
    name="owner_name"
    label="<?= esc(lang('Podcast.form.owner_name')) ?>"
    hint="<?= esc(lang('Podcast.form.owner_name_hint')) ?>"
    required="true" />

<Forms.Field
    name="owner_email"
    type="email"
    label="<?= esc(lang('Podcast.form.owner_email')) ?>"
    hint="<?= esc(lang('Podcast.form.owner_email_hint')) ?>"
    required="true" />

<Forms.Toggler class="mt-2" name="is_owner_email_removed_from_feed" value="yes" checked="false" hint="<?= esc(lang('Podcast.form.is_owner_email_removed_from_feed_hint')) ?>">
    <?= lang('Podcast.form.is_owner_email_removed_from_feed') ?></Forms.Toggler>

<Forms.Field
    name="publisher"
    label="<?= esc(lang('Podcast.form.publisher')) ?>"
    hint="<?= esc(lang('Podcast.form.publisher_hint')) ?>" />

<Forms.Field
    name="copyright"
    label="<?= esc(lang('Podcast.form.copyright')) ?>" />

</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.fediverse_section_title') ?>" >
    
    <div class="flex flex-col">
        <Forms.Label for="handle" hint="<?= esc(lang('Podcast.form.handle_hint')) ?>"><?= lang('Podcast.form.handle') ?></Forms.Label>
        <div class="relative">
            <?= icon('at-line', [
                'class' => 'absolute inset-0 h-full text-xl opacity-40 left-3',
            ]) ?>
            <Forms.Input name="handle" class="w-full pl-8" required="true" />
        </div>
    </div>

    <Forms.Field
        name="banner"
        label="<?= esc(lang('Podcast.form.banner')) ?>"
        helper="<?= esc(lang('Podcast.form.banner_size_hint')) ?>"
        type="file"
        accept=".jpg,.jpeg,.png" />
</Forms.Section>

<Forms.Section title="<?= lang('Podcast.form.premium') ?>">
    <Forms.Toggler class="mt-2" name="premium_by_default" value="yes" checked="false" hint="<?= esc(lang('Podcast.form.premium_by_default_hint')) ?>">
        <?= lang('Podcast.form.premium_by_default') ?></Forms.Toggler>
</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.op3') ?>"
    subtitle="<?= lang('Podcast.form.op3_hint') ?>">

    <a href="https://op3.dev" target="_blank" rel="noopener noreferrer" class="inline-flex self-start text-xs font-semibold underline gap-x-1 text-skin-muted hover:no-underline focus:ring-accent"><?= icon('link', [
        'class' => 'text-sm',
    ]) ?>op3.dev</a>
    <Forms.Toggler name="enable_op3" value="yes" checked="false" hint="<?= esc(lang('Podcast.form.op3_enable_hint')) ?>"><?= lang('Podcast.form.op3_enable') ?></Forms.Toggler>
</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.location_section_title') ?>"
    subtitle="<?= lang('Podcast.form.location_section_subtitle') ?>" >

<Forms.Field
    name="location_name"
    label="<?= esc(lang('Podcast.form.location_name')) ?>"
    hint="<?= esc(lang('Podcast.form.location_name_hint')) ?>" />

</Forms.Section>

<Forms.Section
    title="<?= lang('Podcast.form.advanced_section_title') ?>" >

<Forms.Field
    as="XMLEditor"
    name="custom_rss"
    label="<?= esc(lang('Podcast.form.custom_rss')) ?>"
    hint="<?= esc(lang('Podcast.form.custom_rss_hint')) ?>"
    rows="8" />

<Forms.Field
    as="Textarea"
    name="verify_txt"
    label="<?= esc(lang('Podcast.form.verify_txt')) ?>"
    hint="<?= esc(lang('Podcast.form.verify_txt_hint')) ?>"
    helper="<?= esc(lang('Podcast.form.verify_txt_helper')) ?>"
    rows="5" />

<Forms.Toggler class="mb-2" name="lock" value="yes" checked="true" hint="<?= esc(lang('Podcast.form.lock_hint')) ?>">
    <?= lang('Podcast.form.lock') ?>
</Forms.Toggler>
<Forms.Toggler class="mb-2" name="block" value="yes" checked="false" hint="<?= esc(lang('Podcast.form.block_hint')) ?>">
    <?= lang('Podcast.form.block') ?>
</Forms.Toggler>
<Forms.Toggler name="complete" value="yes" checked="false">
    <?= lang('Podcast.form.complete') ?>
</Forms.Toggler>

</Forms.Section>

<Button variant="primary" type="submit" class="self-end"><?= lang('Podcast.form.submit_create') ?></Button>

</form>

<?= $this->endSection() ?>
