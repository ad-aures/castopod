<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<h1 class="mb-6 text-xl"><?= lang('Episodes.create') ?></h1>

<div class="mb-8">
    <?= \Config\Services::validation()->listErrors() ?>
</div>

<?= form_open_multipart(route_to('episodes_create', '@' . $podcast->name), [
    'method' => 'post',
    'class' => 'flex flex-col max-w-md',
]) ?>
<?= csrf_field() ?>

<div class="flex flex-col mb-4">
    <label for="episode_file"><?= lang('Episodes.form.file') ?></label>
    <input type="file" class="form-input" id="episode_file" name="episode_file" required accept=".mp3,.m4a" />
</div>

<div class="flex flex-col mb-4">
    <label for="title"><?= lang('Episodes.form.title') ?></label>
    <input type="text" class="form-input" id="title" name="title" required />
</div>

<div class="flex flex-col mb-4">
    <label for="slug"><?= lang('Episodes.form.slug') ?></label>
    <input type="text" class="form-input" id="slug" name="slug" required />
</div>

<div class="flex flex-col mb-4">
    <label for="description"><?= lang('Episodes.form.description') ?></label>
    <textarea class="form-textarea" id="description" name="description" required></textarea>
</div>

<div class="flex flex-col mb-4">
    <label for="pub_date"><?= lang('Episodes.form.pub_date') ?></label>
    <input type="date" class="form-input" id="pub_date" name="pub_date" value="<?= date(
        'Y-m-d'
    ) ?>" />
</div>

<div class="flex flex-col mb-4">
    <label for="image"><?= lang('Episodes.form.image') ?></label>
    <input type="file" class="form-input" id="image" name="image" accept=".jpg,.jpeg,.png" />
</div>

<div class="flex flex-col mb-4">
    <label for="episode_number"><?= lang(
        'Episodes.form.episode_number'
    ) ?></label>
    <input type="number" class="form-input" id="episode_number" name="episode_number"
    <?= $podcast->type == 'serial' ? 'required' : '' ?> />
</div>

<div class="flex flex-col mb-4">
    <label for="season_number"><?= lang(
        'Episodes.form.season_number'
    ) ?></label>
    <input type="number" class="form-input" id="season_number" name="season_number" />
</div>

<div class="inline-flex items-center mb-4">
    <input type="checkbox" id="explicit" name="explicit" class="form-checkbox" />
    <label for="explicit" class="pl-2"><?= lang(
        'Episodes.form.explicit'
    ) ?></label>
</div>

<fieldset class="flex flex-col mb-4">
    <legend><?= lang('Episodes.form.type.label') ?></legend>
    <?php foreach ($episode_types as $type): ?>
        <label for="<?= $type ?>" class="inline-flex items-center">
        <input type="radio" class="form-radio" value="<?= $type ?>" id="<?= $type ?>" name="type" required />
        <span class="ml-2"><?= lang('Episodes.form.type.' . $type) ?></span>  
    </label>
    <?php endforeach; ?>
</fieldset>

<div class="inline-flex items-center mb-4">
    <input type="checkbox" id="block" name="block" class="form-checkbox" />
    <label for="block" class="pl-2"><?= lang('Episodes.form.block') ?></label>
</div>

<button type="submit" name="submit" class="self-end px-4 py-2 bg-gray-200"><?= lang(
    'Episodes.form.submit'
) ?></button>
<?= form_close() ?>


<?= $this->endSection() ?>
