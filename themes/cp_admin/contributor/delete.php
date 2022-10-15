<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.delete_form.title', [
    'contributor' => $contributor->username,
]) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Contributor.delete_form.title', [
    'contributor' => $contributor->username,
]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('contributor-delete', $podcast->id, $contributor->id) ?>" method="POST" class="flex flex-col w-full max-w-xl mx-auto">
<?= csrf_field() ?>

<Alert variant="danger" glyph="alert" class="font-semibold"><?= lang('Contributor.delete_form.disclaimer', [
    'contributor' => $contributor->username,
    'podcastTitle' => $podcast->title,
]) ?></Alert>

<Forms.Checkbox class="mt-2" name="understand" required="true" isChecked="false"><?= lang('Contributor.delete_form.understand', [
    'contributor' => $contributor->username,
    'podcastTitle' => $podcast->title,
]) ?></Forms.Checkbox>

<div class="self-end mt-4">
    <Button uri="<?= route_to('contributor-view', $podcast->id, $contributor->id) ?>"><?= lang('Common.cancel') ?></Button>
    <Button type="submit" variant="danger"><?= lang('Contributor.delete_form.submit') ?></Button>
</div>

</form>

<?= $this->endSection() ?>
