<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open_multipart(route_to('podcast_create'), [
    'method' => 'post',
    'class' => 'flex flex-col max-w-md',
]) ?>
<?= csrf_field() ?>

<div class="flex flex-col mb-4">
    <label for="title"><?= lang('Podcast.form.title') ?></label>
    <input type="text" class="form-input" id="title" name="title" value="<?= old(
        'title'
    ) ?>" required />
</div>

<div class="flex flex-col mb-4">
    <label for="name"><?= lang('Podcast.form.name') ?></label>
    <input type="text" class="form-input" id="name" name="name" value="<?= old(
        'name'
    ) ?>" required />
</div>

<div class="flex flex-col mb-4">
    <label for="description"><?= lang('Podcast.form.description') ?></label>
    <textarea class="form-textarea" id="description" name="description" required><?= old(
        'description'
    ) ?></textarea>
</div>

<div class="flex flex-col mb-4">
    <label for="episode_description_footer"><?= lang(
        'Podcast.form.episode_description_footer'
    ) ?></label>
    <textarea class="form-textarea" id="episode_description_footer" name="episode_description_footer"><?= old(
        'episode_description_footer'
    ) ?></textarea>
</div>

<div class="flex flex-col mb-4">
    <label for="image"><?= lang('Podcast.form.image') ?></label>
    <input type="file" class="form-input" id="image" name="image" required />
</div>

<div class="flex flex-col mb-4">
    <label for="language"><?= lang('Podcast.form.language') ?></label>
    <select id="language" name="language" autocomplete="off" class="form-select" required>
        <?php foreach ($languages as $language): ?>
            <option value="<?= $language->code ?>"
            <?php if (
                old('language') == $language->code
            ): ?> selected <?php endif; ?>
            <?php if (
                !old('language') &&
                $language->code == $browser_lang
            ): ?> selected <?php endif; ?>
                >
                <?= $language->native_name ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="flex flex-col mb-4">
    <label for="category"><?= lang('Podcast.form.category') ?></label>
    <select id="category" name="category" class="form-select" required>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category->code ?>"
            <?php if (
                old('category') == $category->code
            ): ?> selected <?php endif; ?>
            ><?= lang('Podcast.category_options.' . $category->code) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="inline-flex items-center mb-4">
    <input type="checkbox" id="explicit" name="explicit" class="form-checkbox" <?php if (
        old('explicit')
    ): ?> checked <?php endif; ?> />
    <label for="explicit" class="pl-2"><?= lang(
        'Podcast.form.explicit'
    ) ?></label>
</div>

<div class="flex flex-col mb-4">
    <label for="author_name"><?= lang('Podcast.form.author_name') ?></label>
    <input type="text" class="form-input" id="author_name" name="author_name" value="<?= old(
        'author_name'
    ) ?>" />
</div>

<div class="flex flex-col mb-4">
    <label for="author_email"><?= lang('Podcast.form.author_email') ?></label>
    <input type="email" class="form-input" id="author_email" name="author_email" value="<?= old(
        'author_email'
    ) ?>" />
</div>

<div class="flex flex-col mb-4">
    <label for="owner_name"><?= lang('Podcast.form.owner_name') ?></label>
    <input type="text" class="form-input" id="owner_name" name="owner_name" value="<?= old(
        'owner_name'
    ) ?>" />
</div>

<div class="flex flex-col mb-4">
    <label for="owner_email"><?= lang('Podcast.form.owner_email') ?></label>
    <input type="email" class="form-input" id="owner_email" name="owner_email" value="<?= old(
        'owner_email'
    ) ?>" required />
</div>

<fieldset class="flex flex-col mb-4">
    <legend><?= lang('Podcast.form.type.label') ?></legend>
    <label for="episodic" class="inline-flex items-center">
        <input type="radio" class="form-radio" value="episodic" id="episodic" name="type" required <?php if (
            !old('type') ||
            old('type') == 'episodic'
        ): ?> checked <?php endif; ?> />
        <span class="ml-2"><?= lang('Podcast.form.type.episodic') ?></span>
    </label>
    <label for="serial" class="inline-flex items-center">
        <input type="radio" class="form-radio" value="serial" id="serial" name="type" required <?php if (
            old('type') == 'serial'
        ): ?> checked <?php endif; ?>  />
        <span class="ml-2"><?= lang('Podcast.form.type.serial') ?></span>
    </label>
</fieldset>

<div class="flex flex-col mb-4">
    <label for="copyright"><?= lang('Podcast.form.copyright') ?></label>
    <input type="text" class="form-input" id="copyright" name="copyright" value="<?= old(
        'copyright'
    ) ?>" />
</div>

<div class="inline-flex items-center mb-4">
    <input type="checkbox" id="block" name="block" class="form-checkbox" <?php if (
        old('block')
    ): ?> checked <?php endif; ?> />
    <label for="block" class="pl-2"><?= lang('Podcast.form.block') ?></label>
</div>

<div class="inline-flex items-center mb-4">
    <input type="checkbox" id="complete" name="complete" class="form-checkbox" <?php if (
        old('complete')
    ): ?> checked <?php endif; ?> />
    <label for="complete" class="pl-2"><?= lang(
        'Podcast.form.complete'
    ) ?></label>
</div>

<div class="flex flex-col mb-4">
    <label for="custom_html_head"><?= esc(
        lang('Podcast.form.custom_html_head')
    ) ?></label>
    <textarea class="form-textarea" id="custom_html_head" name="custom_html_head"></textarea>
</div>

<button type="submit" name="submit" class="self-end px-4 py-2 bg-gray-200"><?= lang(
    'Podcast.form.submit_create'
) ?></button>
<?= form_close() ?>


<?= $this->endSection() ?>
