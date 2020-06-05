<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<h1 class="mb-6 text-xl"><?= lang("Podcasts.create") ?></h1>

<!-- <div class="mb-8">
     \Config\Services::validation()->listErrors()
</div> -->

<?= form_open_multipart('podcasts/create', ["method" => "post", "class" => "flex flex-col max-w-md"]) ?>
<?= csrf_field() ?>

<div class="flex flex-col mb-4">
    <label for="title"><?= lang("Podcasts.form.title") ?></label>
    <input type="text" class="form-input" id="title" name="title" required />
</div>

<div class="flex flex-col mb-4">
    <label for="name"><?= lang("Podcasts.form.name") ?></label>
    <input type="text" class="form-input" id="name" name="name" required />
</div>

<div class="flex flex-col mb-4">
    <label for="description"><?= lang("Podcasts.form.description") ?></label>
    <textarea class="form-textarea" id="description" name="description" required></textarea>
</div>

<div class="flex flex-col mb-4">
    <label for="episode_description_footer"><?= lang("Podcasts.form.episode_description_footer") ?></label>
    <textarea class="form-textarea" id="episode_description_footer" name="episode_description_footer"></textarea>
</div>

<div class="flex flex-col mb-4">
    <label for="image"><?= lang("Podcasts.form.image") ?></label>
    <input type="file" class="form-input" id="image" name="image" required />
</div>

<div class="flex flex-col mb-4">
    <label for="language"><?= lang("Podcasts.form.language") ?></label>
    <select id="language" name="language" autocomplete="off" class="form-select" required>
        <?php foreach ($languages as $language) : ?>
            <option <?= ($language->code == $browser_lang) ? "selected='selected'" : "" ?> value="<?= $language->code ?>"><?= $language->native_name ?></option>
        <?php endforeach ?>
    </select>
</div>

<div class="flex flex-col mb-4">
    <label for="category"><?= lang("Podcasts.form.category") ?></label>
    <select id="category" name="category" class="form-select" required>
        <?php foreach ($categories as $category) : ?>
            <option value="<?= $category->code ?>"><?= lang("Podcasts.category_options." . $category->code) ?></option>
        <?php endforeach ?>
    </select>
</div>

<div class="inline-flex items-center mb-4">
    <input type="checkbox" id="explicit" name="explicit" class="form-checkbox" />
    <label for="explicit" class="pl-2"><?= lang("Podcasts.form.explicit") ?></label>
</div>

<div class="flex flex-col mb-4">
    <label for="author"><?= lang("Podcasts.form.author") ?></label>
    <input type="text" class="form-input" id="author" name="author" />
</div>

<div class="flex flex-col mb-4">
    <label for="owner_name"><?= lang("Podcasts.form.owner_name") ?></label>
    <input type="text" class="form-input" id="owner_name" name="owner_name" />
</div>

<div class="flex flex-col mb-4">
    <label for="owner_email"><?= lang("Podcasts.form.owner_email") ?></label>
    <input type="email" class="form-input" id="owner_email" name="owner_email" required />
</div>

<fieldset class="mb-4">
    <legend><?= lang("Podcasts.form.type.label") ?></legend>
    <input type="radio" class="form-radio" value="episodic" id="episodic" name="type" checked="checked" />
    <label for="episodic"><?= lang("Podcasts.form.type.episodic") ?></label><br />

    <input type="radio" class="form-radio" value="serial" id="serial" name="type" />
    <label for="serial"><?= lang("Podcasts.form.type.serial") ?></label><br />
</fieldset>

<div class="flex flex-col mb-4">
    <label for="copyright"><?= lang("Podcasts.form.copyright") ?></label>
    <input type="text" class="form-input" id="copyright" name="copyright" />
</div>

<div class="inline-flex items-center mb-4">
    <input type="checkbox" id="block" name="block" class="form-checkbox" />
    <label for="block" class="pl-2"><?= lang("Podcasts.form.block") ?></label>
</div>

<div class="inline-flex items-center mb-4">
    <input type="checkbox" id="complete" name="complete" class="form-checkbox" />
    <label for="complete" class="pl-2"><?= lang("Podcasts.form.complete") ?></label>
</div>

<div class="flex flex-col mb-4">
    <label for="custom_html_head"><?= esc(lang("Podcasts.form.custom_html_head")) ?></label>
    <textarea class="form-textarea" id="custom_html_head" name="custom_html_head"></textarea>
</div>

<button type="submit" name="submit" class="self-end px-4 py-2 bg-gray-200"><?= lang("Podcasts.form.submit") ?></button>
<?= form_close() ?>


<?= $this->endSection() ?>