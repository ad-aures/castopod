<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.delete') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('podcast-delete', $podcast->id) ?>" method="POST" class="flex flex-col w-full max-w-xl mx-auto">
<?= csrf_field() ?>

<x-Alert variant="danger" class="font-semibold"><?= lang('Podcast.delete_form.disclaimer') ?></x-Alert>

<x-Forms.Checkbox class="mt-2" name="understand" isRequired="true"><?= lang('Podcast.delete_form.understand') ?></x-Forms.Checkbox>

<div class="self-end mt-4">
    <x-Button uri="<?= route_to('podcast-view', $podcast->id) ?>"><?= lang('Common.cancel') ?></x-Button>
    <x-Button type="submit" variant="danger"><?= lang('Podcast.delete_form.submit') ?></x-Button>
</div>

</form>

<?= $this->endSection() ?>
