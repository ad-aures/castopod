<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.delete') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.delete') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('episode-delete', $podcast->id, $episode->id) ?>" method="POST" class="flex flex-col w-full max-w-xl mx-auto">
<?= csrf_field() ?>

<x-Alert variant="danger" class="font-semibold"><?= lang('Episode.delete_form.disclaimer') ?></x-Alert>

<x-Forms.Checkbox class="mt-2" name="understand" isRequired="true" isChecked="false"><?= lang('Episode.delete_form.understand') ?></x-Forms.Checkbox>

<div class="self-end mt-4">
    <x-Button uri="<?= route_to('episode-view', $podcast->id, $episode->id) ?>"><?= lang('Common.cancel') ?></x-Button>
    <x-Button type="submit" variant="danger"><?= lang('Episode.delete_form.submit') ?></x-Button>
</div>

</form>

<?= $this->endSection() ?>
