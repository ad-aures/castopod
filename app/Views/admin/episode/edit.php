<?= $this->extend('admin/_layout') ?>

<?= $this->section('content') ?>

<h1 class="mb-6 text-xl"><?= lang('Episode.edit') ?></h1>

<div class="mb-8">
    <?= \Config\Services::validation()->listErrors() ?>
</div>

<?= form_open_multipart(
    route_to('episode_edit', $podcast->name, $episode->slug),
    [
        'method' => 'post',
        'class' => 'flex flex-col max-w-md',
    ]
) ?>
<?= csrf_field() ?>

<div class="flex flex-col mb-4">
    <label for="enclosure"><?= lang('Episode.form.file') ?></label>
    <input type="file" class="form-input" id="enclosure" name="enclosure" accept=".mp3,.m4a" />
</div>

<div class="flex flex-col mb-4">
    <label for="title"><?= lang('Episode.form.title') ?></label>
    <input type="text" class="form-input" id="title" name="title" value="<?= $episode->title ?>" required />
</div>

<div class="flex flex-col mb-4">
    <label for="slug"><?= lang('Episode.form.slug') ?></label>
    <input type="text" class="form-input" id="slug" name="slug" value="<?= $episode->slug ?>" required />
</div>

<div class="flex flex-col mb-4">
    <label for="description"><?= lang('Episode.form.description') ?></label>
    <textarea class="form-textarea" id="description" name="description" required><?= $episode->description ?></textarea>
</div>

<div class="flex flex-col mb-4">
    <label for="pub_date"><?= lang('Episode.form.pub_date') ?></label>
    <input type="date" class="form-input" id="pub_date" name="pub_date" value="<?= $episode->pub_date->format(
        'Y-m-d'
    ) ?>" />
</div>

<div class="flex flex-col mb-4">
    <label for="image"><?= lang('Episode.form.image') ?></label>
    <input type="file" class="form-input" id="image" name="image" accept=".jpg,.jpeg,.png" />
</div>

<div class="flex flex-col mb-4">
    <label for="episode_number"><?= lang(
        'Episode.form.episode_number'
    ) ?></label>
    <input type="number" class="form-input" id="episode_number" name="episode_number" value="<?= $episode->number ?>" required />
</div>

<div class="flex flex-col mb-4">
    <label for="season_number"><?= lang('Episode.form.season_number') ?></label>
    <input type="number" class="form-input" id="season_number" name="season_number" value="<?= $episode->season_number ?>" />
</div>

<div class="inline-flex items-center mb-4">
    <input type="checkbox" id="explicit" name="explicit" class="form-checkbox" <?= $episode->explicit
        ? 'checked'
        : '' ?> />
    <label for="explicit" class="pl-2"><?= lang(
        'Episode.form.explicit'
    ) ?></label>
</div>

<div class="flex flex-col mb-4">
    <label for="author_name"><?= lang('Podcast.form.author_name') ?></label>
    <input type="text" class="form-input" id="author_name" name="author_name" value="<?= $episode->author_name ?>" />
</div>

<div class="flex flex-col mb-4">
    <label for="author_email"><?= lang('Podcast.form.author_email') ?></label>
    <input type="email" class="form-input" id="author_email" name="author_email" value="<?= $episode->author_email ?>" />
</div>

<fieldset class="flex flex-col mb-4">
    <legend><?= lang('Episode.form.type.label') ?></legend>
    <label for="full" class="inline-flex items-center">
        <input type="radio" class="form-radio" value="full" id="full" name="type" required 
        <?= $episode->type == 'full' ? 'checked' : '' ?>/>
        <span class="ml-2"><?= lang('Episode.form.type.full') ?></span>  
    </label>
    <label for="trailer" class="inline-flex items-center">
        <input type="radio" class="form-radio" value="trailer" id="trailer" name="type" required
        <?= $episode->type == 'trailer' ? 'checked' : '' ?>/>
        <span class="ml-2"><?= lang('Episode.form.type.trailer') ?></span>  
    </label>
    <label for="bonus" class="inline-flex items-center">
        <input type="radio" class="form-radio" value="bonus" id="bonus" name="type" required
        <?= $episode->type == 'bonus' ? 'checked' : '' ?> />
        <span class="ml-2"><?= lang('Episode.form.type.bonus') ?></span> 
    </label>
</fieldset>

<div class="inline-flex items-center mb-4">
    <input type="checkbox" id="block" name="block" class="form-checkbox" <?= $episode->block
        ? 'checked'
        : '' ?> />
    <label for="block" class="pl-2"><?= lang('Episode.form.block') ?></label>
</div>

<button type="submit" name="submit" class="self-end px-4 py-2 bg-gray-200"><?= lang(
    'Episode.form.submit_edit'
) ?></button>
<?= form_close() ?>


<?= $this->endSection() ?>
