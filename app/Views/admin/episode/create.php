<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open_multipart(route_to('episode_create', $podcast->id), [
    'method' => 'post',
    'class' => 'flex flex-col max-w-md',
]) ?>
<?= csrf_field() ?>

<div class="flex flex-col mb-4">
    <label for="enclosure"><?= lang('Episode.form.file') ?></label>
    <input type="file" class="form-input" id="enclosure" name="enclosure" required accept=".mp3,.m4a" />
</div>

<div class="flex flex-col mb-4">
    <label for="title"><?= lang('Episode.form.title') ?></label>
    <input type="text" class="form-input" id="title" name="title" data-slugify="title" required value="<?= old(
        'title'
    ) ?>" />
</div>

<div class="flex flex-col mb-4">
    <label for="slug"><?= lang('Episode.form.slug') ?></label>
    <input type="text" class="form-input" id="slug" name="slug" data-slugify="slug" required value="<?= old(
        'slug'
    ) ?>" />
</div>

<div class="flex flex-col mb-4">
    <label for="description"><?= lang('Episode.form.description') ?></label>
    <textarea class="hidden form-textarea" id="description" name="description" required data-editor="markdown"><?= old(
        'description'
    ) ?></textarea>
    <button type="button" data-editor-view="markdown">Markdown</button>
    <button type="button" data-editor-view="wysiwyg">WYSIWYG</button>
</div>

<div class="flex flex-col mb-4">
    <label for="pub_date"><?= lang('Episode.form.pub_date') ?></label>
    <input type="date" class="form-input" id="pub_date" name="pub_date" value="<?= old(
        'pub_date'
    ) || date('Y-m-d') ?>" />
</div>

<div class="flex flex-col mb-4">
    <label for="image"><?= lang('Episode.form.image') ?></label>
    <input type="file" class="form-input" id="image" name="image" accept=".jpg,.jpeg,.png" />
</div>

<div class="flex flex-col mb-4">
    <label for="episode_number"><?= lang(
        'Episode.form.episode_number'
    ) ?></label>
    <input type="number" class="form-input" id="episode_number" name="episode_number" required value="<?= old(
        'episode_number'
    ) ?>" />
</div>

<div class="flex flex-col mb-4">
    <label for="season_number"><?= lang('Episode.form.season_number') ?></label>
    <input type="number" class="form-input" id="season_number" name="season_number" value="<?= old(
        'season_number'
    ) ?>" />
</div>

<div class="inline-flex items-center mb-4">
    <input type="checkbox" id="explicit" name="explicit" class="form-checkbox" <?php if (
        old('explicit')
    ): ?> checked <?php endif; ?> />
    <label for="explicit" class="pl-2"><?= lang(
        'Episode.form.explicit'
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

<fieldset class="flex flex-col mb-4">
    <legend><?= lang('Episode.form.type.label') ?></legend>
    <label for="full" class="inline-flex items-center">
        <input type="radio" class="form-radio" value="full" id="full" name="type" required <?php if (
            !old('type') ||
            old('type') == 'full'
        ): ?> checked <?php endif; ?> />
        <span class="ml-2"><?= lang('Episode.form.type.full') ?></span>  
    </label>
    <label for="trailer" class="inline-flex items-center">
        <input type="radio" class="form-radio" value="trailer" id="trailer" name="type" required <?php if (
            old('type') == 'trailer'
        ): ?> checked <?php endif; ?> />
        <span class="ml-2"><?= lang('Episode.form.type.trailer') ?></span>  
    </label>
    <label for="bonus" class="inline-flex items-center">
        <input type="radio" class="form-radio" value="bonus" id="bonus" name="type" required <?php if (
            old('type') == 'bonus'
        ): ?> checked <?php endif; ?> />
        <span class="ml-2"><?= lang('Episode.form.type.bonus') ?></span>  
    </label>
</fieldset>

<div class="inline-flex items-center mb-4">
    <input type="checkbox" id="block" name="block" class="form-checkbox" <?php if (
        old('block')
    ): ?> checked <?php endif; ?> />
    <label for="block" class="pl-2"><?= lang('Episode.form.block') ?></label>
</div>

<button type="submit" name="submit" class="self-end px-4 py-2 bg-gray-200"><?= lang(
    'Episode.form.submit_create'
) ?></button>
<?= form_close() ?>


<?= $this->endSection() ?>
