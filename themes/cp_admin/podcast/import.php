<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.import') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.import') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<Alert glyph="alert" variant="danger" class="max-w-xl"><?= lang('PodcastImport.warning') ?></Alert>

<form action="<?= route_to('podcast-import') ?>" method="POST" enctype='multipart/form-data' class="flex flex-col mt-6 gap-y-8">
<?= csrf_field() ?>

<Forms.Section
    title="<?= lang('PodcastImport.old_podcast_section_title') ?>"
    subtitle="<?= lang('PodcastImport.old_podcast_section_subtitle') ?>"
    subtitleClass="inline-flex text-xs p-2 mt-2 text-blue-800 font-semibold bg-blue-100 border border-blue-300 rounded">
<Forms.Field
    name="imported_feed_url"
    label="<?= lang('PodcastImport.imported_feed_url') ?>"
    hint="<?= lang('PodcastImport.imported_feed_url_hint') ?>"
    placeholder="https://…"
    type="url"
    required="true" />
</Forms.Section>


<Forms.Section
    title="<?= lang('PodcastImport.new_podcast_section_title') ?>" >

<div class="flex flex-col">
    <Forms.Label for="handle" hint="<?= lang('Podcast.form.handle_hint') ?>"><?= lang('Podcast.form.handle') ?></Forms.Label>
    <div class="relative">
        <Icon glyph="at" class="absolute inset-0 h-full text-xl text-gray-400 left-3" />
        <Forms.Input name="handle" class="w-full pl-8" required="true" />
    </div>
</div>

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

</Forms.Section>

<Forms.Section
    title="<?= lang('PodcastImport.advanced_params_section_title') ?>"
    subtitle="<?= lang('PodcastImport.advanced_params_section_subtitle') ?>" >

<fieldset class="flex flex-col mb-4 gap-y-2">
    <legend class="mb-2"><?= lang('PodcastImport.slug_field') ?></legend>
    <Forms.Radio value="title" name="slug_field" isChecked="true">&lt;title&gt;</span></Forms.Radio>
    <Forms.Radio value="link" name="slug_field">&lt;link&gt;</span></Forms.Radio>
</fieldset>

<fieldset class="flex flex-col mb-4 gap-y-2">
    <legend class="mb-2"><?= lang('PodcastImport.description_field') ?></legend>
    <Forms.Radio value="description" name="description_field" isChecked="true">&lt;description&gt;</Forms.Radio>
    <Forms.Radio value="summary" name="description_field">&lt;itunes:summary&gt;</Forms.Radio>
    <Forms.Radio value="subtitle_summary" name="description_field">&lt;itunes:subtitle&gt; + &lt;itunes:summary&gt;</Forms.Radio>
    <Forms.Radio value="content" name="description_field">&lt;content:encoded&gt;</Forms.Radio>
</fieldset>

<Forms.Checkbox name="force_renumber" hint="<?= lang('PodcastImport.force_renumber_hint') ?>"><?= lang('PodcastImport.force_renumber') ?></Forms.Checkbox>

<Forms.Field
    name="season_number"
    type="number"
    label="<?= lang('PodcastImport.season_number') ?>"
    hint="<?= lang('PodcastImport.season_number_hint') ?>" />

<Forms.Field
    name="max_episodes"
    type="number"
    label="<?= lang('PodcastImport.max_episodes') ?>"
    hint="<?= lang('PodcastImport.max_episodes_hint') ?>" />

</Forms.Section>

<Button variant="primary" type="submit" class="self-end"><?= lang('PodcastImport.submit') ?></Button>

</form>


<?= $this->endSection() ?>
