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

<Forms.Section
    title="<?= lang('PodcastImport.old_podcast_section_title') ?>">
<Alert glyph="scales" variant="info" title="<?= lang('PodcastImport.old_podcast_legal_disclaimer_title') ?>"><?= lang('PodcastImport.old_podcast_legal_disclaimer') ?></Alert>
<Forms.Field
    name="imported_feed_url"
    label="<?= esc(lang('PodcastImport.imported_feed_url')) ?>"
    hint="<?= esc(lang('PodcastImport.imported_feed_url_hint')) ?>"
    placeholder="https://…"
    type="url"
    required="true" />
</Forms.Section>


<Forms.Section
    title="<?= lang('PodcastImport.new_podcast_section_title') ?>" >

<div class="flex flex-col">
    <Forms.Label for="handle" hint="<?= esc(lang('Podcast.form.handle_hint')) ?>"><?= lang('Podcast.form.handle') ?></Forms.Label>
    <div class="relative">
        <Icon glyph="at" class="absolute inset-0 h-full text-xl opacity-40 left-3" />
        <Forms.Input name="handle" class="w-full pl-8" required="true" />
    </div>
</div>

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

</Forms.Section>

<Button variant="primary" type="submit" class="self-end"><?= lang('PodcastImport.submit') ?></Button>

</form>


<?= $this->endSection() ?>
