<?= $this->extend('_layout') ?>

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

<x-Forms.RadioGroup
    label="<?= lang('Podcast.form.type.label') ?>"
    name="type"
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
        defaultValue="<?= $browserLang ?>"
        isRequired="true"
        options="<?= esc(json_encode($languageOptions)) ?>" />

    <x-Forms.Field
        as="Select"
        name="category"
        label="<?= esc(lang('Podcast.form.category')) ?>"
        isRequired="true"
        options="<?= esc(json_encode($categoryOptions)) ?>" />

    <x-Forms.Field
        as="SelectMulti"
        name="other_categories"
        label="<?= esc(lang('Podcast.form.other_categories')) ?>"
        data-max-item-count="2"
        options="<?= esc(json_encode($categoryOptions)) ?>" />

        <x-Forms.RadioGroup
            label="<?= lang('Podcast.form.parental_advisory.label') ?>"
            hint="<?= lang('Podcast.form.parental_advisory.hint') ?>"
            name="parental_advisory"
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
    hint="<?= esc(lang('Podcast.form.owner_name_hint')) ?>"
    isRequired="true" />

<x-Forms.Field
    name="owner_email"
    type="email"
    label="<?= esc(lang('Podcast.form.owner_email')) ?>"
    hint="<?= esc(lang('Podcast.form.owner_email_hint')) ?>"
    isRequired="true" />

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
    <x-Forms.Toggler class="mt-2" name="premium_by_default" hint="<?= esc(lang('Podcast.form.premium_by_default_hint')) ?>">
        <?= lang('Podcast.form.premium_by_default') ?></x-Forms.Toggler>
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

<x-Forms.Toggler class="mb-2" name="lock" defaultValue="yes" hint="<?= esc(lang('Podcast.form.lock_hint')) ?>">
    <?= lang('Podcast.form.lock') ?>
</x-Forms.Toggler>
<x-Forms.Toggler class="mb-2" name="block" hint="<?= esc(lang('Podcast.form.block_hint')) ?>">
    <?= lang('Podcast.form.block') ?>
</x-Forms.Toggler>
<x-Forms.Toggler name="complete">
    <?= lang('Podcast.form.complete') ?>
</x-Forms.Toggler>

</x-Forms.Section>

<x-Button variant="primary" type="submit" class="self-end"><?= lang('Podcast.form.submit_create') ?></x-Button>

</form>

<?= $this->endSection() ?>
