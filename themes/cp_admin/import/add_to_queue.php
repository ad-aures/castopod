<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.import') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.import') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('import') ?>" method="POST" enctype='multipart/form-data' class="flex flex-col w-full max-w-xl gap-y-8">
<?= csrf_field() ?>

<x-Forms.Section
    title="<?= lang('PodcastImport.old_podcast_section_title') ?>">
<?php // @icon('scales-3-fill')?>
<x-Alert glyph="scales-3-fill" variant="info" title="<?= lang('PodcastImport.old_podcast_legal_disclaimer_title') ?>"><?= lang('PodcastImport.old_podcast_legal_disclaimer') ?></x-Alert>
<x-Forms.Field
    name="imported_feed_url"
    label="<?= esc(lang('PodcastImport.imported_feed_url')) ?>"
    hint="<?= esc(lang('PodcastImport.imported_feed_url_hint')) ?>"
    placeholder="https://…"
    type="url"
    isRequired="true" />
</x-Forms.Section>


<x-Forms.Section
    title="<?= lang('PodcastImport.new_podcast_section_title') ?>" >

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

</x-Forms.Section>

<x-Button variant="primary" type="submit" class="self-end"><?= lang('PodcastImport.submit') ?></x-Button>

</form>


<?= $this->endSection() ?>
