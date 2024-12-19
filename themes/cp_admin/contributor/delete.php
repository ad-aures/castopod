<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Contributor.delete_form.title', [
    'contributor' => $contributor->username,
]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('contributor-delete', $podcast->id, $contributor->id) ?>" method="POST" class="flex flex-col w-full max-w-xl mx-auto">
<?= csrf_field() ?>

<x-Alert variant="danger" class="font-semibold"><?= lang('Contributor.delete_form.disclaimer', [
    'contributor'  => $contributor->username,
    'podcastTitle' => $podcast->title,
]) ?></x-Alert>

<x-Forms.Checkbox class="mt-2" name="understand" isRequired="true"><?= lang('Contributor.delete_form.understand', [
    'contributor'  => $contributor->username,
    'podcastTitle' => $podcast->title,
]) ?></x-Forms.Checkbox>

<div class="self-end mt-4">
    <x-Button uri="<?= route_to('contributor-view', $podcast->id, $contributor->id) ?>"><?= lang('Common.cancel') ?></x-Button>
    <x-Button type="submit" variant="danger"><?= lang('Contributor.delete_form.submit') ?></x-Button>
</div>

</form>

<?= $this->endSection() ?>
